<?php
// admin/portfolio.php - Portfolio Manager
require_once '../config/config.php';
requireLogin();

$pageTitle = 'Portfolio';

// Use admin DB (service key)
$adminDb = getAdminDb();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    // AJAX: Upload a single gallery image and return its URL as JSON
    if ($_POST['action'] === 'upload_gallery_image') {
        ob_start(); // buffer any accidental PHP error output
        $response = ['success' => false, 'error' => 'Unknown error'];
        if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
            $upload = uploadFileToSupabase($_FILES['gallery_image'], 'MUSTARD', 'portfolio/gallery');
            $response = $upload;
        } elseif (isset($_FILES['gallery_image'])) {
            $phpErrors = [
                UPLOAD_ERR_INI_SIZE   => 'File exceeds server upload limit',
                UPLOAD_ERR_FORM_SIZE  => 'File exceeds form upload limit',
                UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded',
                UPLOAD_ERR_NO_FILE    => 'No file was sent',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temp folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            ];
            $code = $_FILES['gallery_image']['error'];
            $response = ['success' => false, 'error' => $phpErrors[$code] ?? 'Upload error code ' . $code];
        } else {
            $response = ['success' => false, 'error' => 'No file received'];
        }
        ob_end_clean(); // discard any PHP notices/warnings
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Add/Edit Portfolio Item
    if ($_POST['action'] === 'save_item') {
        $id = $_POST['id'] ?? null;
        $title = clean($_POST['title'] ?? '');
        $description = clean($_POST['description'] ?? '');
        $category = clean($_POST['category'] ?? '');
        $project_url = clean($_POST['project_url'] ?? '');
        $is_featured = isset($_POST['is_featured']) ? true : false;
        $current_image = $_POST['current_image'] ?? '';

        // Case study fields
        $slug = clean($_POST['slug'] ?? '');
        if (empty($slug)) $slug = generateSlug($title);
        $client_name  = clean($_POST['client_name'] ?? '');
        $role         = clean($_POST['role'] ?? '');
        $timeline     = clean($_POST['timeline'] ?? '');
        $tools_used   = clean($_POST['tools_used'] ?? '');
        $deliverables = clean($_POST['deliverables'] ?? '');
        $challenge    = clean($_POST['challenge'] ?? '');
        $solution     = clean($_POST['solution'] ?? '');
        $results      = clean($_POST['results'] ?? '');
        // gallery_images: all uploads already handled via AJAX, just read the final URL list
        $allGalleryUrls = json_decode($_POST['existing_gallery_json'] ?? '[]', true) ?: [];
        $gallery_images = !empty($allGalleryUrls) ? json_encode(array_values($allGalleryUrls)) : '';

        if (empty($title) || empty($category)) {
            setFlash('error', 'Title and category are required');
        } else {
            $image_url = $current_image;
            
            // Handle image upload
            if (isset($_FILES['portfolio_image']) && $_FILES['portfolio_image']['error'] === UPLOAD_ERR_OK) {
                $upload = uploadFileToSupabase($_FILES['portfolio_image'], 'MUSTARD', 'portfolio');
                
                if ($upload['success']) {
                    $image_url = $upload['url'];
                } else {
                    setFlash('error', 'Image upload failed: ' . $upload['error']);
                    redirect('/admin/portfolio.php');
                }
            }
            
            if (empty($image_url)) {
                setFlash('error', 'Image is required for portfolio items');
                redirect('/admin/portfolio.php');
            }
            
            $data = [
                'title'          => $title,
                'description'    => $description,
                'category'       => $category,
                'image_url'      => $image_url,
                'project_url'    => $project_url,
                'is_featured'    => $is_featured,
                'slug'           => $slug,
                'client_name'    => $client_name,
                'role'           => $role,
                'timeline'       => $timeline,
                'tools_used'     => $tools_used,
                'deliverables'   => $deliverables,
                'challenge'      => $challenge,
                'solution'       => $solution,
                'results'        => $results,
                'gallery_images' => $gallery_images,
                'updated_at'     => date('Y-m-d H:i:s')
            ];
            
            if ($id) {
                // Update existing
                $result = $adminDb->update('portfolio_items', $data, ['id' => $id]);
                $message = 'Portfolio item updated successfully!';
            } else {
                // Create new
                $data['is_active'] = true;
                $data['display_order'] = 0;
                $result = $adminDb->insert('portfolio_items', $data);
                $message = 'Portfolio item created successfully!';
            }
            
            if ($result['success']) {
                setFlash('success', $message);
            } else {
                setFlash('error', 'Failed to save portfolio item');
            }
        }
        redirect('/admin/portfolio.php');
    }
    
    // Delete Portfolio Item
    if ($_POST['action'] === 'delete_item') {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $result = $adminDb->delete('portfolio_items', ['id' => $id]);
            if ($result['success']) {
                setFlash('success', 'Portfolio item deleted successfully!');
            } else {
                setFlash('error', 'Failed to delete portfolio item');
            }
        }
        redirect('/admin/portfolio.php');
    }
    
    // Toggle Active Status
    if ($_POST['action'] === 'toggle_active') {
        $id = $_POST['id'] ?? null;
        $is_active = $_POST['is_active'] === 'true' ? false : true;
        
        if ($id) {
            $result = $adminDb->update('portfolio_items', ['is_active' => $is_active], ['id' => $id]);
            if ($result['success']) {
                setFlash('success', 'Status updated successfully!');
            } else {
                setFlash('error', 'Failed to update status');
            }
        }
        redirect('/admin/portfolio.php');
    }
}

