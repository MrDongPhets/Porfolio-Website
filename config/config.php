<?php
// config/config.php - Main Configuration File

// Error reporting (change in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Timezone
date_default_timezone_set('Asia/Manila');

// Session configuration - MUST be set BEFORE session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

// Start session AFTER configuring session settings
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load environment variables
function loadEnv($path) {
    if (!file_exists($path)) {
        die('.env file not found. Please create one from .env.example');
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse line
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\\1$/', $value, $matches)) {
                $value = $matches[2];
            }
            
            // Set environment variable
            if (!array_key_exists($key, $_ENV)) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }
    }
}

// Load .env file
loadEnv(__DIR__ . '/../.env');

// Define constants
define('SITE_URL', getenv('SITE_URL') ?: 'http://localhost/mustarddigital');
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'admin@mustarddigital.com');
define('SITE_NAME', 'MustardDigital');
define('UPLOAD_DIR', __DIR__ . '/../assets/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Database
define('SUPABASE_URL', getenv('SUPABASE_URL'));
define('SUPABASE_KEY', getenv('SUPABASE_KEY'));

// Include required files
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Global database instance
global $db;
$db = getSupabaseClient();

// Site settings cache
function getSiteSettings() {
    static $settings = null;
    
    if ($settings === null) {
        global $db;
        $result = $db->select('site_settings', '*');
        
        if ($result['success'] && !empty($result['data'])) {
            $settings = [];
            foreach ($result['data'] as $setting) {
                $settings[$setting['setting_key']] = $setting['setting_value'];
            }
        } else {
            $settings = [];
        }
    }
    
    return $settings;
}

// Get single setting
function getSetting($key, $default = '') {
    $settings = getSiteSettings();
    return $settings[$key] ?? $default;
}

// Update setting
function updateSetting($key, $value) {
    global $db;
    
    // Check if setting exists
    $result = $db->select('site_settings', '*', ['setting_key' => $key]);
    
    if ($result['success'] && !empty($result['data'])) {
        // Update existing setting
        return $db->update('site_settings', ['setting_value' => $value], ['setting_key' => $key]);
    } else {
        // Insert new setting
        return $db->insert('site_settings', [
            'setting_key' => $key,
            'setting_value' => $value
        ]);
    }
}

// Helper to get base URL
function baseUrl($path = '') {
    $url = SITE_URL;
    if ($path) {
        $url .= '/' . ltrim($path, '/');
    }
    return $url;
}

// Helper to get asset URL
function asset($path) {
    return baseUrl('assets/' . ltrim($path, '/'));
}

// Admin URL helper
function adminUrl($path = '') {
    return baseUrl('admin/' . ltrim($path, '/'));
}