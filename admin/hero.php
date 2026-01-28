<?php
// admin/hero.php - Hero Section Editor
require_once '../config/config.php';
requireLogin();

$pageTitle = 'Hero Section';

// Use admin DB (service key) for all admin operations
$adminDb = getAdminDb();

// Fetch current hero section data
$heroData = null;
$result = $adminDb->select('hero_section', '*', ['is_active' => true], 'created_at.desc', 1);
if ($result['success'] && !empty($result['data'])) {
    $heroData = $result['data'][0];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'update_hero') {
        $title = clean($_POST['title'] ?? '');
        $subtitle = clean($_POST['subtitle'] ?? '');
        $cta_text = clean($_POST['cta_text'] ?? '');
        $cta_link = clean($_POST['cta_link'] ?? '');
        $current_image = $_POST['current_image'] ?? '';
        
        // Validate inputs
        if (empty($title)) {
            setFlash('error', 'Title is required');
        } else {
            $image_url = $current_image;
            
            // Handle image upload to Supabase Storage
            if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] === UPLOAD_ERR_OK) {
                $upload = uploadFileToSupabase($_FILES['hero_image'], 'MUSTARD', 'hero');
                
                if ($upload['success']) {
                    $image_url = $upload['url']; // Store the full public URL
                    error_log("Image uploaded successfully: " . $image_url);
                    
                    // Note: Old images in Supabase would need to be deleted via Storage API
                    // For now, we'll just update the reference
                } else {
                    error_log("Image upload failed: " . print_r($upload, true));
                    setFlash('error', 'Image upload failed: ' . $upload['error']);
                    redirect('/admin/hero.php');
                }
            } else {
                error_log("No new image uploaded, keeping current: " . $image_url);
            }
            
            // Prepare data
            $data = [
                'title' => $title,
                'subtitle' => $subtitle,
                'cta_text' => $cta_text,
                'cta_link' => $cta_link,
                'image_url' => $image_url,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Debug: Log what we're saving
            error_log("Saving hero data: " . print_r($data, true));
            
            // Update or insert
            if ($heroData) {
                $result = $adminDb->update('hero_section', $data, ['id' => $heroData['id']]);
                error_log("Update result: " . print_r($result, true));
            } else {
                $data['is_active'] = true;
                $result = $adminDb->insert('hero_section', $data);
                error_log("Insert result: " . print_r($result, true));
            }
            
            if ($result['success']) {
                setFlash('success', 'Hero section updated successfully!');
                redirect('/admin/hero.php');
            } else {
                setFlash('error', 'Failed to update hero section: ' . print_r($result['error'], true));
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="dashboard-content">
    <div class="page-header">
        <div>
            <h1>Hero Section</h1>
            <p>Edit the main hero section of your website</p>
        </div>
        <a href="<?php echo baseUrl(); ?>" target="_blank" class="btn btn-outline">
            <i class="fas fa-external-link-alt"></i> Preview Site
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Edit Hero Content</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_hero">
                <input type="hidden" name="current_image" value="<?php echo e($heroData['image_url'] ?? ''); ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Hero Title *</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="form-control"
                            value="<?php echo e($heroData['title'] ?? ''); ?>"
                            placeholder="Designs That Speak, Brands That Shine"
                            required
                        >
                        <small class="form-text">Main headline that grabs attention</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="subtitle">Subtitle / Description</label>
                        <textarea 
                            id="subtitle" 
                            name="subtitle" 
                            class="form-control"
                            rows="3"
                            placeholder="From logos and brochures to stunning landing pages..."
                        ><?php echo e($heroData['subtitle'] ?? ''); ?></textarea>
                        <small class="form-text">Supporting text that explains your value proposition</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cta_text">Call-to-Action Button Text</label>
                        <input 
                            type="text" 
                            id="cta_text" 
                            name="cta_text" 
                            class="form-control"
                            value="<?php echo e($heroData['cta_text'] ?? ''); ?>"
                            placeholder="Let's Create"
                        >
                        <small class="form-text">Text shown on the primary button</small>
                    </div>

                    <div class="form-group">
                        <label for="cta_link">CTA Button Link</label>
                        <input 
                            type="text" 
                            id="cta_link" 
                            name="cta_link" 
                            class="form-control"
                            value="<?php echo e($heroData['cta_link'] ?? ''); ?>"
                            placeholder="#contact"
                        >
                        <small class="form-text">Where the button should link to (e.g., #contact, /contact)</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="hero_image">Hero Image</label>
                        
                        <?php if (!empty($heroData['image_url'])): ?>
                            <div class="image-preview">
                                <?php 
                                // Check if it's a full URL (Supabase) or relative path (old local files)
                                $imageUrl = $heroData['image_url'];
                                if (strpos($imageUrl, 'http') === 0) {
                                    // Full URL from Supabase
                                    $displayUrl = $imageUrl;
                                } else {
                                    // Old relative path - convert to absolute
                                    $displayUrl = baseUrl($imageUrl);
                                }
                                ?>
                                <img src="<?php echo e($displayUrl); ?>" alt="Current hero image" onerror="this.parentElement.innerHTML='<p style=color:red>Image not found</p>'">
                                <p class="image-name"><?php echo basename($heroData['image_url']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <input 
                            type="file" 
                            id="hero_image" 
                            name="hero_image" 
                            class="form-control"
                            accept="image/*"
                        >
                        <small class="form-text">Recommended size: 1200x800px. Leave empty to keep current image.</small>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="index.php" class="btn btn-outline">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Section -->
    <div class="card">
        <div class="card-header">
            <h2>Current Preview</h2>
        </div>
        <div class="card-body">
            <div class="hero-preview">
                <div class="hero-preview-content">
                    <h1><?php echo e($heroData['title'] ?? 'No title set'); ?></h1>
                    <p><?php echo e($heroData['subtitle'] ?? 'No subtitle set'); ?></p>
                    <?php if (!empty($heroData['cta_text'])): ?>
                        <button class="preview-btn"><?php echo e($heroData['cta_text']); ?></button>
                    <?php endif; ?>
                </div>
                <?php if (!empty($heroData['image_url'])): ?>
                    <div class="hero-preview-image">
                        <?php 
                        // Handle both Supabase URLs and old relative paths
                        $imageUrl = $heroData['image_url'];
                        $displayUrl = (strpos($imageUrl, 'http') === 0) ? $imageUrl : baseUrl($imageUrl);
                        ?>
                        <img src="<?php echo e($displayUrl); ?>" alt="Hero preview" onerror="this.style.display='none'">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.form-row {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-row:has(.form-group + .form-group) {
    grid-template-columns: 1fr 1fr;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--gray-700);
    font-size: 14px;
}

.form-control {
    padding: 12px 16px;
    border: 1px solid var(--gray-300);
    border-radius: 8px;
    font-size: 14px;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(24, 77, 55, 0.1);
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.form-text {
    margin-top: 6px;
    font-size: 12px;
    color: var(--gray-500);
}

.image-preview {
    margin-bottom: 16px;
    padding: 16px;
    background: var(--gray-50);
    border-radius: 8px;
    text-align: center;
}

.image-preview img {
    max-width: 300px;
    max-height: 200px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.image-name {
    margin-top: 8px;
    font-size: 12px;
    color: var(--gray-600);
}

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--gray-200);
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
}

/* Hero Preview */
.hero-preview {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
    padding: 32px;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-radius: 12px;
}

.hero-preview-content h1 {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 16px;
}

.hero-preview-content p {
    color: var(--gray-600);
    margin-bottom: 20px;
    line-height: 1.6;
}

.preview-btn {
    background: var(--primary);
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: default;
}

.hero-preview-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .form-row:has(.form-group + .form-group) {
        grid-template-columns: 1fr;
    }
    
    .hero-preview {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?>