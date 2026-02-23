<?php
/**
 * GET /api/services.php
 *
 * Returns all active services ordered by display_order.
 *
 * Response:
 * {
 *   "data": [ ...services ],
 *   "total": 6
 * }
 */

ob_start();

require_once '../config/config.php';

header('Content-Type: application/json');

$result = $db->select('services', '*', ['is_active' => true], 'display_order.asc');

if (!$result['success']) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch services']);
    exit;
}

$services = $result['data'] ?? [];

ob_end_clean();
echo json_encode([
    'data'  => $services,
    'total' => count($services),
]);
