<?php
// portfolio-detail.php - Portfolio Case Study Detail Page
require_once 'config/config.php';

// Get item ID from URL
$itemId = $_GET['id'] ?? null;

if (!$itemId) {
    header('Location: portfolio.php');
    exit;
}

// Fetch the specific portfolio item
$item = null;
$result = $db->select('portfolio_items', '*', ['id' => $itemId, 'is_active' => true]);
if ($result['success'] && !empty($result['data'])) {
    $item = $result['data'][0];
}

if (!$item) {
    header('HTTP/1.0 404 Not Found');
    header('Location: portfolio.php');
    exit;
}

// Parse gallery images (stored as JSON array or one-per-line)
$galleryImages = [];
if (!empty($item['gallery_images'])) {
    $decoded = json_decode($item['gallery_images'], true);
    if (is_array($decoded)) {
        $galleryImages = $decoded;
    } else {
        // Fallback: one URL per line
        $galleryImages = array_filter(array_map('trim', explode("\n", $item['gallery_images'])));
    }
}

// Parse comma-separated fields
$toolsList = !empty($item['tools_used'])
    ? array_filter(array_map('trim', explode(',', $item['tools_used'])))
    : [];
$deliverablesList = !empty($item['deliverables'])
    ? array_filter(array_map('trim', explode(',', $item['deliverables'])))
    : [];

// Fetch related items (same category, exclude current)
$relatedItems = [];
$relatedResult = $db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc,created_at.desc');
if ($relatedResult['success'] && !empty($relatedResult['data'])) {
    foreach ($relatedResult['data'] as $ri) {
        if ($ri['id'] !== $item['id'] && $ri['category'] === $item['category']) {
            $relatedItems[] = $ri;
            if (count($relatedItems) >= 3) break;
        }
    }
}

$pageTitle = $item['title'] . ' — Case Study';
$siteName = getSetting('site_name', 'MR. DONGPHETS');

include 'includes/site-header.php';
?>


<!-- Case Study Hero -->
<section class="cs-hero">
    <img
        src="<?php echo e(getImageUrl($item['image_url'])); ?>"
        alt="<?php echo e($item['title']); ?>"
        class="cs-hero-image"
    >
    <div class="cs-hero-overlay"></div>
    <div class="cs-hero-content" data-aos="fade-up">
        <nav class="cs-breadcrumb">
            <a href="portfolio.php">Portfolio</a>
            <i class="fas fa-chevron-right"></i>
            <span><?php echo e($item['category']); ?></span>
        </nav>

        <div class="cs-category-badge">
            <?php
            $icon = 'fa-folder';
            if (stripos($item['category'], 'web') !== false) $icon = 'fa-laptop-code';
            elseif (stripos($item['category'], 'brand') !== false) $icon = 'fa-palette';
            elseif (stripos($item['category'], 'logo') !== false) $icon = 'fa-pen-nib';
            elseif (stripos($item['category'], 'video') !== false) $icon = 'fa-video';
            elseif (stripos($item['category'], 'social') !== false) $icon = 'fa-hashtag';
            elseif (stripos($item['category'], 'print') !== false) $icon = 'fa-print';
            elseif (stripos($item['category'], 'ui') !== false || stripos($item['category'], 'ux') !== false) $icon = 'fa-layer-group';
            elseif (stripos($item['category'], 'content') !== false) $icon = 'fa-images';
            ?>
            <i class="fas <?php echo $icon; ?>"></i>
            <?php echo e($item['category']); ?>
        </div>

        <h1><?php echo e($item['title']); ?></h1>

        <div class="cs-hero-meta">
            <?php if (!empty($item['client_name'])): ?>
            <div class="cs-meta-item">
                <span class="cs-meta-label">Client</span>
                <span class="cs-meta-value"><?php echo e($item['client_name']); ?></span>
            </div>
            <?php endif; ?>

            <?php if (!empty($item['role'])): ?>
            <div class="cs-meta-item">
                <span class="cs-meta-label">Role</span>
                <span class="cs-meta-value"><?php echo e($item['role']); ?></span>
            </div>
            <?php endif; ?>

            <?php if (!empty($item['timeline'])): ?>
            <div class="cs-meta-item">
                <span class="cs-meta-label">Timeline</span>
                <span class="cs-meta-value"><?php echo e($item['timeline']); ?></span>
            </div>
            <?php endif; ?>

            <div class="cs-meta-item">
                <span class="cs-meta-label">Category</span>
                <span class="cs-meta-value"><?php echo e($item['category']); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Body: Main Content + Sidebar -->
