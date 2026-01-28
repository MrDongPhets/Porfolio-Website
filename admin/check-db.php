<?php
require_once '../config/config.php';

echo "<h2>Database Check</h2>";
echo "<pre>";

// Check hero section
$result = $db->select('hero_section', '*');
echo "=== ALL HERO SECTIONS ===\n";
print_r($result);

echo "\n\n=== ACTIVE HERO SECTION ===\n";
$result = $db->select('hero_section', '*', ['is_active' => true]);
if ($result['success'] && !empty($result['data'])) {
    $hero = $result['data'][0];
    echo "ID: " . $hero['id'] . "\n";
    echo "Title: " . $hero['title'] . "\n";
    echo "Image URL: " . $hero['image_url'] . "\n";
    echo "Updated: " . $hero['updated_at'] . "\n";
    
    // Check if it's Supabase URL
    if (strpos($hero['image_url'], 'supabase') !== false) {
        echo "\n✅ Using Supabase Storage!\n";
    } else {
        echo "\n❌ Still using local path!\n";
    }
}

echo "</pre>";

echo "<p><a href='hero.php'>← Back to Hero Editor</a></p>";
?>