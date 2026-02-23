<?php
/**
 * GET /api/testimonials.php
 * GET /api/testimonials.php?limit=3
 *
 * Returns active testimonials ordered by display_order.
 *
 * Response:
 * {
 *   "data": [ ...testimonials ],
 *   "total": 6
 * }
 */

ob_start();

require_once '../config/config.php';

header('Content-Type: application/json');

$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : null;

$result = $db->select('testimonials', '*', ['is_active' => true], 'display_order.asc');

if (!$result['success']) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch testimonials']);
    exit;
}

$testimonials = $result['data'] ?? [];

if ($limit && $limit > 0) {
    $testimonials = array_slice($testimonials, 0, $limit);
}

ob_end_clean();
echo json_encode([
    'data'  => $testimonials,
    'total' => count($testimonials),
]);
