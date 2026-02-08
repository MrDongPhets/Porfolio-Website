<?php
// admin/services.php - Services Manager
require_once '../config/config.php';
requireLogin();

$pageTitle = 'Services';

// Use admin DB (service key)
$adminDb = getAdminDb();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    // Add/Edit Service
    if ($_POST['action'] === 'save_service') {
        $id = $_POST['id'] ?? null;
        $title = clean($_POST['title'] ?? '');
        $description = clean($_POST['description'] ?? '');
        $icon = $_POST['icon'] ?? '';
        $display_order = intval($_POST['display_order'] ?? 0);
        
        if (empty($title) || empty($description)) {
            setFlash('error', 'Title and description are required');
        } else {
            $data = [
                'title' => $title,
                'description' => $description,
                'icon' => $icon,
                'display_order' => $display_order,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if ($id) {
                // Update existing
                $result = $adminDb->update('services', $data, ['id' => $id]);
                $message = 'Service updated successfully!';
            } else {
                // Create new
                $data['is_active'] = true;
                $result = $adminDb->insert('services', $data);
                $message = 'Service created successfully!';
            }
            
            if ($result['success']) {
                setFlash('success', $message);
            } else {
                setFlash('error', 'Failed to save service');
            }
        }
        redirect('/admin/services.php');
    }
    
    // Delete Service
    if ($_POST['action'] === 'delete_service') {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $result = $adminDb->delete('services', ['id' => $id]);
            if ($result['success']) {
                setFlash('success', 'Service deleted successfully!');
            } else {
                setFlash('error', 'Failed to delete service');
            }
        }
        redirect('/admin/services.php');
    }
    
    // Toggle Active Status
    if ($_POST['action'] === 'toggle_active') {
        $id = $_POST['id'] ?? null;
        $is_active = $_POST['is_active'] === 'true' ? false : true;
        
        if ($id) {
            $result = $adminDb->update('services', ['is_active' => $is_active], ['id' => $id]);
            if ($result['success']) {
                setFlash('success', 'Status updated successfully!');
            } else {
                setFlash('error', 'Failed to update status');
            }
        }
        redirect('/admin/services.php');
    }
}

// Fetch all services
$services = [];
$result = $adminDb->select('services', '*', [], 'display_order.asc,created_at.desc');
if ($result['success'] && !empty($result['data'])) {
    $services = $result['data'];
}

// Get service for editing
$editService = null;
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
    foreach ($services as $service) {
        if ($service['id'] === $editId) {
            $editService = $service;
            break;
        }
    }
}

include 'includes/header.php';
?>

