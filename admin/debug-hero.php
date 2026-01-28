<?php
// admin/debug-hero.php - Debug Hero Image
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/config.php';

echo "<h2>🔍 Hero Image Debug - Supabase Storage Edition</h2>";
echo "<pre>";

// Check hero section data
echo "=== HERO SECTION DATA FROM DATABASE ===\n";
$result = $db->select('hero_section', '*', ['is_active' => true]);
if ($result['success'] && !empty($result['data'])) {
    $hero = $result['data'][0];
    echo "Title: " . $hero['title'] . "\n";
    echo "Image URL from DB: " . $hero['image_url'] . "\n";
    echo "Is Supabase URL: " . (strpos($hero['image_url'], 'supabase') !== false ? 'YES ✅' : 'NO ❌') . "\n\n";
    
    echo "=== SUPABASE CONFIGURATION ===\n";
    echo "Supabase URL: " . getenv('SUPABASE_URL') . "\n";
    echo "Service Key set: " . (getenv('SUPABASE_SERVICE_KEY') ? 'YES ✅' : 'NO ❌') . "\n\n";
    
    echo "=== URL DISPLAY TEST ===\n";
    echo "Using getImageUrl(): " . getImageUrl($hero['image_url']) . "\n\n";
    
} else {
    echo "❌ No hero section found\n";
}

echo "</pre>";

// Test upload to Supabase
echo "<h3>Test Supabase Upload</h3>";
echo "<form method='POST' enctype='multipart/form-data' style='padding:20px; background:#f0f0f0; border-radius:8px;'>";
echo "<input type='file' name='test_image' accept='image/*' required><br><br>";
echo "<button type='submit' name='test_upload' style='padding:10px 20px; background:#184d37; color:white; border:none; cursor:pointer;'>Test Upload to Supabase</button>";
echo "</form>";

if (isset($_POST['test_upload']) && isset($_FILES['test_image'])) {
    echo "<h4>Upload Test Result:</h4>";
    echo "<pre>";
    $result = uploadFileToSupabase($_FILES['test_image'], 'MUSTARD', 'test');
    print_r($result);
    
    if ($result['success']) {
        echo "\n✅ Upload successful!\n";
        echo "URL: " . $result['url'] . "\n";
        echo "\nImage preview:\n";
        echo "</pre>";
        echo "<img src='" . $result['url'] . "' style='max-width:400px; border:2px solid green;'>";
    } else {
        echo "\n❌ Upload failed!\n";
        echo "</pre>";
    }
}

// Display current hero image
if (isset($hero) && !empty($hero['image_url'])) {
    echo "<h3>Current Hero Image:</h3>";
    $url = getImageUrl($hero['image_url']);
    echo "<p>URL: <code>" . htmlspecialchars($url) . "</code></p>";
    echo "<img src='" . htmlspecialchars($url) . "' style='max-width:600px; border:2px solid #184d37;' onerror='this.parentElement.innerHTML=\"<p style=color:red>❌ Failed to load image</p>\"'>";
}
?>

<hr>
<p><a href="hero.php">← Back to Hero Editor</a></p>