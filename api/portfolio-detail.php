<?php
/**
 * GET /api/portfolio-detail.php?id={id}
 *
 * Returns a single portfolio item plus up to 3 related items (same category).
 *
 * Response:
 * {
 *   "data": {
 *     ...item,
 *     "gallery_images": [ "url1", "url2" ],   // parsed from JSON
 *     "tools_list":     [ "Figma", "PS" ],     // parsed from CSV
 *     "deliverables_list": [ "Logo", "Guide" ] // parsed from CSV
 *   },
 *   "related": [ ...up to 3 items ]
 * }
 *
 * Errors:
 * 400 — missing id
 * 404 — item not found or inactive
 * 500 — server error
 */

ob_start();

require_once '../config/config.php';

header('Content-Type: application/json');

$itemId = isset($_GET['id']) ? trim($_GET['id']) : null;

if (!$itemId) {
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameter: id']);
    exit;
}

// Fetch the requested item
$result = $db->select('portfolio_items', '*', ['id' => $itemId, 'is_active' => true]);

if (!$result['success']) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch portfolio item']);
    exit;
}

if (empty($result['data'])) {
    ob_end_clean();
    http_response_code(404);
    echo json_encode(['error' => 'Portfolio item not found']);
    exit;
}

$item = $result['data'][0];

// Parse gallery_images — stored as JSON array or newline-separated URLs
$galleryImages = [];
if (!empty($item['gallery_images'])) {
    $decoded = json_decode($item['gallery_images'], true);
    if (is_array($decoded)) {
        $galleryImages = array_values(array_filter($decoded));
    } else {
        // Fallback: newline-separated
        $galleryImages = array_values(array_filter(array_map('trim', explode("\n", $item['gallery_images']))));
    }
}

// Parse comma-separated fields
$toolsList = !empty($item['tools_used'])
    ? array_values(array_filter(array_map('trim', explode(',', $item['tools_used']))))
    : [];

$deliverablesList = !empty($item['deliverables'])
    ? array_values(array_filter(array_map('trim', explode(',', $item['deliverables']))))
    : [];

// Attach parsed fields
$item['gallery_images']    = $galleryImages;
$item['tools_list']        = $toolsList;
$item['deliverables_list'] = $deliverablesList;

// Fetch related items — same category, exclude current, max 3
$relatedItems = [];
$relatedResult = $db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc,created_at.desc');

if ($relatedResult['success'] && !empty($relatedResult['data'])) {
    $category = $item['category'] ?? '';
    $related = array_filter($relatedResult['data'], function ($r) use ($itemId, $category) {
        return $r['id'] !== $itemId && ($r['category'] ?? '') === $category;
    });
    $relatedItems = array_values(array_slice($related, 0, 3));
}

ob_end_clean();
echo json_encode([
    'data'    => $item,
    'related' => $relatedItems,
]);
