<?php
// admin/create-user.php - Create Admin User Tool
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔧 Creating Admin User with Service Role</h2>";
echo "<pre>";

// Load environment
require_once '../config/database.php';

// Use SERVICE ROLE key to bypass RLS
$serviceKey = getenv('SUPABASE_SERVICE_KEY') ?: getenv('SUPABASE_KEY');
$supabaseUrl = getenv('SUPABASE_URL');

if (!$serviceKey || !$supabaseUrl) {
    die("❌ Supabase credentials not found in .env file");
}

echo "✅ Credentials loaded\n";
echo "Using URL: " . $supabaseUrl . "\n\n";

// Generate password hash
$password = 'admin123';
$password_hash = password_hash($password, PASSWORD_DEFAULT);

echo "✅ Password hash generated:\n";
echo $password_hash . "\n\n";

// Prepare data
$data = [
    'email' => 'admin@mustarddigital.com',
    'password_hash' => $password_hash,
    'full_name' => 'Admin User',
    'role' => 'admin',
    'is_active' => true
];

echo "📤 Sending request to Supabase...\n";

// Make request using SERVICE ROLE key
$ch = curl_init();
$url = $supabaseUrl . '/rest/v1/users';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'apikey: ' . $serviceKey,
    'Authorization: Bearer ' . $serviceKey,
    'Content-Type: application/json',
    'Prefer: return=representation'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: " . $httpCode . "\n";
echo "Response: " . $response . "\n\n";

if ($httpCode >= 200 && $httpCode < 300) {
    echo "✅ SUCCESS! Admin user created!\n\n";
    echo "Login Credentials:\n";
    echo "Email: admin@mustarddigital.com\n";
    echo "Password: admin123\n\n";
    echo "🔗 <a href='index.php'>Go to Admin Login</a>\n\n";
    echo "⚠️ IMPORTANT: Delete this file (create-user.php) after logging in!\n";
} else {
    echo "❌ FAILED to create user\n";
    echo "Error: " . $error . "\n";
    echo "Response: " . $response . "\n\n";
    
    echo "📋 Troubleshooting:\n";
    echo "1. Make sure SUPABASE_SERVICE_KEY is set in .env file\n";
    echo "2. Check if .env file exists\n";
    echo "3. Verify Supabase credentials are correct\n";
}

echo "</pre>";
?>