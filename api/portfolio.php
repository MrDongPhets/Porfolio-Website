<?php
/**
 * GET /api/portfolio.php
 * GET /api/portfolio.php?category=Branding
 *
 * Returns all active portfolio items, optionally filtered by category.
 *
 * Response:
 * {
 *   "data": [ ...items ],
 *   "categories": [ "Branding", "Web Design", ... ],
 *   "total": 12
 * }
 */

ob_start();

require_once '../config/config.php';

header('Content-Type: application/json');

$filterCategory = isset($_GET['category']) ? trim($_GET['category']) : 'all';

$result = $db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc,created_at.desc');

if (!$result['success']) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch portfolio items']);
    exit;
}

$allItems = $result['data'] ?? [];

// Build unique category list
$categories = array_values(array_unique(array_column($allItems, 'category')));
sort($categories);

// Filter by category if requested
if ($filterCategory !== 'all' && $filterCategory !== '') {
    $allItems = array_values(array_filter($allItems, function ($item) use ($filterCategory) {
        return strtolower($item['category'] ?? '') === strtolower($filterCategory);
    }));
}

ob_end_clean();
echo json_encode([
    'data'       => $allItems,
    'categories' => $categories,
    'total'      => count($allItems),
]);
