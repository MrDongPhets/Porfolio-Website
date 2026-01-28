<?php
// includes/functions.php - Helper Functions

/**
 * Sanitize input data
 */
function clean($data) {
    if (is_array($data)) {
        return array_map('clean', $data);
    }
    
    $data = trim($data);
    $data = stripslashes($data);
    // Don't use htmlspecialchars here - only use when outputting to HTML
    return $data;
}

/**
 * Validate email
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Redirect to a page
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/admin/index.php');
    }
}

/**
 * Hash password
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Set flash message
 */
function setFlash($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

/**
 * Get and clear flash message
 */
function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Display flash message HTML
 */
function displayFlash() {
    $flash = getFlash();
    if ($flash) {
        $type = $flash['type']; // success, error, warning, info
        $message = $flash['message'];
        $colors = [
            'success' => 'background: #d4edda; color: #155724; border-color: #c3e6cb;',
            'error' => 'background: #f8d7da; color: #721c24; border-color: #f5c6cb;',
            'warning' => 'background: #fff3cd; color: #856404; border-color: #ffeaa7;',
            'info' => 'background: #d1ecf1; color: #0c5460; border-color: #bee5eb;'
        ];
        $style = $colors[$type] ?? $colors['info'];
        
        echo '<div style="padding: 12px 20px; margin-bottom: 20px; border: 1px solid; border-radius: 4px; ' . $style . '">';
        echo htmlspecialchars($message);
        echo '</div>';
    }
}

/**
 * Format date
 */
function formatDate($date, $format = 'M d, Y') {
    return date($format, strtotime($date));
}

/**
 * Time ago format
 */
function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;
    
    if ($diff < 60) return 'just now';
    if ($diff < 3600) return floor($diff / 60) . ' minutes ago';
    if ($diff < 86400) return floor($diff / 3600) . ' hours ago';
    if ($diff < 604800) return floor($diff / 86400) . ' days ago';
    
    return date('M d, Y', $timestamp);
}

/**
 * Get admin database client (uses service key, bypasses RLS)
 */
function getAdminDb() {
    return getSupabaseClient(true); // Use service key
}

/**
 * Get image URL - handles both Supabase URLs and local paths
 */
function getImageUrl($path) {
    if (empty($path)) {
        return '';
    }
    
    // If it's already a full URL (Supabase), return as-is
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }
    
    // Otherwise, treat as local path and convert to full URL
    return baseUrl($path);
}

/**
 * Upload file to Supabase Storage
 */
function uploadFileToSupabase($file, $bucket = 'MUSTARD', $folder = '') {
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        return ['success' => false, 'error' => 'No file uploaded'];
    }
    
    // Check file size (5MB max)
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'error' => 'File too large. Max 5MB allowed'];
    }
    
    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        return ['success' => false, 'error' => 'Invalid file type. Only images allowed.'];
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    
    // Add folder prefix if provided
    $filePath = $folder ? $folder . '/' . $filename : $filename;
    
    // USE SERVICE KEY for uploads (bypasses RLS)
    $supabaseUrl = getenv('SUPABASE_URL');
    $serviceKey = getenv('SUPABASE_SERVICE_KEY') ?: getenv('SUPABASE_KEY');
    
    $url = $supabaseUrl . '/storage/v1/object/' . $bucket . '/' . $filePath;
    
    // Read file content
    $fileContent = file_get_contents($file['tmp_name']);
    
    // Upload using cURL with service key
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'apikey: ' . $serviceKey,
        'Authorization: Bearer ' . $serviceKey,
        'Content-Type: ' . $mimeType,
        'x-upsert: true'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    // Handle response
    if ($curlError) {
        return ['success' => false, 'error' => 'CURL Error: ' . $curlError];
    }
    
    if ($httpCode >= 200 && $httpCode < 300) {
        // Get public URL
        $publicUrl = $supabaseUrl . '/storage/v1/object/public/' . $bucket . '/' . $filePath;
        
        return [
            'success' => true,
            'filename' => $filename,
            'path' => $filePath,
            'url' => $publicUrl,
            'bucket' => $bucket
        ];
    } else {
        $errorData = json_decode($response, true);
        return [
            'success' => false, 
            'error' => 'HTTP ' . $httpCode . ': ' . ($errorData['message'] ?? $response),
            'details' => $errorData
        ];
    }
}

/**
 * Upload file (Legacy - local storage)
 */
function uploadFile($file, $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']) {
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        return ['success' => false, 'error' => 'No file uploaded'];
    }
    
    // Check file size (5MB max)
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'error' => 'File too large. Max 5MB allowed'];
    }
    
    // Check file type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        return ['success' => false, 'error' => 'Invalid file type'];
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    
    // Upload directory
    $uploadDir = __DIR__ . '/../assets/uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $destination = $uploadDir . $filename;
    
    // Move file
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return [
            'success' => true,
            'filename' => $filename,
            'path' => 'assets/uploads/' . $filename,
            'url' => '/assets/uploads/' . $filename
        ];
    } else {
        return ['success' => false, 'error' => 'Failed to move uploaded file'];
    }
}

/**
 * Delete file
 */
function deleteFile($path) {
    $fullPath = __DIR__ . '/../' . $path;
    if (file_exists($fullPath)) {
        return unlink($fullPath);
    }
    return false;
}

/**
 * Truncate text
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . $suffix;
    }
    return $text;
}

/**
 * Generate slug from text
 */
function generateSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

/**
 * Get current page name
 */
function getCurrentPage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}

/**
 * Check if current page is active
 */
function isActivePage($page) {
    return getCurrentPage() === $page ? 'active' : '';
}

/**
 * Escape output
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Convert array to HTML attributes
 */
function arrayToAttributes($array) {
    $attributes = [];
    foreach ($array as $key => $value) {
        $attributes[] = $key . '="' . htmlspecialchars($value) . '"';
    }
    return implode(' ', $attributes);
}

/**
 * Debug helper
 */
function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

/**
 * Get user IP address
 */
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

/**
 * Rate limiting check
 */
function checkRateLimit($key, $maxAttempts = 5, $timeWindow = 300) {
    if (!isset($_SESSION['rate_limit'])) {
        $_SESSION['rate_limit'] = [];
    }
    
    $now = time();
    $attempts = isset($_SESSION['rate_limit'][$key]) ? $_SESSION['rate_limit'][$key] : [];
    
    // Remove old attempts
    $attempts = array_filter($attempts, function($timestamp) use ($now, $timeWindow) {
        return ($now - $timestamp) < $timeWindow;
    });
    
    if (count($attempts) >= $maxAttempts) {
        return false;
    }
    
    $attempts[] = $now;
    $_SESSION['rate_limit'][$key] = $attempts;
    
    return true;
}

/**
 * Pagination helper
 */
function paginate($total, $perPage = 10, $currentPage = 1) {
    $totalPages = ceil($total / $perPage);
    $offset = ($currentPage - 1) * $perPage;
    
    return [
        'total' => $total,
        'per_page' => $perPage,
        'current_page' => $currentPage,
        'total_pages' => $totalPages,
        'offset' => $offset,
        'has_previous' => $currentPage > 1,
        'has_next' => $currentPage < $totalPages
    ];
}