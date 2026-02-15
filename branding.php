<?php
// services/branding.php - Branding & Creative Design Service Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Branding & Creative Design';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- SERVICE HERO SECTION -->
    <section class="service-hero-section">
      <div class="service-hero-content" data-aos="fade-up">
        <h1 class="service-hero-title">Branding & Creative Design</h1>
        <p class="service-hero-description">
          Logo design, brand identity systems, and marketing visuals that strengthen brand 
          recognition and consistency. We create cohesive visual languages that tell your 
          story and resonate with your audience across every touchpoint.
        </p>
        <a href="#process" class="btn btn-primary-modern btn-lg">
          Explore Our Process <i class="fas fa-arrow-down"></i>
        </a>
      </div>

      <div class="service-hero-image" data-aos="fade-left" data-aos-delay="200">
        <img src="<?php echo asset('about-2.png'); ?>" alt="Brand Design Process">
        <div class="hero-badge-floating">
          <span class="badge-icon">★</span>
          <span class="badge-text">Award Winning</span>
        </div>
      </div>
    </section>

    <!-- BRAND EXCELLENCE SECTION -->
    <section class="design-works-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Brands That Stand Out & Stay Memorable</h2>
        <p class="section-subtitle-large">
          We don't just design logos—we craft complete brand ecosystems. From initial concept to 
          final execution, we develop strategic visual identities that capture attention, build 
          trust, and create lasting impressions. Every color, typeface, and design element is 
          chosen with purpose to reflect your brand's personality and values.
        </p>
      </div>

      <div class="design-showcase-image" data-aos="zoom-in" data-aos-delay="200">
        <img src="<?php echo asset('service.jpg'); ?>" alt="Brand design showcase">
        <div class="showcase-overlay">
          <div class="overlay-stats">
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="400">
              <span class="stat-number">200+</span>
              <span class="stat-label">Brands Created</span>
            </div>
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="500">
              <span class="stat-number">15+</span>
              <span class="stat-label">Awards Won</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- BRANDING PROCESS -->
    <section id="process" class="process-detailed-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Our Brand Design Process</h2>
      </div>

      <div class="process-detailed-grid">
        <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="100">
          <div class="process-step-number">
            <div class="step-circle">
              <i class="fas fa-compass"></i>
            </div>
          </div>
          <h3>1. Discovery & Strategy</h3>
          <p>We dive deep into your brand's mission, values, target audience, and competitive landscape.</p>
          <ul class="process-features">
            <li><i class="fas fa-check"></i> Brand workshops & interviews</li>
            <li><i class="fas fa-check"></i> Market research & analysis</li>
            <li><i class="fas fa-check"></i> Brand positioning strategy</li>
          </ul>
        </div>

        <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="200">
          <div class="process-step-number">
            <div class="step-circle">
              <i class="fas fa-palette"></i>
            </div>
          </div>
          <h3>2. Concept Development</h3>
          <p>We explore multiple creative directions and present concepts that align with your vision.</p>
          <ul class="process-features">
            <li><i class="fas fa-check"></i> Logo explorations (3-5 concepts)</li>
            <li><i class="fas fa-check"></i> Color palette development</li>
            <li><i class="fas fa-check"></i> Typography selection</li>
          </ul>
        </div>

        <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="300">
          <div class="process-step-number">
            <div class="step-circle">
              <i class="fas fa-star"></i>
            </div>
          </div>
          <h3>3. Refinement & Delivery</h3>
          <p>We polish your chosen direction and deliver a complete brand identity system.</p>
          <ul class="process-features">
            <li><i class="fas fa-check"></i> Final logo refinements</li>
            <li><i class="fas fa-check"></i> Brand style guide creation</li>
            <li><i class="fas fa-check"></i> Asset package delivery</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- WHAT WE DELIVER SECTION -->
    <section class="deliverables-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">What You'll Receive</h2>
        <p class="section-subtitle">Comprehensive brand assets ready for immediate use</p>
      </div>

      <div class="deliverables-grid">
        <div class="deliverable-card" data-aos="fade-up" data-aos-delay="100">
          <div class="deliverable-icon">
            <i class="fas fa-bookmark"></i>
          </div>
          <h3>Logo Package</h3>
          <ul>
            <li>Primary logo (full color)</li>
            <li>Secondary logo variations</li>
            <li>Monochrome versions</li>
            <li>Favicon & social media icons</li>
            <li>All file formats (AI, EPS, PNG, SVG, PDF)</li>
          </ul>
        </div>

        <div class="deliverable-card" data-aos="fade-up" data-aos-delay="200">
          <div class="deliverable-icon">
            <i class="fas fa-book"></i>
          </div>
          <h3>Brand Style Guide</h3>
          <ul>
            <li>Logo usage guidelines</li>
            <li>Color palette with codes</li>
            <li>Typography system</li>
            <li>Spacing & layout rules</li>
            <li>Do's and don'ts</li>
          </ul>
        </div>

        <div class="deliverable-card" data-aos="fade-up" data-aos-delay="300">
          <div class="deliverable-icon">
            <i class="fas fa-images"></i>
          </div>
          <h3>Marketing Materials</h3>
          <ul>
            <li>Business card designs</li>
            <li>Letterhead templates</li>
            <li>Email signature design</li>
            <li>Social media templates</li>
            <li>Presentation deck template</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- BRAND DESIGN SERVICES -->
    <section class="superpowers-section">
      <div class="superpowers-container">
        <div class="superpowers-image" data-aos="fade-right">
          <img src="<?php echo asset('hero.png'); ?>" alt="Brand design services">
        </div>

        <div class="superpowers-content" data-aos="fade-left">
          <h2 class="section-title-modern">Our Branding Services</h2>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-flag"></i>
              Logo Design & Identity
            </h3>
            <p>
              Distinctive logos and visual marks that become the face of your brand. We create 
              memorable symbols that work across all applications and stand the test of time.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-swatchbook"></i>
              Brand Identity Systems
            </h3>
            <p>
              Complete visual languages including color palettes, typography, patterns, and 
              graphic elements that ensure consistency across every brand touchpoint.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-bullhorn"></i>
              Marketing Collateral
            </h3>
            <p>
              Print and digital marketing materials that amplify your brand message—from brochures 
              and packaging to social media graphics and advertising campaigns.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-sync-alt"></i>
              Brand Refresh & Redesign
            </h3>
            <p>
              Modernize outdated brands while preserving equity and recognition. We evolve your 
              visual identity to stay relevant without losing what makes you unique.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- DESIGN SPECIALTIES -->
    <section class="tech-stack-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Design Specialties</h2>
        <p class="section-subtitle">Areas where we excel in creating exceptional brand experiences</p>
      </div>

      <div class="specialties-grid">
        <div class="specialty-card" data-aos="fade-up" data-aos-delay="100">
          <div class="specialty-icon">
            <i class="fas fa-building"></i>
          </div>
          <h3>Corporate Branding</h3>
          <p>Professional identities for B2B companies, startups, and enterprises that command authority and trust.</p>
        </div>

        <div class="specialty-card" data-aos="fade-up" data-aos-delay="200">
          <div class="specialty-icon">
            <i class="fas fa-store"></i>
          </div>
          <h3>Retail & E-Commerce</h3>
          <p>Appealing brands for retail businesses and online stores that attract customers and drive sales.</p>
        </div>

        <div class="specialty-card" data-aos="fade-up" data-aos-delay="300">
          <div class="specialty-icon">
            <i class="fas fa-utensils"></i>
          </div>
          <h3>Food & Beverage</h3>
          <p>Appetizing brands for restaurants, cafes, and food products that make mouths water and create cravings.</p>
        </div>

        <div class="specialty-card" data-aos="fade-up" data-aos-delay="400">
          <div class="specialty-icon">
            <i class="fas fa-heartbeat"></i>
          </div>
          <h3>Health & Wellness</h3>
          <p>Trustworthy brands for healthcare, fitness, and wellness that communicate care and expertise.</p>
        </div>

        <div class="specialty-card" data-aos="fade-up" data-aos-delay="500">
          <div class="specialty-icon">
            <i class="fas fa-rocket"></i>
          </div>
          <h3>Tech & Innovation</h3>
          <p>Forward-thinking brands for technology companies and apps that showcase innovation and creativity.</p>
        </div>

        <div class="specialty-card" data-aos="fade-up" data-aos-delay="600">
          <div class="specialty-icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h3>Education & Non-Profit</h3>
          <p>Inspiring brands for educational institutions and causes that drive engagement and support.</p>
        </div>
      </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Common Branding Questions</h2>
      </div>

      <div class="faq-container">
        <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
          <button class="faq-question">
            <span>What's included in a complete brand identity package?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Our complete package includes: primary and secondary logo designs, color palette, typography system, brand style guide, business card design, letterhead, email signature, social media templates, and all source files in multiple formats. You'll have everything needed to maintain consistent branding.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
          <button class="faq-question">
            <span>How long does the branding process take?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>A typical brand identity project takes 4-6 weeks from kickoff to final delivery. This includes discovery (1 week), concept development (2 weeks), refinement (1-2 weeks), and final production (1 week). Rush timelines are available for an additional fee.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
          <button class="faq-question">
            <span>How many logo concepts will I see?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>We present 3-5 distinct logo concepts in the initial round, each exploring different creative directions. After you select your preferred concept, we refine it through 2-3 revision rounds until it's perfect. This focused approach ensures quality over quantity.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
          <button class="faq-question">
            <span>Do you help with trademark registration?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>While we don't handle legal registration directly, we provide preliminary trademark searches and can recommend intellectual property attorneys. We design with trademark considerations in mind to maximize your chances of successful registration.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
          <button class="faq-question">
            <span>Can you refresh my existing brand instead of starting from scratch?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Absolutely! Brand refreshes are perfect when you have existing equity but need modernization. We'll evaluate your current brand, identify what works, and evolve the elements that need updating while maintaining brand recognition and loyalty.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- BRAND SHOWCASE -->
    <section class="project-showcase-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Recent Branding Projects</h2>
        <p class="section-subtitle">Brands we've helped bring to life</p>
      </div>

      <div class="project-showcase-grid">
        <div class="project-showcase-card" data-aos="zoom-in" data-aos-delay="100">
          <div class="project-image">
            <img src="<?php echo asset('hero.png'); ?>" alt="Tech Startup Brand">
            <div class="project-overlay">
              <a href="#" class="btn btn-white-sm">View Case Study</a>
            </div>
          </div>
          <div class="project-info">
            <span class="project-category">Tech Startup</span>
            <h3>Quantum Labs Identity</h3>
            <p>Complete rebrand for AI research company</p>
          </div>
        </div>

        <div class="project-showcase-card" data-aos="zoom-in" data-aos-delay="200">
          <div class="project-image">
            <img src="<?php echo asset('about-2.png'); ?>" alt="Restaurant Brand">
            <div class="project-overlay">
              <a href="#" class="btn btn-white-sm">View Case Study</a>
            </div>
          </div>
          <div class="project-info">
            <span class="project-category">Food & Beverage</span>
            <h3>Urban Bistro Concept</h3>
            <p>Fresh identity for farm-to-table restaurant</p>
          </div>
        </div>

        <div class="project-showcase-card" data-aos="zoom-in" data-aos-delay="300">
          <div class="project-image">
            <img src="<?php echo asset('service.jpg'); ?>" alt="Wellness Brand">
            <div class="project-overlay">
              <a href="#" class="btn btn-white-sm">View Case Study</a>
            </div>
          </div>
          <div class="project-info">
            <span class="project-category">Health & Wellness</span>
            <h3>Zenith Fitness Studio</h3>
            <p>Modern brand for boutique gym chain</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-service-page" data-aos="fade-up">
      <div class="cta-content">
        <div class="cta-avatar-circle">
          <img src="<?php echo asset('hero.png'); ?>" alt="Creative Director">
        </div>
        <h2>Ready to Build Your Brand?</h2>
        <p>Let's create a visual identity that sets you apart from the competition.</p>
        <a href="<?php echo baseUrl(); ?>#contact" class="btn btn-primary-modern btn-lg">
          Start Your Brand Journey <i class="fas fa-arrow-right"></i>
        </a>
        
        <div class="cta-footer-info">
          <p>Have Questions?</p>
          <a href="mailto:<?php echo e($contactEmail); ?>" class="cta-email-link">
            <?php echo e($contactEmail); ?>
          </a>
        </div>
      </div>
    </section>

    <script>
      // FAQ Accordion functionality
      document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
          const question = item.querySelector('.faq-question');
          const answer = item.querySelector('.faq-answer');
          const icon = question.querySelector('i');
          
          question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all items
            faqItems.forEach(i => {
              i.classList.remove('active');
              i.querySelector('.faq-answer').style.maxHeight = null;
              i.querySelector('.faq-question i').classList.remove('fa-minus');
              i.querySelector('.faq-question i').classList.add('fa-plus');
            });
            
            // Open clicked item if it wasn't active
            if (!isActive) {
              item.classList.add('active');
              answer.style.maxHeight = answer.scrollHeight + 'px';
              icon.classList.remove('fa-plus');
              icon.classList.add('fa-minus');
            }
          });
        });
      });
    </script>

<?php include 'includes/site-footer.php'; ?>