<div class="cs-body">
    <main class="cs-main">

        <!-- Overview -->
        <?php if (!empty($item['description'])): ?>
        <div class="cs-section" data-aos="fade-up">
            <div class="cs-section-eyebrow">
                <div class="cs-section-icon"><i class="fas fa-eye"></i></div>
                <span class="cs-section-number">Overview</span>
            </div>
            <p class="cs-overview-text"><?php echo nl2br(e($item['description'])); ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['challenge'])): ?>
        <hr class="cs-divider">
        <!-- The Challenge -->
        <div class="cs-section" data-aos="fade-up">
            <div class="cs-section-eyebrow">
                <div class="cs-section-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <span class="cs-section-number">01 — The Challenge</span>
            </div>
            <h2>What We Were Up Against</h2>
            <p><?php echo nl2br(e($item['challenge'])); ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['solution'])): ?>
        <hr class="cs-divider">
        <!-- The Solution -->
        <div class="cs-section" data-aos="fade-up">
            <div class="cs-section-eyebrow">
                <div class="cs-section-icon"><i class="fas fa-lightbulb"></i></div>
                <span class="cs-section-number">02 — The Solution</span>
            </div>
            <h2>Our Approach</h2>
            <p><?php echo nl2br(e($item['solution'])); ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($galleryImages)): ?>
        <hr class="cs-divider">
        <!-- Gallery -->
        <div class="cs-section" data-aos="fade-up">
            <div class="cs-section-eyebrow">
                <div class="cs-section-icon"><i class="fas fa-images"></i></div>
                <span class="cs-section-number">Project Gallery</span>
            </div>
            <h2>Visual Highlights</h2>
            <div class="cs-gallery">
                <?php foreach ($galleryImages as $imgUrl): ?>
                    <?php if (!empty(trim($imgUrl))): ?>
                    <div class="cs-gallery-item">
                        <img
                            src="<?php echo e(trim($imgUrl)); ?>"
                            alt="<?php echo e($item['title']); ?> gallery"
                            loading="lazy"
                        >
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['results'])): ?>
        <hr class="cs-divider">
        <!-- Results -->
        <div class="cs-section cs-results-block" data-aos="fade-up">
            <div class="cs-section-eyebrow">
                <div class="cs-section-icon" style="background:rgba(255,255,255,0.15);">
                    <i class="fas fa-chart-line"></i>
                </div>
                <span class="cs-section-number">03 — Results & Impact</span>
            </div>
            <h2>What We Achieved</h2>
            <p><?php echo nl2br(e($item['results'])); ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['project_url']) && $item['project_url'] !== '#'): ?>
        <hr class="cs-divider">
        <div data-aos="fade-up" style="text-align:center;">
            <a href="<?php echo e($item['project_url']); ?>" target="_blank" rel="noopener" class="btn btn-primary-modern">
                View Live Project <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
        <?php endif; ?>

    </main>

    <!-- Sidebar -->
    <aside class="cs-sidebar" data-aos="fade-left">
        <p class="cs-sidebar-title">Project Details</p>

        <?php if (!empty($item['client_name'])): ?>
        <div class="cs-sidebar-group">
            <p class="cs-sidebar-group-label">Client</p>
            <p class="cs-sidebar-group-value"><?php echo e($item['client_name']); ?></p>
        </div>
        <?php endif; ?>

        <div class="cs-sidebar-group">
            <p class="cs-sidebar-group-label">Category</p>
            <p class="cs-sidebar-group-value"><?php echo e($item['category']); ?></p>
        </div>

        <?php if (!empty($item['role'])): ?>
        <div class="cs-sidebar-group">
            <p class="cs-sidebar-group-label">My Role</p>
            <p class="cs-sidebar-group-value"><?php echo e($item['role']); ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['timeline'])): ?>
        <div class="cs-sidebar-group">
            <p class="cs-sidebar-group-label">Timeline</p>
            <p class="cs-sidebar-group-value"><?php echo e($item['timeline']); ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($toolsList)): ?>
        <div class="cs-sidebar-group">
            <p class="cs-sidebar-group-label">Tools Used</p>
            <ul class="cs-tag-list">
                <?php foreach ($toolsList as $tool): ?>
                    <li class="cs-tag"><?php echo e($tool); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($deliverablesList)): ?>
        <div class="cs-sidebar-group">
            <p class="cs-sidebar-group-label">Deliverables</p>
            <ul class="cs-tag-list">
                <?php foreach ($deliverablesList as $deliverable): ?>
                    <li class="cs-tag"><?php echo e($deliverable); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="cs-sidebar-group" style="margin-top:32px;">
            <a href="contact.php" class="btn btn-primary-modern" style="width:100%;display:block;text-align:center;">
                Start Your Project <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="cs-sidebar-group" style="margin-top:12px;">
            <a href="portfolio.php" style="display:flex;align-items:center;gap:8px;font-size:14px;color:var(--text-muted,#777);text-decoration:none;justify-content:center;">
                <i class="fas fa-arrow-left"></i> Back to Portfolio
            </a>
        </div>
    </aside>
</div>

<!-- Related Projects -->
<?php if (!empty($relatedItems)): ?>
<section class="cs-related">
    <div class="cs-related-inner">
        <div class="cs-related-header" data-aos="fade-up">
            <h2>More <?php echo e($item['category']); ?> Projects</h2>
            <p>Explore more work in this category</p>
        </div>
        <div class="cs-related-grid">
            <?php foreach ($relatedItems as $ri): ?>
            <a href="portfolio-detail.php?id=<?php echo urlencode($ri['id']); ?>" class="cs-related-card" data-aos="fade-up">
                <img
                    src="<?php echo e(getImageUrl($ri['image_url'])); ?>"
                    alt="<?php echo e($ri['title']); ?>"
                    class="cs-related-card-image"
                    loading="lazy"
                >
                <div class="cs-related-card-body">
                    <span class="cs-related-card-category"><?php echo e($ri['category']); ?></span>
                    <h3 class="cs-related-card-title"><?php echo e($ri['title']); ?></h3>
                    <p class="cs-related-card-desc"><?php echo e($ri['description']); ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="cs-cta" data-aos="fade-up">
    <h2>Ready to Start Your Project?</h2>
    <p>Let's collaborate and create something exceptional together. Reach out — we'd love to hear about your vision.</p>
    <a href="contact.php" class="btn btn-outline-modern btn-lg" style="color:#fff;border-color:rgba(255,255,255,0.5);">
        Get in Touch <i class="fas fa-arrow-right"></i>
    </a>
</section>

<?php include 'includes/site-footer.php'; ?>