<div class="dashboard-content">
    <div class="page-header">
        <div>
            <h1>Services Manager</h1>
            <p>Manage the services you offer to your clients</p>
        </div>
        <button class="btn btn-primary" onclick="document.getElementById('addModal').style.display='block'">
            <i class="fas fa-plus"></i> Add Service
        </button>
    </div>

    <!-- Services Grid -->
    <div class="services-grid">
        <?php if (empty($services)): ?>
            <div class="empty-state">
                <i class="fas fa-cog"></i>
                <h3>No services yet</h3>
                <p>Click "Add Service" to showcase what you offer</p>
            </div>
        <?php else: ?>
            <?php foreach ($services as $service): ?>
                <div class="service-card <?php echo $service['is_active'] ? '' : 'inactive'; ?>">
                    <div class="service-header">
                        <div class="service-icon">
                            <?php echo $service['icon'] ?: '⚙️'; ?>
                        </div>
                        <div class="service-order">
                            #<?php echo $service['display_order']; ?>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3><?php echo e($service['title']); ?></h3>
                        <p><?php echo e(truncate($service['description'], 120)); ?></p>
                        
                        <?php if (!$service['is_active']): ?>
                            <span class="badge-inactive">Hidden</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-actions">
                        <a href="?edit=<?php echo $service['id']; ?>" class="btn-icon" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Toggle active status?')">
                            <input type="hidden" name="action" value="toggle_active">
                            <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                            <input type="hidden" name="is_active" value="<?php echo $service['is_active'] ? 'true' : 'false'; ?>">
                            <button type="submit" class="btn-icon" title="<?php echo $service['is_active'] ? 'Hide' : 'Show'; ?>">
                                <i class="fas fa-eye<?php echo $service['is_active'] ? '' : '-slash'; ?>"></i>
                            </button>
                        </form>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this service?')">
                            <input type="hidden" name="action" value="delete_service">
                            <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                            <button type="submit" class="btn-icon btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Preview Section -->
    <?php if (!empty($services)): ?>
    <div class="card" style="margin-top: 40px;">
        <div class="card-header">
            <h2>Frontend Preview</h2>
        </div>
        <div class="card-body">
            <div class="services-preview">
                <?php foreach (array_filter($services, fn($s) => $s['is_active']) as $service): ?>
                    <div class="preview-service">
                        <div class="preview-icon"><?php echo $service['icon'] ?: '⚙️'; ?></div>
                        <h4><?php echo e($service['title']); ?></h4>
                        <p><?php echo e($service['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Add/Edit Modal -->
<div id="addModal" class="modal" style="display:<?php echo $editService ? 'block' : 'none'; ?>">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo $editService ? 'Edit' : 'Add'; ?> Service</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="save_service">
            <?php if ($editService): ?>
                <input type="hidden" name="id" value="<?php echo $editService['id']; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label for="title">Service Title *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="form-control"
                    value="<?php echo e($editService['title'] ?? ''); ?>"
                    placeholder="e.g., Logo Design"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea 
                    id="description" 
                    name="description" 
                    class="form-control"
                    rows="5"
                    placeholder="Describe what this service includes..."
                    required
                ><?php echo e($editService['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="icon">Icon/Emoji</label>
                    <input 
                        type="text" 
                        id="icon" 
                        name="icon" 
                        class="form-control"
                        value="<?php echo e($editService['icon'] ?? ''); ?>"
                        placeholder="go to fontawesome.com or emojipedia.org"
                      
                    >
                    <small class="form-text">Use emoji or icon. <a href="https://emojipedia.org" target="_blank">Find emojis</a></small>
                </div>

                <div class="form-group">
                    <label for="display_order">Display Order</label>
                    <input 
                        type="number" 
                        id="display_order" 
                        name="display_order" 
                        class="form-control"
                        value="<?php echo $editService['display_order'] ?? 0; ?>"
                        placeholder="0"
                        min="0"
                    >
                    <small class="form-text">Lower numbers appear first</small>
                </div>
            </div>

            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Service
                </button>
                <button type="button" class="btn btn-outline" onclick="closeModal()">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

.service-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
}

.service-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.service-card.inactive {
    opacity: 0.6;
}

.service-header {
    padding: 24px 24px 0;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.service-icon {
    font-size: 48px;
    line-height: 1;
}

.service-order {
    background: var(--gray-100);
    color: var(--gray-600);
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.service-content {
    padding: 20px 24px;
    flex: 1;
}

.service-content h3 {
    margin: 0 0 12px;
    font-size: 20px;
    color: var(--gray-900);
}

.service-content p {
    color: var(--gray-600);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 12px;
}

.badge-inactive {
    display: inline-block;
    padding: 4px 10px;
    background: var(--gray-600);
    color: white;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
}

.service-actions {
    display: flex;
    gap: 8px;
    padding: 12px 24px;
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
    font-size: 14px;
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

/* Preview Styles */
.services-preview {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 24px;
    padding: 20px;
    background: var(--gray-50);
    border-radius: 8px;
}

.preview-service {
    text-align: center;
    padding: 24px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.preview-icon {
    font-size: 40px;
    margin-bottom: 16px;
}

.preview-service h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 12px;
    color: var(--gray-900);
}

.preview-service p {
    font-size: 14px;
    color: var(--gray-600);
    line-height: 1.6;
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

.modal-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid var(--gray-200);
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function closeModal() {
    document.getElementById('addModal').style.display = 'none';
    window.location.href = 'services.php';
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