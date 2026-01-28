<?php
// portfolio.php - Full Portfolio Gallery Page
require_once 'config/config.php';

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
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Portfolio - <?php echo e($siteName); ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Portfolio Page Specific Styles */
    .portfolio-header {
      text-align: center;
      padding: 80px 20px 40px;
      background: linear-gradient(135deg, var(--accent-2) 0%, var(--card) 100%);
    }

    .portfolio-header h1 {
      font-size: 48px;
      font-weight: 800;
      margin-bottom: 16px;
      color: var(--text);
    }

    .portfolio-header p {
      font-size: 18px;
      color: var(--muted);
      max-width: 600px;
      margin: 0 auto;
    }

    .portfolio-filters {
      max-width: 1400px;
      margin: 40px auto;
      padding: 0 min(2rem, 8%);
    }

    .filter-tabs {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
      background: var(--card);
      border-radius: 12px;
      box-shadow: var(--shadow);
    }

    .filter-tab {
      padding: 10px 24px;
      border-radius: 25px;
      text-decoration: none;
      color: var(--muted);
      font-weight: 600;
      font-size: 14px;
      background: transparent;
      border: 2px solid var(--gray-200);
      transition: all 0.3s;
    }

    .filter-tab:hover {
      border-color: var(--accent);
      color: var(--accent);
    }

    .filter-tab.active {
      background: var(--accent);
      color: white;
      border-color: var(--accent);
    }

    .portfolio-section {
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px min(2rem, 8%);
    }

    .portfolio-count {
      text-align: center;
      color: var(--muted);
      margin-bottom: 40px;
      font-size: 16px;
    }

    .portfolio-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 32px;
    }

    .portfolio-item {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      background: var(--card);
    }

    .portfolio-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .portfolio-item-image {
      position: relative;
      width: 100%;
      height: 300px;
      overflow: hidden;
      background: var(--gray-100);
    }

    .portfolio-item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .portfolio-item:hover .portfolio-item-image img {
      transform: scale(1.08);
    }

    .portfolio-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(
        to top,
        rgba(24, 77, 55, 0.95) 0%,
        rgba(24, 77, 55, 0.7) 50%,
        rgba(24, 77, 55, 0) 100%
      );
      display: flex;
      align-items: flex-end;
      padding: 24px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .portfolio-item:hover .portfolio-overlay {
      opacity: 1;
    }

    .portfolio-info {
      text-align: left;
      width: 100%;
    }

    .portfolio-category {
      display: inline-block;
      padding: 4px 12px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
      backdrop-filter: blur(10px);
    }

    .portfolio-info h4 {
      color: white;
      font-size: 22px;
      font-weight: 700;
      margin: 8px 0;
      line-height: 1.3;
    }

    .portfolio-info p {
      color: rgba(255, 255, 255, 0.9);
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 12px;
    }

    .portfolio-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: white;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      padding: 8px 16px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 6px;
      backdrop-filter: blur(10px);
      transition: all 0.3s;
    }

    .portfolio-link:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateX(4px);
    }

    .empty-state {
      text-align: center;
      padding: 80px 20px;
      color: var(--muted);
    }

    .empty-state i {
      font-size: 64px;
      margin-bottom: 20px;
      opacity: 0.3;
    }

    .empty-state h3 {
      font-size: 24px;
      margin-bottom: 12px;
    }

    @media (max-width: 768px) {
      .portfolio-header h1 {
        font-size: 32px;
      }

      .portfolio-grid {
        grid-template-columns: 1fr;
      }

      .filter-tabs {
        justify-content: flex-start;
      }
    }
  </style>
</head>
<body data-theme="light">
  <div class="container">
    <header>
      <div class="brand"><?php echo e($siteName); ?></div>
      <nav id="mainNav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="index.php#about" class="nav-link">About</a>
        <a href="portfolio.php" class="nav-link">Portfolio</a>
        <a href="index.php#contact" class="nav-link">Contact</a>
      </nav>
      <div class="controls">
        <div class="theme-toggle" id="themeToggle"><i class="fa-solid fa-sun"></i></div>
        <div class="toggle hamburger" id="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </header>

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

    <footer>
      © <span id="year"></span> <?php echo e($siteName); ?> • Crafted with care
    </footer>
    
    <!-- Scroll to top button -->
    <button class="scroll-top" id="scrollTop">↑</button>
  </div>

  <script>
    // Hamburger menu toggle
    (function(){
      const hamburger = $('#hamburger');
      const nav = $('#mainNav');
      
      hamburger.on('click', function(e){
        e.stopPropagation();
        $(this).toggleClass('active');
        nav.toggleClass('active');
      });
      
      $('.nav-link').on('click', function(){
        hamburger.removeClass('active');
        nav.removeClass('active');
      });
      
      $(document).on('click', function(e){
        if(!$(e.target).closest('header').length){
          hamburger.removeClass('active');
          nav.removeClass('active');
        }
      });
    })();

    // theme toggle
    (function(){
      const btn = $('#themeToggle');
      const root = $('body');
      const saved = localStorage.getItem('md-theme') || 'light';
      root.attr('data-theme', saved);
      btn.html(saved==='light'?'<i class="fa-solid fa-moon"></i>':'<i class="fa-solid fa-sun"></i>');
      btn.on('click', function(){
        const cur = root.attr('data-theme');
        const next = cur === 'light' ? 'dark' : 'light';
        root.attr('data-theme', next);
        btn.html(next==='light'?'<i class="fa-solid fa-moon"></i>':'<i class="fa-solid fa-sun"></i>');
        localStorage.setItem('md-theme', next);
      })
    })();

    // footer year
    $('#year').text(new Date().getFullYear());

    // Scroll to top button
    (function(){
      const scrollBtn = $('#scrollTop');
      
      $(window).on('scroll', function(){
        if($(window).scrollTop() > 300){
          scrollBtn.addClass('visible');
        } else {
          scrollBtn.removeClass('visible');
        }
      });
      
      scrollBtn.on('click', function(){
        $('html, body').animate({scrollTop: 0}, 400);
      });
    })();
  </script>
</body>
</html>