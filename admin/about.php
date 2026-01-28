<?php
// admin/about.php - About Section Editor
require_once '../config/config.php';
requireLogin();

$pageTitle = 'About Section';

// Use admin DB (service key) for all admin operations
$adminDb = getAdminDb();

// Fetch current about section data
$aboutData = null;
$result = $adminDb->select('about_section', '*', ['is_active' => true], 'updated_at.desc', 1);
if ($result['success'] && !empty($result['data'])) {
    $aboutData = $result['data'][0];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'update_about') {
        $title = clean($_POST['title'] ?? '');
        $content = clean($_POST['content'] ?? '');
        $current_image = $_POST['current_image'] ?? '';
        
        // Validate inputs
        if (empty($title) || empty($content)) {
            setFlash('error', 'Title and content are required');
        } else {
            $image_url = $current_image;
            
            // Handle image upload to Supabase Storage
            if (isset($_FILES['about_image']) && $_FILES['about_image']['error'] === UPLOAD_ERR_OK) {
                $upload = uploadFileToSupabase($_FILES['about_image'], 'MUSTARD', 'about');
                
                if ($upload['success']) {
                    $image_url = $upload['url']; // Store the full public URL
                    error_log("Image uploaded successfully: " . $image_url);
                } else {
                    error_log("Image upload failed: " . print_r($upload, true));
                    setFlash('error', 'Image upload failed: ' . $upload['error']);
                    redirect('/admin/about.php');
                }
            } else {
                error_log("No new image uploaded, keeping current: " . $image_url);
            }
            
            // Prepare data
            $data = [
                'title' => $title,
                'content' => $content,
                'image_url' => $image_url,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Debug: Log what we're saving
            error_log("Saving about data: " . print_r($data, true));
            
            // Update or insert
            if ($aboutData) {
                $result = $adminDb->update('about_section', $data, ['id' => $aboutData['id']]);
                error_log("Update result: " . print_r($result, true));
            } else {
                $data['is_active'] = true;
                $result = $adminDb->insert('about_section', $data);
                error_log("Insert result: " . print_r($result, true));
            }
            
            if ($result['success']) {
                setFlash('success', 'About section updated successfully!');
                redirect('/admin/about.php');
            } else {
                setFlash('error', 'Failed to update about section: ' . print_r($result['error'], true));
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="dashboard-content">
    <div class="page-header">
        <div>
            <h1>About Section</h1>
            <p>Edit the about section of your website</p>
        </div>
        <a href="<?php echo baseUrl(); ?>#about" target="_blank" class="btn btn-outline">
            <i class="fas fa-external-link-alt"></i> Preview Site
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Edit About Content</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update_about">
                <input type="hidden" name="current_image" value="<?php echo e($aboutData['image_url'] ?? ''); ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">About Title *</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="form-control"
                            value="<?php echo e($aboutData['title'] ?? ''); ?>"
                            placeholder="About MustardDigital"
                            required
                        >
                        <small class="form-text">Main heading for the about section</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="content">About Content *</label>
                        <textarea 
                            id="content" 
                            name="content" 
                            class="form-control"
                            rows="8"
                            placeholder="Welcome to our creative studio..."
                            required
                        ><?php echo e($aboutData['content'] ?? ''); ?></textarea>
                        <small class="form-text">Tell your story, your mission, and what makes you unique</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="about_image">About Image</label>
                        
                        <?php if (!empty($aboutData['image_url'])): ?>
                            <div class="image-preview">
                                <?php 
                                // Check if it's a full URL (Supabase) or relative path (old local files)
                                $imageUrl = $aboutData['image_url'];
                                if (strpos($imageUrl, 'http') === 0) {
                                    // Full URL from Supabase
                                    $displayUrl = $imageUrl;
                                } else {
                                    // Old relative path - convert to absolute
                                    $displayUrl = baseUrl($imageUrl);
                                }
                                ?>
                                <img src="<?php echo e($displayUrl); ?>" alt="Current about image" onerror="this.parentElement.innerHTML='<p style=color:red>Image not found</p>'">
                                <p class="image-name"><?php echo basename($aboutData['image_url']); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <input 
                            type="file" 
                            id="about_image" 
                            name="about_image" 
                            class="form-control"
                            accept="image/*"
                        >
                        <small class="form-text">Recommended size: 800x800px. Leave empty to keep current image.</small>
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
            <div class="about-preview">
                <?php if (!empty($aboutData['image_url'])): ?>
                    <div class="about-preview-image">
                        <?php 
                        $imageUrl = $aboutData['image_url'];
                        $displayUrl = (strpos($imageUrl, 'http') === 0) ? $imageUrl : baseUrl($imageUrl);
                        ?>
                        <img src="<?php echo e($displayUrl); ?>" alt="About preview" onerror="this.style.display='none'">
                    </div>
                <?php endif; ?>
                <div class="about-preview-content">
                    <h2><?php echo e($aboutData['title'] ?? 'No title set'); ?></h2>
                    <p><?php echo nl2br(e($aboutData['content'] ?? 'No content set')); ?></p>
                </div>
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
    min-height: 150px;
    line-height: 1.6;
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

/* About Preview */
.about-preview {
    display: grid;
    grid-template-columns: 400px 1fr;
    gap: 40px;
    align-items: center;
    padding: 32px;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-radius: 12px;
}

.about-preview-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.about-preview-content h2 {
    font-size: 28px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 16px;
}

.about-preview-content p {
    color: var(--gray-600);
    line-height: 1.8;
    white-space: pre-wrap;
}

@media (max-width: 768px) {
    .about-preview {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?>