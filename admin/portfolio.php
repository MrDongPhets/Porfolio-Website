<?php
// admin/portfolio.php - Portfolio Manager
require_once '../config/config.php';
requireLogin();

$pageTitle = 'Portfolio';

// Use admin DB (service key)
$adminDb = getAdminDb();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    // Add/Edit Portfolio Item
    if ($_POST['action'] === 'save_item') {
        $id = $_POST['id'] ?? null;
        $title = clean($_POST['title'] ?? '');
        $description = clean($_POST['description'] ?? '');
        $category = clean($_POST['category'] ?? '');
        $project_url = clean($_POST['project_url'] ?? '');
        $is_featured = isset($_POST['is_featured']) ? true : false;
        $current_image = $_POST['current_image'] ?? '';
        
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
                'title' => $title,
                'description' => $description,
                'category' => $category,
                'image_url' => $image_url,
                'project_url' => $project_url,
                'is_featured' => $is_featured,
                'updated_at' => date('Y-m-d H:i:s')
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
window.onclick = function(event) {
    const modal = document.getElementById('addModal');
    if (event.target == modal) {
        closeModal();
    }
}
</script>

<?php include 'includes/footer.php'; ?>