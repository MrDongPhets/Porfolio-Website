<?php
// index.php - Dynamic Homepage with Modern UI/UX
require_once 'config/config.php';

// Set page title
$pageTitle = 'Home';

// Fetch hero section data
$hero = null;
$result = $db->select('hero_section', '*', ['is_active' => true], 'created_at.desc', 1);
if ($result['success'] && !empty($result['data'])) {
    $hero = $result['data'][0];
}

// Fetch about section data
$about = null;
$result = $db->select('about_section', '*', ['is_active' => true], 'updated_at.desc', 1);
if ($result['success'] && !empty($result['data'])) {
    $about = $result['data'][0];
}

// Fetch services (all for homepage)
$services = [];
$result = $db->select('services', '*', ['is_active' => true], 'display_order.asc');
if ($result['success'] && !empty($result['data'])) {
    $services = $result['data'];
}

// Fetch work steps
$workSteps = [];
$result = $db->select('work_steps', '*', ['is_active' => true], 'step_order.asc');
if ($result['success'] && !empty($result['data'])) {
    $workSteps = $result['data'];
}

// Fetch testimonials
$testimonials = [];
$result = $db->select('testimonials', '*', ['is_active' => true], 'display_order.asc');
if ($result['success'] && !empty($result['data'])) {
    $testimonials = $result['data'];
}

// Fetch portfolio items (featured or latest 6 for homepage)
$portfolioItems = [];
$result = $db->select('portfolio_items', '*', ['is_active' => true], 'is_featured.desc,created_at.desc', 6);
if ($result['success'] && !empty($result['data'])) {
    $portfolioItems = $result['data'];
}

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- HERO SECTION - MODERN DESIGN -->
    <section class="hero-modern">
      <div class="hero-content-modern" data-aos="fade-up" data-aos-delay="200">
        <h1 class="hero-title-modern">
          <?php echo e($hero['title'] ?? 'Where Stunning Design Meets Flawless Functionality'); ?>
        </h1>
        <p class="hero-subtitle-modern">
          <?php echo e($hero['subtitle'] ?? 'We craft all your designs: logos, flyers, branding, brochures, Figma landing pages, print-ready PDFs, and everything in between — with seamless collaboration and lightning-fast delivery.'); ?>
        </p>
        
        <div class="hero-cta-buttons" data-aos="fade-up" data-aos-delay="400">
          <button class="btn btn-primary-modern" id="cta">
            <?php echo e($hero['cta_text'] ?? 'Get Started Today'); ?>
            <i class="fas fa-arrow-right"></i>
          </button>
          <a href="#portfolio" class="btn btn-outline-modern">
            <i class="fas fa-play-circle"></i> View Our Work
          </a>
        </div>
      </div>

      <div class="hero-image-modern" data-aos="zoom-in" data-aos-delay="600">
        <?php if (!empty($hero['image_url'])): ?>
          <img src="<?php echo e(getImageUrl($hero['image_url'])); ?>" alt="hero image" class="hero-img-rounded">
        <?php else: ?>
          <img src="<?php echo asset('hero.png'); ?>" alt="Creative team collaboration" class="hero-img-rounded">
        <?php endif; ?>
        
        <!-- Floating elements -->
        <div class="float-element float-1" data-aos="fade-left" data-aos-delay="800">
          <i class="fas fa-palette"></i>
        </div>
        <div class="float-element float-2" data-aos="fade-right" data-aos-delay="1000">
          <i class="fas fa-code"></i>
        </div>
        <div class="float-element float-3" data-aos="fade-up" data-aos-delay="1200">
          <i class="fas fa-rocket"></i>
        </div>
      </div>

      <!-- Trusted brands section -->
      <div class="trusted-brands" data-aos="fade-up" data-aos-delay="800">
        <p class="trusted-text">TRUSTED BY LEADING BRANDS</p>
        <div class="brand-logos">
          <div class="brand-logo">bento</div>
          <div class="brand-logo">zerod</div>
          <div class="brand-logo">MNTO</div>
          <div class="brand-logo">dialon</div>
          <div class="brand-logo">Limobuz</div>
          <div class="brand-logo">Piwurz</div>
        </div>
      </div>
    </section>

    <!-- ABOUT SECTION - MODERN TWO COLUMN -->
    <section id="about" class="about-modern">
      <div class="about-container">
        <div class="about-content" data-aos="fade-right">
          <h2 class="section-title-modern">
            <?php echo e($about['title'] ?? 'Unforgettable. Websites, Brands & Visuals for Bold Visionaries.'); ?>
          </h2>
          <p class="about-description">
            <?php echo nl2br(e($about['content'] ?? 'When you work with an elite agency, you don\'t just get a design. You walk away with a strategic partner who obsesses over every pixel, every color, and every user interaction. Whether it\'s a knockout logo, an immersive brand identity, or a Figma prototype that developers love—we deliver perfection.')); ?>
          </p>
          <button class="btn btn-primary-modern"
  onclick="window.location.href='about.php'">
  Explore More <i class="fas fa-arrow-right"></i>