// Fetch all portfolio items
$portfolioItems = [];
$result = $adminDb->select('portfolio_items', '*', [], 'created_at.desc');
if ($result['success'] && !empty($result['data'])) {
    $portfolioItems = $result['data'];
}

// Get item for editing
$editItem = null;
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    foreach ($portfolioItems as $item) {
        if ($item['id'] === $editId) {
            $editItem = $item;
            break;
        }
    }
}

include 'includes/header.php';

// Get unique categories
$categories = [];
foreach ($portfolioItems as $item) {
    if (!empty($item['category']) && !in_array($item['category'], $categories)) {
        $categories[] = $item['category'];
    }
}
sort($categories);

// Filter by category if set
$filterCategory = $_GET['category'] ?? 'all';
$filteredItems = $portfolioItems;
if ($filterCategory !== 'all') {
    $filteredItems = array_filter($portfolioItems, function($item) use ($filterCategory) {
        return $item['category'] === $filterCategory;
    });
}
?>

<div class="dashboard-content">
    <div class="page-header">
        <div>
            <h1>Portfolio Manager</h1>
            <p>Manage your portfolio projects and showcase your work</p>
        </div>
        <button class="btn btn-primary" onclick="document.getElementById('addModal').style.display='block'">
            <i class="fas fa-plus"></i> Add Portfolio Item
        </button>
    </div>

    <!-- Category Filter Tabs -->
    <?php if (!empty($categories)): ?>
    <div class="category-tabs">
        <a href="?category=all" class="tab <?php echo $filterCategory === 'all' ? 'active' : ''; ?>">
            All (<?php echo count($portfolioItems); ?>)
        </a>
        <?php foreach ($categories as $cat): ?>
            <?php 
            $count = count(array_filter($portfolioItems, function($item) use ($cat) {
                return $item['category'] === $cat;
            }));
            ?>
            <a href="?category=<?php echo urlencode($cat); ?>" class="tab <?php echo $filterCategory === $cat ? 'active' : ''; ?>">
                <?php echo e($cat); ?> (<?php echo $count; ?>)
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Portfolio Grid -->
    <div class="portfolio-grid">
        <?php if (empty($filteredItems)): ?>
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <h3>No portfolio items <?php echo $filterCategory !== 'all' ? 'in this category' : 'yet'; ?></h3>
                <p>Click "Add Portfolio Item" to showcase your work</p>
            </div>
        <?php else: ?>
            <?php foreach ($filteredItems as $item): ?>
                <div class="portfolio-card <?php echo $item['is_active'] ? '' : 'inactive'; ?>">
                    <div class="portfolio-image">
                        <img src="<?php echo e(getImageUrl($item['image_url'])); ?>" alt="<?php echo e($item['title']); ?>">
                        <?php if ($item['is_featured']): ?>
                            <span class="badge-featured">⭐ Featured</span>
                        <?php endif; ?>
                        <?php if (!$item['is_active']): ?>
                            <span class="badge-inactive">Hidden</span>
                        <?php endif; ?>
                    </div>
                    <div class="portfolio-content">
                        <h3><?php echo e($item['title']); ?></h3>
                        <?php if (!empty($item['category'])): ?>
                            <span class="category-tag"><?php echo e($item['category']); ?></span>
                        <?php endif; ?>
                        <p><?php echo e(truncate($item['description'], 100)); ?></p>
                        
                        <div class="portfolio-actions">
                            <a href="?edit=<?php echo $item['id']; ?>" class="btn-icon" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Toggle active status?')">
                                <input type="hidden" name="action" value="toggle_active">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <input type="hidden" name="is_active" value="<?php echo $item['is_active'] ? 'true' : 'false'; ?>">
                                <button type="submit" class="btn-icon" title="<?php echo $item['is_active'] ? 'Hide' : 'Show'; ?>">
                                    <i class="fas fa-eye<?php echo $item['is_active'] ? '' : '-slash'; ?>"></i>
                                </button>
                            </form>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this item?')">
                                <input type="hidden" name="action" value="delete_item">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn-icon btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Add/Edit Modal -->
