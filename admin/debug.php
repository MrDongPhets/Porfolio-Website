<?php
// admin/debug.php - Debug Login Issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔍 Debug Information</h2>";
echo "<pre>";

// Test 1: Check if config loads
echo "=== TEST 1: Loading Config ===\n";
try {
    require_once '../config/config.php';
    echo "✅ Config loaded successfully\n\n";
} catch (Exception $e) {
    echo "❌ Config error: " . $e->getMessage() . "\n\n";
    die();
}

// Test 2: Check environment variables
echo "=== TEST 2: Environment Variables ===\n";
echo "SUPABASE_URL: " . (getenv('SUPABASE_URL') ? '✅ Set' : '❌ Not set') . "\n";
echo "SUPABASE_KEY: " . (getenv('SUPABASE_KEY') ? '✅ Set' : '❌ Not set') . "\n";
echo "SITE_URL: " . SITE_URL . "\n\n";

// Test 3: Check database connection
echo "=== TEST 3: Database Connection ===\n";
try {
    global $db;
    if ($db) {
        echo "✅ Database client initialized\n\n";
    } else {
        echo "❌ Database client not initialized\n\n";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n\n";
}

// Test 4: Query users table
echo "=== TEST 4: Query Users Table ===\n";
try {
    $result = $db->select('users', '*');
    echo "API Response:\n";
    print_r($result);
    echo "\n";
    
    if ($result['success']) {
        echo "✅ Users table accessible\n";
        echo "Users found: " . count($result['data']) . "\n\n";
        
        if (!empty($result['data'])) {
            echo "First user:\n";
            $user = $result['data'][0];
            echo "- Email: " . $user['email'] . "\n";
            echo "- Name: " . $user['full_name'] . "\n";
            echo "- Active: " . ($user['is_active'] ? 'Yes' : 'No') . "\n";
            echo "- Password Hash exists: " . (!empty($user['password_hash']) ? 'Yes' : 'No') . "\n\n";
        }
    } else {
        echo "❌ Failed to query users table\n";
        echo "Error: " . print_r($result['error'], true) . "\n\n";
    }
} catch (Exception $e) {
    echo "❌ Query error: " . $e->getMessage() . "\n\n";
}

// Test 5: Password verification
echo "=== TEST 5: Password Hash Test ===\n";
$testPassword = 'admin123';
$testHash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
$verify = password_verify($testPassword, $testHash);
echo "Test password: 'admin123'\n";
echo "Verification: " . ($verify ? '✅ Correct' : '❌ Failed') . "\n\n";

// Test 6: Session check
echo "=== TEST 6: Session ===\n";
echo "Session status: " . session_status() . " (1=disabled, 2=active)\n";
echo "Session ID: " . (session_id() ? session_id() : 'No session') . "\n";
echo "Is logged in: " . (isLoggedIn() ? 'Yes' : 'No') . "\n\n";

// Test 7: Form submission test
echo "=== TEST 7: Form Submission Test ===\n";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "✅ POST request received\n";
    echo "Email: " . ($_POST['email'] ?? 'not set') . "\n";
    echo "Password: " . (isset($_POST['password']) ? 'provided' : 'not set') . "\n\n";
    
    // Try actual login
    $email = clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    echo "Cleaned email: $email\n";
    
    $result = $db->select('users', '*', ['email' => $email]);
    echo "Query result:\n";
    print_r($result);
    echo "\n";
    
    if ($result['success'] && !empty($result['data'])) {
        $user = $result['data'][0];
        echo "User found: " . $user['email'] . "\n";
        echo "Active: " . ($user['is_active'] ? 'Yes' : 'No') . "\n";
        
        if (password_verify($password, $user['password_hash'])) {
            echo "✅ Password verified successfully!\n";
        } else {
            echo "❌ Password verification failed\n";
        }
    } else {
        echo "❌ User not found or query failed\n";
    }
} else {
    echo "No POST request yet. Submit the form below to test.\n\n";
}

echo "</pre>";

// Test form
?>
<hr>
<h3>Test Login Form</h3>
<form method="POST" action="">
    <div>
        <label>Email:</label><br>
        <input type="email" name="email" value="admin@mustarddigital.com" style="padding:8px; width:300px;">
    </div>
    <div style="margin-top:10px">
        <label>Password:</label><br>
        <input type="password" name="password" value="admin123" style="padding:8px; width:300px;">
    </div>
    <div style="margin-top:10px">
        <button type="submit" style="padding:10px 20px; background:#184d37; color:white; border:none; cursor:pointer;">Test Login</button>
    </div>
</form>

<hr>
<p><a href="index.php">← Back to Admin</a></p>