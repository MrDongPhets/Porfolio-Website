<?php
/**
 * POST /api/contact.php
 *
 * Accepts contact form submission, saves to DB, and forwards to Web3Forms.
 *
 * Request body (application/x-www-form-urlencoded or application/json):
 * {
 *   "name":       string (required)
 *   "email":      string (required, valid email)
 *   "phone":      string (optional)
 *   "service":    string (optional)
 *   "message":    string (required)
 *   "newsletter": bool   (optional)
 * }
 *
 * Response:
 * { "success": true }                       — submitted OK
 * { "success": false, "error": "..." }      — validation or server error
 */

ob_start();

require_once '../config/config.php';

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Support both form-encoded and JSON body
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (str_contains($contentType, 'application/json')) {
    $body = json_decode(file_get_contents('php://input'), true) ?? [];
} else {
    $body = $_POST;
}

// Sanitize inputs
$name       = clean($body['name']      ?? '');
$email      = clean($body['email']     ?? '');
$phone      = clean($body['phone']     ?? '');
$service    = clean($body['service']   ?? '');
$message    = clean($body['message']   ?? '');
$newsletter = !empty($body['newsletter']);

// Validate required fields
$errors = [];
if (empty($name))                        $errors[] = 'Name is required';
if (empty($email))                       $errors[] = 'Email is required';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address';
if (empty($message))                     $errors[] = 'Message is required';

if (!empty($errors)) {
    ob_end_clean();
    http_response_code(422);
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Save to DB (contacts table — create if it doesn't exist)
$adminDb = getAdminDb();
$dbResult = $adminDb->insert('contacts', [
    'name'       => $name,
    'email'      => $email,
    'phone'      => $phone,
    'service'    => $service,
    'message'    => $message,
    'newsletter' => $newsletter,
]);

// Forward to Web3Forms (same key as the existing contact form)
$web3FormsKey = getenv('WEB3FORMS_KEY') ?: 'c143c009-815d-4a18-b787-9db4e69b864a';

$ch = curl_init('https://api.web3forms.com/submit');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query([
        'access_key' => $web3FormsKey,
        'name'       => $name,
        'email'      => $email,
        'phone'      => $phone,
        'service'    => $service,
        'message'    => $message,
    ]),
    CURLOPT_TIMEOUT => 10,
]);
curl_exec($ch);
curl_close($ch);

ob_end_clean();
echo json_encode(['success' => true]);