<div id="addModal" class="modal" style="display:<?php echo $editItem ? 'block' : 'none'; ?>">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo $editItem ? 'Edit' : 'Add'; ?> Portfolio Item</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_item">
            <?php if ($editItem): ?>
                <input type="hidden" name="id" value="<?php echo $editItem['id']; ?>">
                <input type="hidden" name="current_image" value="<?php echo e($editItem['image_url']); ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="title">Project Title *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="form-control"
                    value="<?php echo e($editItem['title'] ?? ''); ?>"
                    placeholder="e.g., Modern Logo Design for TechCo"
                    required
                >
            </div>

            <div class="form-group">
                <label for="category">Category *</label>
                <select 
                    id="category" 
                    name="category" 
                    class="form-control"
                    required
                >
                    <option value="">Select a category</option>
                    <option value="Logo Design" <?php echo ($editItem && $editItem['category'] === 'Logo Design') ? 'selected' : ''; ?>>Logo Design</option>
                    <option value="Web Design" <?php echo ($editItem && $editItem['category'] === 'Web Design') ? 'selected' : ''; ?>>Web Design</option>
                    <option value="Branding" <?php echo ($editItem && $editItem['category'] === 'Branding') ? 'selected' : ''; ?>>Branding</option>
                    <option value="Print Design" <?php echo ($editItem && $editItem['category'] === 'Print Design') ? 'selected' : ''; ?>>Print Design</option>
                    <option value="Brochure Design" <?php echo ($editItem && $editItem['category'] === 'Brochure Design') ? 'selected' : ''; ?>>Brochure Design</option>
                    <option value="Social Media" <?php echo ($editItem && $editItem['category'] === 'Social Media') ? 'selected' : ''; ?>>Social Media</option>
                    <option value="UI/UX Design" <?php echo ($editItem && $editItem['category'] === 'UI/UX Design') ? 'selected' : ''; ?>>UI/UX Design</option>
                    <option value="Illustration" <?php echo ($editItem && $editItem['category'] === 'Illustration') ? 'selected' : ''; ?>>Illustration</option>
                    <option value="Other" <?php echo ($editItem && $editItem['category'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
                <small class="form-text">Choose the service category for this project</small>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    class="form-control"
                    rows="4"
                    placeholder="Brief description of the project..."
                ><?php echo e($editItem['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="project_url">Project URL (optional)</label>
                <input
                    type="url"
                    id="project_url"
                    name="project_url"
                    class="form-control"
                    value="<?php echo e($editItem['project_url'] ?? ''); ?>"
                    placeholder="https://example.com"
                >
            </div>

            <!-- ── Case Study Fields ─────────────────────────── -->
            <hr style="margin:24px 0;border-color:var(--gray-200);">
            <p style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--gray-500);margin:0 0 20px;">Case Study Details</p>

            <div class="form-row">
                <div class="form-group" style="margin-bottom:0;">
                    <label for="client_name">Client Name</label>
                    <input
                        type="text"
                        id="client_name"
                        name="client_name"
                        class="form-control"
                        value="<?php echo e($editItem['client_name'] ?? ''); ?>"
                        placeholder="e.g., Acme Corporation"
                    >
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="role">Your Role</label>
                    <input
                        type="text"
                        id="role"
                        name="role"
                        class="form-control"
                        value="<?php echo e($editItem['role'] ?? ''); ?>"
                        placeholder="e.g., Lead Brand Designer"
                    >
                </div>
            </div>

            <div class="form-row" style="margin-top:20px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label for="timeline">Timeline</label>
                    <input
                        type="text"
                        id="timeline"
                        name="timeline"
                        class="form-control"
                        value="<?php echo e($editItem['timeline'] ?? ''); ?>"
                        placeholder="e.g., 4 weeks"
                    >
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="slug">URL Slug</label>
                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        class="form-control"
                        value="<?php echo e($editItem['slug'] ?? ''); ?>"
                        placeholder="auto-generated from title"
                    >
                    <small class="form-text">Auto-filled from title. Leave blank to auto-generate.</small>
                </div>
            </div>

            <div class="form-group">
                <label for="tools_used">Tools Used</label>
                <input
                    type="text"
                    id="tools_used"
                    name="tools_used"
                    class="form-control"
                    value="<?php echo e($editItem['tools_used'] ?? ''); ?>"
                    placeholder="e.g., Figma, Adobe Illustrator, Canva"
                >
                <small class="form-text">Comma-separated list of tools and software used.</small>
            </div>

            <div class="form-group">
                <label for="deliverables">Deliverables</label>
                <input
                    type="text"
                    id="deliverables"
                    name="deliverables"
                    class="form-control"
                    value="<?php echo e($editItem['deliverables'] ?? ''); ?>"
                    placeholder="e.g., Logo Suite, Brand Guidelines, Business Cards"
                >
                <small class="form-text">Comma-separated list of project deliverables.</small>
            </div>

            <div class="form-group">
                <label for="challenge">The Challenge</label>
                <textarea
                    id="challenge"
                    name="challenge"
                    class="form-control"
                    rows="4"
                    placeholder="Describe the problem or challenge the client faced..."
                ><?php echo e($editItem['challenge'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="solution">The Solution / Our Approach</label>
                <textarea
                    id="solution"
                    name="solution"
                    class="form-control"
                    rows="4"
                    placeholder="Describe your approach, process, and decisions..."
                ><?php echo e($editItem['solution'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="results">Results & Impact</label>
                <textarea
                    id="results"
                    name="results"
                    class="form-control"
                    rows="4"
                    placeholder="Describe the measurable outcomes and impact..."
                ><?php echo e($editItem['results'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label>Gallery Images</label>

                <?php
                // Decode existing gallery for display
                $existingGallery = $editItem['gallery_images'] ?? '';
                $existingGalleryArr = [];
                if (!empty($existingGallery)) {
                    $decoded = json_decode($existingGallery, true);
                    $existingGalleryArr = is_array($decoded) ? $decoded : [];
                }
                ?>

                <!-- Hidden field holding retained URLs as JSON (updated by JS when user removes an image) -->
                <input
                    type="hidden"
                    id="existing_gallery_json"
                    name="existing_gallery_json"
                    value="<?php echo e(json_encode($existingGalleryArr)); ?>"
                >

                <!-- Existing thumbnails -->
                <?php if (!empty($existingGalleryArr)): ?>
                <div class="gallery-preview" id="galleryPreview">
                    <?php foreach ($existingGalleryArr as $idx => $gUrl): ?>
                    <div class="gallery-thumb" id="gthumb-<?php echo $idx; ?>">
                        <img src="<?php echo e(getImageUrl($gUrl)); ?>" alt="Gallery image">
                        <button
                            type="button"
                            class="gallery-remove-btn"
                            onclick="removeGalleryImage(<?php echo $idx; ?>, '<?php echo e($gUrl); ?>')"
                            title="Remove"
                        >&times;</button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="gallery-preview" id="galleryPreview"></div>
                <?php endif; ?>

                <!-- Upload new images via AJAX -->
                <label class="gallery-upload-btn" id="galleryUploadLabel">
                    <i class="fas fa-plus"></i> Add Images
                    <input
                        type="file"
                        id="gallery_images_upload"
                        accept="image/*"
                        multiple
                        style="display:none;"
                    >
                </label>
                <small class="form-text">Select one or more images — they upload instantly. Recommended: 1200x800px.</small>
            </div>
            <!-- ── End Case Study Fields ─────────────────────── -->

            <div class="form-group">
                <label for="portfolio_image">Project Image *</label>
                <?php if ($editItem && !empty($editItem['image_url'])): ?>
                    <div class="image-preview-small">
                        <img src="<?php echo e(getImageUrl($editItem['image_url'])); ?>" alt="Current image">
                    </div>
                <?php endif; ?>
                <input 
                    type="file" 
                    id="portfolio_image" 
                    name="portfolio_image" 
                    class="form-control"
                    accept="image/*"
                    <?php echo $editItem ? '' : 'required'; ?>
                >
                <small class="form-text">Recommended: 1200x800px. Leave empty to keep current image.</small>
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1"
                        <?php echo ($editItem && $editItem['is_featured']) ? 'checked' : ''; ?>
                    >
                    <span>⭐ Mark as Featured</span>
                </label>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Portfolio Item
                </button>
                <button type="button" class="btn btn-outline" onclick="closeModal()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.category-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
    flex-wrap: wrap;
    padding: 16px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.category-tabs .tab {
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    color: var(--gray-700);
    font-size: 14px;
    font-weight: 500;
    background: var(--gray-100);
    transition: all 0.3s;
}

.category-tabs .tab:hover {
    background: var(--gray-200);
}

.category-tabs .tab.active {
    background: var(--primary);
    color: white;
}

.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

.portfolio-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
}

.portfolio-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.portfolio-card.inactive {
    opacity: 0.6;
}

.portfolio-image {
    position: relative;
    width: 100%;
    height: 240px;
    overflow: hidden;
    background: var(--gray-100);
}

.portfolio-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge-featured, .badge-inactive {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-featured {
    background: var(--warning);
    color: white;
}

.badge-inactive {
    background: var(--gray-600);
    color: white;
}

.portfolio-content {
    padding: 20px;
}

.portfolio-content h3 {
    margin: 0 0 8px;
    font-size: 18px;
    color: var(--gray-900);
}

.category-tag {
    display: inline-block;
    padding: 4px 10px;
    background: var(--primary);
    color: white;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 12px;
}

.portfolio-content p {
    color: var(--gray-600);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 16px;
}

.portfolio-actions {
    display: flex;
    gap: 8px;
    padding-top: 12px;
    border-top: 1px solid var(--gray-200);
}

.btn-icon {
    padding: 8px 12px;
    border: 1px solid var(--gray-300);
    background: white;
    color: var(--gray-700);
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-icon:hover {
    background: var(--gray-100);
}

.btn-icon.btn-danger:hover {
    background: var(--danger);
    color: white;
    border-color: var(--danger);
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: var(--gray-500);
}

.empty-state i {
    font-size: 64px;
    margin-bottom: 16px;
    opacity: 0.3;
}

/* Modal */
.modal {
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    overflow-y: auto;
}

.modal-content {
    background: white;
    margin: 40px auto;
    max-width: 600px;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header {
    padding: 24px;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 24px;
}

.close {
    font-size: 32px;
    font-weight: 300;
    color: var(--gray-500);
    cursor: pointer;
    line-height: 1;
}

.close:hover {
    color: var(--gray-900);
}

.modal-content form {
    padding: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--gray-700);
    font-size: 14px;
}

.form-control {
    width: 100%;
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
    min-height: 120px;
}

.form-text {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: var(--gray-500);
}

.form-text a {
    color: var(--primary);
    text-decoration: none;
}

.form-text a:hover {
    text-decoration: underline;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.checkbox-label input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.modal-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--gray-200);
}

.image-preview-small {
    margin-bottom: 12px;
}

.image-preview-small img {
    max-width: 200px;
    max-height: 150px;
    border-radius: 8px;
    border: 2px solid var(--gray-200);
}

/* Gallery upload thumbnails */
.gallery-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 10px;
}

.gallery-thumb {
    position: relative;
    width: 90px;
    height: 90px;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid var(--gray-200);
    flex-shrink: 0;
}

.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.gallery-remove-btn {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(0,0,0,0.7);
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 14px;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    transition: background 0.2s;
}

.gallery-remove-btn:hover {
    background: var(--danger, #e53e3e);
}

.gallery-upload-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
    padding: 9px 18px;
    border: 2px dashed var(--gray-300, #d1d5db);
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-600, #4b5563);
    background: var(--gray-50, #f9fafb);
    cursor: pointer;
    transition: all 0.2s;
}

.gallery-upload-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: rgba(24,77,55,0.04);
}

.gallery-thumb-uploading {
    background: var(--gray-100, #f3f4f6);
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-thumb-uploading::after {
    content: '';
    width: 22px;
    height: 22px;
    border: 3px solid var(--gray-300, #d1d5db);
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: gallerySpinner 0.7s linear infinite;
}

@keyframes gallerySpinner {
    to { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .portfolio-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function closeModal() {
    document.getElementById('addModal').style.display = 'none';
    window.location.href = 'portfolio.php';
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    if (!event || !event.target) return;
    const modal = document.getElementById('addModal');
    if (modal && event.target === modal) {
        closeModal();
    }
});

// Auto-generate slug from title on blur
(function () {
    const titleInput = document.getElementById('title');
    const slugInput  = document.getElementById('slug');

    if (!titleInput || !slugInput) return;

    titleInput.addEventListener('blur', function () {
        if (slugInput.value.trim() !== '') return; // don't overwrite existing slug
        const raw = titleInput.value.trim().toLowerCase();
        const slug = raw
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        slugInput.value = slug;
    });
}());

// Remove an existing gallery image thumbnail
function removeGalleryImage(idx, url) {
    const thumb = document.getElementById('gthumb-' + idx);
    if (thumb) thumb.remove();
    const field = document.getElementById('existing_gallery_json');
    let urls = JSON.parse(field.value || '[]');
    urls = urls.filter(function (u) { return u !== url; });
    field.value = JSON.stringify(urls);
}

// AJAX gallery uploader — uploads each selected file immediately, no page reload needed
document.addEventListener('DOMContentLoaded', function () {
    const galleryInput = document.getElementById('gallery_images_upload');
    const preview      = document.getElementById('galleryPreview');
    const jsonField    = document.getElementById('existing_gallery_json');
    if (!galleryInput || !preview || !jsonField) return;

    galleryInput.addEventListener('change', function () {
        Array.from(galleryInput.files).forEach(function (file) {
            if (!file.type.startsWith('image/')) return;

            // Add a spinner placeholder thumbnail
            const thumb = document.createElement('div');
            thumb.className = 'gallery-thumb gallery-thumb-uploading';
            preview.appendChild(thumb);

            // Build form data for AJAX upload
            const fd = new FormData();
            fd.append('action', 'upload_gallery_image');
            fd.append('gallery_image', file);

            fetch('portfolio.php', { method: 'POST', body: fd })
                .then(function (r) {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(function (data) {
                    if (data.success && data.url) {
                        // Replace spinner with real thumbnail + remove button
                        thumb.classList.remove('gallery-thumb-uploading');

                        const img = document.createElement('img');
                        img.src = data.url;
                        thumb.appendChild(img);

                        const url = data.url;
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'gallery-remove-btn';
                        btn.title = 'Remove';
                        btn.innerHTML = '&times;';
                        btn.addEventListener('click', function () {
                            thumb.remove();
                            let urls = JSON.parse(jsonField.value || '[]');
                            urls = urls.filter(function (u) { return u !== url; });
                            jsonField.value = JSON.stringify(urls);
                        });
                        thumb.appendChild(btn);

                        // Add URL to hidden JSON field
                        let urls = JSON.parse(jsonField.value || '[]');
                        urls.push(url);
                        jsonField.value = JSON.stringify(urls);
                    } else {
                        thumb.remove();
                        alert('Upload failed: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(function (err) {
                    thumb.remove();
                    alert('Upload failed: ' + (err.message || 'Please try again.'));
                });
        });

        // Reset input so the same file can be re-selected if needed
        galleryInput.value = '';
    });
});
</script>

<?php include 'includes/footer.php'; ?>