</button>
        </div>
        
        <div class="about-image" data-aos="fade-left">
          <?php if (!empty($about['image_url'])): ?>
            <img src="<?php echo e(getImageUrl($about['image_url'])); ?>" alt="about illustration" class="about-img-rounded">
          <?php else: ?>
            <img src="<?php echo asset('about-2.png'); ?>" alt="Creative workspace" class="about-img-rounded">
          <?php endif; ?>
        </div>
      </div>

      <!-- Stats section -->
      <div class="stats-section" data-aos="fade-up">
        <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
          <div class="stat-icon">
            <i class="fas fa-rocket"></i>
          </div>
          <h3 class="stat-number">72</h3>
          <p class="stat-label">Projects completed</p>
        </div>
        
        <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
          <div class="stat-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3 class="stat-number">100+</h3>
          <p class="stat-label">Happy clients</p>
        </div>
        
        <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
          <div class="stat-icon">
            <i class="fas fa-clock"></i>
          </div>
          <h3 class="stat-number">10+</h3>
          <p class="stat-label">Years of experience</p>
        </div>
      </div>
    </section>

<!-- SERVICES SECTION - HARDCODED -->
    <section id="services" class="services-modern">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Services We Offer</h2>
        <p class="section-subtitle">Comprehensive design solutions tailored to your needs</p>
      </div>

      <div class="services-grid-modern">
        <!-- Service 1: Web Design & Development -->
        <div class="service-card-modern" data-aos="fade-up" data-aos-delay="0">
          <div class="service-number">01</div>
          <div class="service-icon-modern">
            <i class="fas fa-laptop-code"></i>
          </div>
          <h3 class="service-title">Web Design & Development</h3>
          <p class="service-description">Custom websites and web applications that combine stunning design with powerful functionality.</p>
          <ul class="service-features">
            <li><i class="fas fa-check"></i> Responsive design</li>
            <li><i class="fas fa-check"></i> Fast performance</li>
            <li><i class="fas fa-check"></i> SEO optimized</li>
          </ul>
          <a href="<?php echo baseUrl('web-design.php'); ?>" class="service-link-btn">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 2: Branding & Creative Design -->
        <div class="service-card-modern" data-aos="fade-up" data-aos-delay="100">
          <div class="service-number">02</div>
          <div class="service-icon-modern">
            <i class="fas fa-palette"></i>
          </div>
          <h3 class="service-title">Branding & Creative Design</h3>
          <p class="service-description">Logo design, brand identity systems, and marketing visuals that strengthen brand recognition.</p>
          <ul class="service-features">
            <li><i class="fas fa-check"></i> Logo design</li>
            <li><i class="fas fa-check"></i> Brand guidelines</li>
            <li><i class="fas fa-check"></i> Marketing materials</li>
          </ul>
          <a href="<?php echo baseUrl('branding.php'); ?>" class="service-link-btn">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 3: Video Editing & Multimedia -->
        <div class="service-card-modern" data-aos="fade-up" data-aos-delay="200">
          <div class="service-number">03</div>
          <div class="service-icon-modern">
            <i class="fas fa-video"></i>
          </div>
          <h3 class="service-title">Video Editing & Multimedia</h3>
          <p class="service-description">Short-form social videos, long-form content editing, promotional assets, and branded video production.</p>
          <ul class="service-features">
            <li><i class="fas fa-check"></i> Social media videos</li>
            <li><i class="fas fa-check"></i> YouTube editing</li>
            <li><i class="fas fa-check"></i> Motion graphics</li>
          </ul>
          <a href="<?php echo baseUrl('video-editing.php'); ?>" class="service-link-btn">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 4: Content Creation & Media -->
        <div class="service-card-modern" data-aos="fade-up" data-aos-delay="300">
          <div class="service-number">04</div>
          <div class="service-icon-modern">
            <i class="fas fa-images"></i>
          </div>
          <h3 class="service-title">Content Creation & Media</h3>
          <p class="service-description">Visual content, marketing graphics, multimedia assets, and branded materials for digital engagement.</p>
          <ul class="service-features">
            <li><i class="fas fa-check"></i> Social media content</li>
            <li><i class="fas fa-check"></i> Marketing graphics</li>
            <li><i class="fas fa-check"></i> Infographics</li>
          </ul>
          <a href="<?php echo baseUrl('content-creation.php'); ?>" class="service-link-btn">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 5: Administrative Support -->
        <div class="service-card-modern" data-aos="fade-up" data-aos-delay="400">
          <div class="service-number">05</div>
          <div class="service-icon-modern">
            <i class="fas fa-user-cog"></i>
          </div>
          <h3 class="service-title">Administrative & Executive Support</h3>
          <p class="service-description">Virtual assistance, operational coordination, documentation, CRM management, and workflow optimization.</p>
          <ul class="service-features">
            <li><i class="fas fa-check"></i> Email management</li>
            <li><i class="fas fa-check"></i> CRM coordination</li>
            <li><i class="fas fa-check"></i> Task automation</li>
          </ul>
          <a href="<?php echo baseUrl('admin-support.php'); ?>" class="service-link-btn">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div style="text-align:center; margin-top:48px;" data-aos="fade-up">
        <a href="<?php echo baseUrl('services.php'); ?>" class="btn btn-outline-modern">
          View All Services <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </section>

    <!-- PORTFOLIO SECTION - SHOWCASE GRID -->
    <section id="portfolio" class="portfolio-modern">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Showcase of Selected Work</h2>
        <p class="section-subtitle">Explore our latest projects and creative solutions</p>
      </div>

      <div class="portfolio-grid-modern">
        <?php if (!empty($portfolioItems)): ?>
          <?php foreach ($portfolioItems as $index => $item): ?>
            <div class="portfolio-card-modern" data-aos="zoom-in" data-aos-delay="<?php echo $index * 100; ?>">
              <div class="portfolio-image-wrapper">
                <img src="<?php echo e(getImageUrl($item['image_url'])); ?>" alt="<?php echo e($item['title']); ?>">
                <div class="portfolio-overlay-modern">
                  <div class="portfolio-overlay-content">
                    <span class="portfolio-category-badge"><?php echo e($item['category']); ?></span>
                    <h3><?php echo e($item['title']); ?></h3>
                    <?php if (!empty($item['description'])): ?>
                      <p><?php echo e(truncate($item['description'], 80)); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($item['project_url'])): ?>
                      <a href="<?php echo e($item['project_url']); ?>" target="_blank" class="btn btn-white-sm">
                        View Project <i class="fas fa-arrow-right"></i>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="portfolio-info-modern">
                <h4><?php echo e($item['title']); ?></h4>
                <p class="portfolio-meta">
                  <span class="category"><?php echo e($item['category']); ?></span>
                  <span class="separator">•</span>
                  <span class="date"><?php echo date('M Y', strtotime($item['created_at'])); ?></span>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Temporary portfolio items -->
          <div class="portfolio-card-modern" data-aos="zoom-in">
            <div class="portfolio-image-wrapper">
              <img src="<?php echo asset('hero.png'); ?>" alt="Fintech Design">
              <div class="portfolio-overlay-modern">
                <div class="portfolio-overlay-content">
                  <span class="portfolio-category-badge">UI/UX DESIGN</span>
                  <h3>Fintech Design - Google Study</h3>
                  <p>Modern fintech application design with seamless user experience</p>
                  <a href="#" class="btn btn-white-sm">
                    View Project <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="portfolio-info-modern">
              <h4>Fintech Design - Google Study</h4>
              <p class="portfolio-meta">
                <span class="category">UI/UX DESIGN</span>
                <span class="separator">•</span>
                <span class="date">3.2K FOLLOWERS</span>
              </p>
            </div>
          </div>
          
          <div class="portfolio-card-modern" data-aos="zoom-in" data-aos-delay="100">
            <div class="portfolio-image-wrapper">
              <img src="<?php echo asset('about-2.png'); ?>" alt="Cosmetic Brand Design">
              <div class="portfolio-overlay-modern">
                <div class="portfolio-overlay-content">
                  <span class="portfolio-category-badge">BRANDING</span>
                  <h3>Cosmetic - Brand Design</h3>
                  <p>Complete brand identity for a modern cosmetic line</p>
                  <a href="#" class="btn btn-white-sm">
                    View Project <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="portfolio-info-modern">
              <h4>Cosmetic - Brand Design</h4>
              <p class="portfolio-meta">
                <span class="category">BRANDING</span>
                <span class="separator">•</span>
                <span class="date">8.2K FOLLOWERS</span>
              </p>
            </div>
          </div>
          
          <div class="portfolio-card-modern" data-aos="zoom-in" data-aos-delay="200">
            <div class="portfolio-image-wrapper">
              <img src="<?php echo asset('service.jpg'); ?>" alt="Luxuria Website">
              <div class="portfolio-overlay-modern">
                <div class="portfolio-overlay-content">
                  <span class="portfolio-category-badge">WEB DESIGN</span>
                  <h3>Luxuria - Workflow Website</h3>
                  <p>Elegant e-commerce website with smooth animations</p>
                  <a href="#" class="btn btn-white-sm">
                    View Project <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="portfolio-info-modern">
              <h4>Luxuria - Workflow Website</h4>
              <p class="portfolio-meta">
                <span class="category">WEB DESIGN</span>
                <span class="separator">•</span>
                <span class="date">12.4K FOLLOWERS</span>
              </p>
            </div>
          </div>
          
          <div class="portfolio-card-modern" data-aos="zoom-in" data-aos-delay="300">
            <div class="portfolio-image-wrapper">
              <img src="<?php echo asset('hero.png'); ?>" alt="Dashboard Design">
              <div class="portfolio-overlay-modern">
                <div class="portfolio-overlay-content">
                  <span class="portfolio-category-badge">UI/UX</span>
                  <h3>Dashboard - Saas Web of E-Stock</h3>
                  <p>Comprehensive dashboard design for stock management</p>
                  <a href="#" class="btn btn-white-sm">
                    View Project <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="portfolio-info-modern">
              <h4>Dashboard - Saas Web of E-Stock</h4>
              <p class="portfolio-meta">
                <span class="category">UI/UX</span>
                <span class="separator">•</span>
                <span class="date">5.8K FOLLOWERS</span>
              </p>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <div class="text-center" data-aos="fade-up" style="margin-top: 48px;">
        <a href="<?php echo baseUrl('portfolio.php'); ?>" class="btn btn-outline-modern">
          View All Projects <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </section>

    <!-- TESTIMONIALS SECTION - MODERN CARDS -->
    <section id="reviews" class="testimonials-modern">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">What Clients Say About Us</h2>
        <p class="section-subtitle">Don't just take our word for it</p>
      </div>

      <div class="testimonials-grid">
        <?php if (!empty($testimonials)): ?>
          <?php foreach (array_slice($testimonials, 0, 3) as $index => $testimonial): ?>
            <div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
              <div class="testimonial-rating">
                <div class="rating-stars">
                  <?php for ($i = 0; $i < 5; $i++): ?>
                    <i class="fas fa-star <?php echo $i < $testimonial['rating'] ? 'active' : ''; ?>"></i>
                  <?php endfor; ?>
                </div>
                <span class="rating-number"><?php echo $testimonial['rating']; ?>.0</span>
                <span class="rating-text">Excellent</span>
              </div>
              
              <p class="testimonial-text"><?php echo e($testimonial['testimonial']); ?></p>
              
              <div class="testimonial-author">
                <div class="author-avatar">
                  <?php if (!empty($testimonial['avatar_url'])): ?>
                    <img src="<?php echo e(getImageUrl($testimonial['avatar_url'])); ?>" alt="<?php echo e($testimonial['client_name']); ?>">
                  <?php else: ?>
                    <?php 
                      $initials = implode('', array_map(function($word) { 
                        return strtoupper(substr($word, 0, 1)); 
                      }, array_slice(explode(' ', $testimonial['client_name']), 0, 2)));
                    ?>
                    <div class="avatar-placeholder"><?php echo $initials; ?></div>
                  <?php endif; ?>
                </div>
                <div class="author-info">
                  <h4><?php echo e($testimonial['client_name']); ?></h4>
                  <p><?php echo e($testimonial['company'] ?? 'Verified Customer'); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Temporary testimonials -->
          <div class="testimonial-card-modern" data-aos="fade-up">
            <div class="testimonial-rating">
              <div class="rating-stars">
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
              </div>
              <span class="rating-number">4.9</span>
              <span class="rating-text">Excellent</span>
            </div>
            
            <p class="testimonial-text">"Great project! people who truly understand the essence of brand design. They took time to get to know our team, our values, and our vision. I can't recommend them enough."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">SM</div>
              </div>
              <div class="author-info">
                <h4>Sarah M.</h4>
                <p>CEO, Tech Startup</p>
              </div>
            </div>
          </div>
          
          <div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial-rating">
              <div class="rating-stars">
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
              </div>
              <span class="rating-number">4.7</span>
              <span class="rating-text">Great</span>
            </div>
            
            <p class="testimonial-text">"I can't say enough great things about this design team! From our very first call, they were professional, creative, and genuinely excited about our project."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">DJ</div>
              </div>
              <div class="author-info">
                <h4>David J.</h4>
                <p>Marketing Director</p>
              </div>
            </div>
          </div>
          
          <div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial-rating">
              <div class="rating-stars">
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
                <i class="fas fa-star active"></i>
              </div>
              <span class="rating-number">4.8</span>
              <span class="rating-text">Amazing</span>
            </div>
            
            <p class="testimonial-text">"I can confidently say that our project exceeded all expectations thanks to the design agency. Their dedication to ensuring every detail was right."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">EL</div>
              </div>
              <div class="author-info">
                <h4>Emma L.</h4>
                <p>Product Manager</p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- BLOG SECTION - THE STUDIO JOURNAL -->
    <section class="blog-modern">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">The Studio Journal</h2>
        <p class="section-subtitle">Latest insights and updates from our team</p>
      </div>

      <div class="blog-grid">
        <article class="blog-card" data-aos="fade-up">
          <div class="blog-image">
            <img src="<?php echo asset('hero.png'); ?>" alt="Blog post">
            <span class="blog-category">DESIGN</span>
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <span><i class="far fa-calendar"></i> Jan 15, 2024</span>
              <span><i class="far fa-clock"></i> 5 min read</span>
            </div>
            <h3>How We Reached Cross-Collaboration in 2024: How Figma UX/UI Changed</h3>
            <p>Discover how modern design tools are revolutionizing team collaboration and workflow efficiency...</p>
            <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>

        <article class="blog-card" data-aos="fade-up" data-aos-delay="100">
          <div class="blog-image">
            <img src="<?php echo asset('about-2.png'); ?>" alt="Blog post">
            <span class="blog-category">TUTORIAL</span>
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <span><i class="far fa-calendar"></i> Jan 12, 2024</span>
              <span><i class="far fa-clock"></i> 8 min read</span>
            </div>
            <h3>Why This Color Palette Best Works Your Next Corporate Brand</h3>
            <p>Learn the psychology behind color choices and how to create impactful brand identities...</p>
            <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>

        <article class="blog-card" data-aos="fade-up" data-aos-delay="200">
          <div class="blog-image">
            <img src="<?php echo asset('service.jpg'); ?>" alt="Blog post">
            <span class="blog-category">INSIGHTS</span>
          </div>
          <div class="blog-content">
            <div class="blog-meta">
              <span><i class="far fa-calendar"></i> Jan 10, 2024</span>
              <span><i class="far fa-clock"></i> 6 min read</span>
            </div>
            <h3>WordsPress vs. Webflow — Say Developers Coding The Reality</h3>
            <p>A comprehensive comparison of popular web development platforms from a developer's perspective...</p>
            <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
      </div>
    </section>

    <!-- CTA SECTION - MEET THE MINDS -->
    <section class="cta-modern" data-aos="fade-up">
      <div class="cta-content">
        <div class="cta-icon">
          <i class="fas fa-lightbulb"></i>
        </div>
        <h2>Meet the Minds Behind the Magic</h2>
        <p>We don't just create designs—we craft experiences that turn heads, spark emotions, and drive results. Ready to start your next project?</p>
        <button class="btn btn-primary-modern btn-lg" id="cta-bottom">
          Get Started Today <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="contact-modern">
      <div class="contact-container">
        <div class="contact-info" data-aos="fade-right">
          <h2>Get the Good Inspiration</h2>
          <p>Want us design something special for you or just curious about our rates? Drop us a message and we'll get back to you within 24 hours.</p>
          
          <div class="contact-details">
            <div class="contact-item">
              <i class="fas fa-envelope"></i>
              <div>
                <h4>Email</h4>
                <a href="mailto:<?php echo e($contactEmail); ?>"><?php echo e($contactEmail); ?></a>
              </div>
            </div>
            
            <div class="contact-item">
              <i class="fas fa-phone"></i>
              <div>
                <h4>Phone</h4>
                <a href="tel:+1234567890">+1 (234) 567-890</a>
              </div>
            </div>
            
            <div class="contact-item">
              <i class="fas fa-map-marker-alt"></i>
              <div>
                <h4>Location</h4>
                <p>San Francisco, CA</p>
              </div>
            </div>
          </div>

          <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-dribbble"></i></a>
          </div>
        </div>

        <form id="contactForm" class="contact-form-modern" data-aos="fade-left">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Name *</label>
              <input type="text" id="name" required placeholder="Your full name">
            </div>
            
            <div class="form-group">
              <label for="email">Email *</label>
              <input type="email" id="email" required placeholder="your@email.com">
            </div>
          </div>
          
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" placeholder="What is this about?">
          </div>
          
          <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" rows="5" required placeholder="Tell us about your project..."></textarea>
          </div>
          
          <button type="submit" class="btn btn-primary-modern btn-block">
            Send Message <i class="fas fa-paper-plane"></i>
          </button>
        </form>
      </div>
    </section>

    <script>
      // Pass testimonials from PHP to JavaScript
      const reviews = <?php echo json_encode($testimonials ?? []); ?>;
      
      // CTA button scroll to contact
      document.getElementById('cta')?.addEventListener('click', function() {
        document.getElementById('contact').scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
      
      document.getElementById('cta-bottom')?.addEventListener('click', function() {
        document.getElementById('contact').scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    </script>

<?php include 'includes/site-footer.php'; ?>