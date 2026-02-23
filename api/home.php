<?php
/**
 * GET /api/home.php
 *
 * Returns all data needed for the homepage in a single request:
 * hero, about, services, work steps, portfolio (6 featured), testimonials.
 *
 * Response:
 * {
 *   "hero":         { ...hero_section row },
 *   "about":        { ...about_section row },
 *   "services":     [ ...services ],
 *   "work_steps":   [ ...work_steps ],
 *   "portfolio":    [ ...6 featured/latest portfolio items ],
 *   "testimonials": [ ...testimonials ]
 * }
 */

ob_start();

require_once '../config/config.php';

header('Content-Type: application/json');

$response = [];
$hasError = false;

// Hero section
$r = $db->select('hero_section', '*', ['is_active' => true], 'created_at.desc', 1);
$response['hero'] = ($r['success'] && !empty($r['data'])) ? $r['data'][0] : null;

// About section
$r = $db->select('about_section', '*', ['is_active' => true], 'updated_at.desc', 1);
$response['about'] = ($r['success'] && !empty($r['data'])) ? $r['data'][0] : null;

// Services
$r = $db->select('services', '*', ['is_active' => true], 'display_order.asc');
$response['services'] = ($r['success']) ? ($r['data'] ?? []) : [];

// Work steps
$r = $db->select('work_steps', '*', ['is_active' => true], 'step_order.asc');
$response['work_steps'] = ($r['success']) ? ($r['data'] ?? []) : [];

// Portfolio — featured first, then latest, max 6
$r = $db->select('portfolio_items', '*', ['is_active' => true], 'is_featured.desc,created_at.desc', 6);
$response['portfolio'] = ($r['success']) ? ($r['data'] ?? []) : [];

// Testimonials
$r = $db->select('testimonials', '*', ['is_active' => true], 'display_order.asc');
$response['testimonials'] = ($r['success']) ? ($r['data'] ?? []) : [];

ob_end_clean();
echo json_encode($response);
