<?php
// portfolio.php - Full Portfolio Gallery Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Portfolio';

// Get filter category
$filterCategory = $_GET['category'] ?? 'all';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');

// Fetch all active portfolio items from database
$allPortfolioItems = [];
$result = $db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc,created_at.desc');
if ($result['success'] && !empty($result['data'])) {
    $allPortfolioItems = $result['data'];
}

// Get unique categories from ALL items (before filtering)
$categories = array_unique(array_column($allPortfolioItems, 'category'));
sort($categories);

// Filter by category
$portfolioItems = $allPortfolioItems;
if ($filterCategory !== 'all') {
    $portfolioItems = array_values(array_filter($allPortfolioItems, function($item) use ($filterCategory) {
        return strtolower($item['category']) === strtolower($filterCategory);
    }));
}

// Include header
include 'includes/site-header.php';
?>

    <!-- Portfolio Hero -->
    <section class="portfolio-hero">
      <div class="portfolio-hero-content" data-aos="fade-up">
        <h1>Our Portfolio</h1>
        <p>Discover our creative journey through a collection of carefully crafted projects</p>
      </div>
      
      <!-- Floating stats -->
      <div class="portfolio-stats" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-item">
          <span class="stat-number"><?php echo count($allPortfolioItems); ?></span>
          <span class="stat-label">Projects Completed</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">98%</span>
          <span class="stat-label">Client Satisfaction</span>
        </div>
        <div class="stat-item">
          <span class="stat-number"><?php echo count($allPortfolioItems); ?></span>
          <span class="stat-label">Happy Clients</span>
        </div>
      </div>
    </section>

    <!-- Featured Projects Carousel -->
    <section class="featured-carousel-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Featured Projects</h2>
        <p class="section-subtitle">Our best work showcased</p>
      </div>

      <div class="featured-carousel" data-aos="zoom-in" data-aos-delay="200">
        <div class="carousel-container">
          <button class="carousel-btn prev-btn" id="prevBtn">
            <i class="fas fa-chevron-left"></i>
          </button>
          
          <div class="carousel-track-container">
            <div class="carousel-track" id="carouselTrack">
              <?php 
              $featuredItems = array_filter($portfolioItems, function($item) {
                  return $item['is_featured'];
              });
              foreach ($featuredItems as $index => $item): 
              ?>
                <div class="carousel-slide">
                  <div class="carousel-image">
                    <img src="<?php echo e($item['image_url']); ?>" alt="<?php echo e($item['title']); ?>">
                    <div class="carousel-overlay">
                      <span class="carousel-category"><?php echo e($item['category']); ?></span>
                      <h3><?php echo e($item['title']); ?></h3>
                      <p><?php echo e($item['description']); ?></p>
                      <a href="portfolio-detail.php?id=<?php echo urlencode($item['id']); ?>" class="carousel-link">
                        View Case Study <i class="fas fa-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          
          <button class="carousel-btn next-btn" id="nextBtn">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
        
        <div class="carousel-indicators" id="carouselIndicators"></div>
      </div>
    </section>

    <!-- Category Filters -->
    <section class="portfolio-filters-section">
      <div class="filter-tabs" data-aos="fade-up">
        <a href="?category=all" class="filter-tab <?php echo $filterCategory === 'all' ? 'active' : ''; ?>">
          <i class="fas fa-th"></i> All Projects
        </a>
        <?php foreach ($categories as $cat): ?>
          <a href="?category=<?php echo urlencode($cat); ?>" class="filter-tab <?php echo $filterCategory === $cat ? 'active' : ''; ?>">
            <?php 
            // Add icons based on category
            $icon = 'fa-folder';
            if (stripos($cat, 'web') !== false) $icon = 'fa-laptop-code';
            elseif (stripos($cat, 'brand') !== false) $icon = 'fa-palette';
            elseif (stripos($cat, 'video') !== false) $icon = 'fa-video';
            elseif (stripos($cat, 'content') !== false) $icon = 'fa-images';
            ?>
            <i class="fas <?php echo $icon; ?>"></i> <?php echo e($cat); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Portfolio Grid with Animations -->
    <section class="portfolio-section">
      <?php if (!empty($portfolioItems)): ?>
        <div class="portfolio-count" data-aos="fade-up">
          <span class="count-number"><?php echo count($portfolioItems); ?></span> 
          project<?php echo count($portfolioItems) !== 1 ? 's' : ''; ?>
          <?php echo $filterCategory !== 'all' ? 'in ' . e($filterCategory) : ''; ?>
        </div>

        <div class="portfolio-grid-masonry">
          <?php foreach ($portfolioItems as $index => $item): ?>
            <div class="portfolio-card" data-aos="fade-up" data-aos-delay="<?php echo ($index % 6) * 50; ?>">
              <div class="portfolio-card-image">
                <img src="<?php echo e($item['image_url']); ?>" alt="<?php echo e($item['title']); ?>" loading="lazy">
                <div class="portfolio-card-overlay">
                  <div class="overlay-content">
                    <span class="portfolio-badge"><?php echo e($item['category']); ?></span>
                    <h3><?php echo e($item['title']); ?></h3>
                    <p><?php echo e($item['description']); ?></p>
                    <a href="portfolio-detail.php?id=<?php echo urlencode($item['id']); ?>" class="portfolio-btn">
                      <span>View Case Study</span>
                      <i class="fas fa-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Load More Button -->
        <!-- <div class="load-more-container" data-aos="fade-up">
          <button class="btn btn-outline-modern" id="loadMoreBtn">
            Load More Projects <i class="fas fa-chevron-down"></i>
          </button>
        </div> -->
      <?php else: ?>
        <div class="empty-state" data-aos="fade-up">
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
    </section>

    <!-- CTA SECTION - MEET THE MINDS -->
    <section class="cta-modern" data-aos="fade-up">
      <div class="cta-content">
        <div class="cta-icon">
          <i class="fas fa-lightbulb"></i>
        </div>
        <h2>Meet the Minds Behind the Magic</h2>
        <p>We don't just create designs—we craft experiences that turn heads, spark emotions, and drive results. Ready to start your next project?</p>
        <button class="btn btn-primary-modern btn-lg" onclick="window.location.href='contact.php'">
          Get Started Today <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </section>

    <script>
      // Carousel functionality
      const track = document.getElementById('carouselTrack');
      const slides = Array.from(track.children);
      const nextBtn = document.getElementById('nextBtn');
      const prevBtn = document.getElementById('prevBtn');
      const indicators = document.getElementById('carouselIndicators');
      
      let currentSlide = 0;
      const totalSlides = slides.length;

      // Create indicators
      slides.forEach((_, index) => {
        const indicator = document.createElement('button');
        indicator.classList.add('indicator');
        if (index === 0) indicator.classList.add('active');
        indicator.addEventListener('click', () => goToSlide(index));
        indicators.appendChild(indicator);
      });

      const indicatorButtons = Array.from(indicators.children);

      function updateSlide() {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        indicatorButtons.forEach((btn, index) => {
          btn.classList.toggle('active', index === currentSlide);
        });
      }

      function goToSlide(index) {
        currentSlide = index;
        updateSlide();
      }

      function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlide();
      }

      function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlide();
      }

      nextBtn.addEventListener('click', nextSlide);
      prevBtn.addEventListener('click', prevSlide);

      // Auto-advance carousel
      setInterval(nextSlide, 5000);

      // Load more functionality (mock)
      const loadMoreBtn = document.getElementById('loadMoreBtn');
      if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
          alert('Load more functionality - Backend integration coming soon!');
        });
      }

      // Add parallax effect on scroll
      window.addEventListener('scroll', () => {
        const cards = document.querySelectorAll('.portfolio-card');
        cards.forEach((card, index) => {
          const rect = card.getBoundingClientRect();
          const scrolled = window.pageYOffset;
          if (rect.top < window.innerHeight && rect.bottom > 0) {
            card.style.transform = `translateY(${scrolled * 0.05 * (index % 2 === 0 ? 1 : -1)}px)`;
          }
        });
      });
    </script>

<?php include 'includes/site-footer.php'; ?>