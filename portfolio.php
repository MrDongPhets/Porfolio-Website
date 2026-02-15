<?php
// portfolio.php - Full Portfolio Gallery Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Portfolio';

// Get filter category
$filterCategory = $_GET['category'] ?? 'all';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');

// Temporary portfolio data (will be replaced with backend later)
$portfolioItems = [
    [
        'title' => 'Tech Startup Branding',
        'category' => 'Branding',
        'description' => 'Complete brand identity for an AI-powered SaaS platform',
        'image_url' => 'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=800',
        'project_url' => '#',
        'is_featured' => true
    ],
    [
        'title' => 'E-Commerce Website',
        'category' => 'Web Design',
        'description' => 'Modern online store with seamless checkout experience',
        'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800',
        'project_url' => '#',
        'is_featured' => true
    ],
    [
        'title' => 'Social Media Campaign',
        'category' => 'Content Creation',
        'description' => 'Viral Instagram campaign generating 2M+ impressions',
        'image_url' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=800',
        'project_url' => '#',
        'is_featured' => false
    ],
    [
        'title' => 'Product Launch Video',
        'category' => 'Video Editing',
        'description' => 'High-impact promotional video for tech product launch',
        'image_url' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=800',
        'project_url' => '#',
        'is_featured' => true
    ],
    [
        'title' => 'Corporate Presentation',
        'category' => 'Content Creation',
        'description' => 'Professional pitch deck for Fortune 500 company',
        'image_url' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800',
        'project_url' => '#',
        'is_featured' => false
    ],
    [
        'title' => 'Mobile App UI Design',
        'category' => 'Web Design',
        'description' => 'Intuitive interface design for fitness tracking app',
        'image_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800',
        'project_url' => '#',
        'is_featured' => true
    ],
    [
        'title' => 'Restaurant Rebrand',
        'category' => 'Branding',
        'description' => 'Fresh visual identity for farm-to-table restaurant',
        'image_url' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800',
        'project_url' => '#',
        'is_featured' => false
    ],
    [
        'title' => 'YouTube Channel Growth',
        'category' => 'Video Editing',
        'description' => 'Series of viral videos increasing subscribers by 300%',
        'image_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800',
        'project_url' => '#',
        'is_featured' => false
    ],
    [
        'title' => 'Fashion Brand Website',
        'category' => 'Web Design',
        'description' => 'Elegant e-commerce site with immersive photography',
        'image_url' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800',
        'project_url' => '#',
        'is_featured' => true
    ],
    [
        'title' => 'Annual Report Design',
        'category' => 'Content Creation',
        'description' => 'Data visualization and infographic-rich annual report',
        'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800',
        'project_url' => '#',
        'is_featured' => false
    ],
    [
        'title' => 'Real Estate Marketing',
        'category' => 'Content Creation',
        'description' => 'Luxury property marketing materials and virtual tours',
        'image_url' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800',
        'project_url' => '#',
        'is_featured' => false
    ],
    [
        'title' => 'Documentary Editing',
        'category' => 'Video Editing',
        'description' => 'Award-winning short documentary on climate change',
        'image_url' => 'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=800',
        'project_url' => '#',
        'is_featured' => true
    ]
];

// Filter by category if not 'all'
if ($filterCategory !== 'all') {
    $portfolioItems = array_filter($portfolioItems, function($item) use ($filterCategory) {
        return strtolower($item['category']) === strtolower($filterCategory);
    });
}

// Get unique categories
$categories = array_unique(array_column($portfolioItems, 'category'));
sort($categories);

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
          <span class="stat-number">150+</span>
          <span class="stat-label">Projects Completed</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">98%</span>
          <span class="stat-label">Client Satisfaction</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">50+</span>
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
                      <a href="<?php echo e($item['project_url']); ?>" class="carousel-link">
                        View Project <i class="fas fa-arrow-right"></i>
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
                    <a href="<?php echo e($item['project_url']); ?>" target="_blank" class="portfolio-btn">
                      <span>View Project</span>
                      <i class="fas fa-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Load More Button -->
        <div class="load-more-container" data-aos="fade-up">
          <button class="btn btn-outline-modern" id="loadMoreBtn">
            Load More Projects <i class="fas fa-chevron-down"></i>
          </button>
        </div>
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

    <!-- CTA Section -->
    <section class="portfolio-cta" data-aos="fade-up">
      <div class="cta-content">
        <h2>Have a Project in Mind?</h2>
        <p>Let's collaborate to create something amazing together</p>
        <a href="<?php echo baseUrl(); ?>#contact" class="btn btn-primary-modern btn-lg">
          Start Your Project <i class="fas fa-arrow-right"></i>
        </a>
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