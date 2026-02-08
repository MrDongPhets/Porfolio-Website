<?php
// portfolio.php - Full Portfolio Gallery Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Portfolio';

// Get filter category
$filterCategory = $_GET['category'] ?? 'all';

// Fetch all active portfolio items
$portfolioItems = [];
if ($filterCategory === 'all') {
    $result = $db->select('portfolio_items', '*', ['is_active' => true], 'is_featured.desc,created_at.desc');
} else {
    $result = $db->select('portfolio_items', '*', ['is_active' => true, 'category' => $filterCategory], 'is_featured.desc,created_at.desc');
}

if ($result['success'] && !empty($result['data'])) {
    $portfolioItems = $result['data'];
}

// Get unique categories
$categories = [];
$allResult = $db->select('portfolio_items', 'category', ['is_active' => true]);
if ($allResult['success'] && !empty($allResult['data'])) {
    foreach ($allResult['data'] as $item) {
        if (!empty($item['category']) && !in_array($item['category'], $categories)) {
            $categories[] = $item['category'];
        }
    }
    sort($categories);
}

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');

// Include header
include 'includes/site-header.php';
?>

    <!-- Portfolio Page Specific Styles -->
    <style>
    
    </style>

    <!-- Portfolio Header -->
    <div class="portfolio-header">
      <h1>Our Portfolio</h1>
      <p>Discover our creative journey through a collection of carefully crafted projects</p>
    </div>

    <!-- Category Filters -->
    <?php if (!empty($categories)): ?>
    <div class="portfolio-filters">
      <div class="filter-tabs">
        <a href="?category=all" class="filter-tab <?php echo $filterCategory === 'all' ? 'active' : ''; ?>">
          All Projects
        </a>
        <?php foreach ($categories as $cat): ?>
          <a href="?category=<?php echo urlencode($cat); ?>" class="filter-tab <?php echo $filterCategory === $cat ? 'active' : ''; ?>">
            <?php echo e($cat); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

    <!-- Portfolio Grid -->
    <div class="portfolio-section">
      <?php if (!empty($portfolioItems)): ?>
        <div class="portfolio-count">
          Showing <?php echo count($portfolioItems); ?> project<?php echo count($portfolioItems) !== 1 ? 's' : ''; ?>
          <?php echo $filterCategory !== 'all' ? 'in ' . e($filterCategory) : ''; ?>
        </div>

        <div class="portfolio-grid">
          <?php foreach ($portfolioItems as $item): ?>
            <div class="portfolio-item">
              <div class="portfolio-item-image">
                <img src="<?php echo e(getImageUrl($item['image_url'])); ?>" alt="<?php echo e($item['title']); ?>">
                <div class="portfolio-overlay">
                  <div class="portfolio-info">
                    <span class="portfolio-category"><?php echo e($item['category']); ?></span>
                    <h4><?php echo e($item['title']); ?></h4>
                    <?php if (!empty($item['description'])): ?>
                      <p><?php echo e(truncate($item['description'], 100)); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($item['project_url'])): ?>
                      <a href="<?php echo e($item['project_url']); ?>" target="_blank" class="portfolio-link">
                        View Project <i class="fas fa-arrow-right"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="empty-state">
          <i class="fas fa-folder-open"></i>
          <h3>No projects found</h3>
          <p>
            <?php if ($filterCategory !== 'all'): ?>
              No projects in this category yet. <a href="?category=all">View all projects</a>
            <?php else: ?>
              Check back soon for new projects!
            <?php endif; ?>
          </p>
        </div>
      <?php endif; ?>
    </div>

<?php include 'includes/site-footer.php'; ?>