<?php
// services/web-design.php - Web Design & Development Service Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Web Design & Development';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- SERVICE HERO SECTION -->
    <section class="service-hero-section">
      <div class="service-hero-content" data-aos="fade-up">
        <h1 class="service-hero-title">Web Design & Development</h1>
        <p class="service-hero-description">
          We craft user experiences that drive action. We put optimization, whether 
          it's a conversion-focused post-checkout or a mobile app that users 
          genuinely love — from aesthetic polish to flawless functionality and 
          perfect execution.
        </p>
        <a href="#process" class="btn btn-primary-modern btn-lg">
          See How We Work <i class="fas fa-arrow-down"></i>
        </a>
      </div>

      <div class="service-hero-image" data-aos="fade-left" data-aos-delay="200">
        <img src="<?php echo asset('hero.png'); ?>" alt="Web Design Process">
        <div class="hero-badge-floating">
          <span class="badge-icon">✓</span>
          <span class="badge-text">Pixel Perfect</span>
        </div>
      </div>
    </section>

    <!-- DESIGN THAT WORKS SECTION -->
    <section class="design-works-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Design That Works as Hard as You Do</h2>
        <p class="section-subtitle-large">
          We craft user-centric experiences that blend aesthetics with functionality, turning complex 
          workflows into intuitive experiences. Through prototyping, prototyping, and usability testing, we 
          design digital products that reduce friction, boost engagement, and drive conversions—whether 
          it's a bold dashboards, mobile app, or a commerce platform.
        </p>
      </div>

      <div class="design-showcase-image" data-aos="zoom-in" data-aos-delay="200">
        <img src="<?php echo asset('about-2.png'); ?>" alt="Designer at work">
        <div class="showcase-overlay">
          <div class="overlay-stats">
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="400">
              <span class="stat-number">150+</span>
              <span class="stat-label">Projects Delivered</span>
            </div>
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="500">
              <span class="stat-number">98%</span>
              <span class="stat-label">Client Satisfaction</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- UI/UX DESIGN PROCESS -->
    <section id="process" class="process-detailed-section">
      <div class="process-detailed-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Our UI/UX Design Process</h2>
        </div>
  
        <div class="process-detailed-grid">
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="100">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-search"></i>
              </div>
            </div>
            <h3>1. Research & Define</h3>
            <p>We start by knowing your business — its ambitions & challenges.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> User research & personas</li>
              <li><i class="fas fa-check"></i> Competitor analysis</li>
              <li><i class="fas fa-check"></i> Goals & KPIs definition</li>
            </ul>
          </div>
  
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="200">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-lightbulb"></i>
              </div>
            </div>
            <h3>2. Ideate & Prototype</h3>
            <p>Transforming insights into tangible designs — Accelerate your growth.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Wireframing & flow mapping</li>
              <li><i class="fas fa-check"></i> Interactive prototypes</li>
              <li><i class="fas fa-check"></i> Design system creation</li>
            </ul>
          </div>
  
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="300">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
            <h3>3. Refine & Validate</h3>
            <p>Perfecting every pixel with real user feedback & user reviews.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Usability testing</li>
              <li><i class="fas fa-check"></i> A/B testing & optimization</li>
              <li><i class="fas fa-check"></i> Final polish & delivery</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- UI/UX DESIGN SUPERPOWERS -->
    <section class="superpowers-section">
      <div class="superpowers-container">
        <div class="superpowers-image" data-aos="fade-right">
          <img src="<?php echo asset('service.jpg'); ?>" alt="Designer at work">
        </div>

        <div class="superpowers-content" data-aos="fade-left">
          <h2 class="section-title-modern">Our UI/UX Design Superpowers</h2>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-brain"></i>
              Psychology-Driven Design
            </h3>
            <p>
              We apply proven principles and behavioral science to create designs that guide 
              users intuitively through their journey and drive better outcomes.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-users"></i>
              Real-User Testing
            </h3>
            <p>
              We validate every prototype with 5-10 real users from target audience, 
              uncovering actionable insights before a single line of code is written.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-code"></i>
              Dev-Ready Handoffs
            </h3>
            <p>
              Developers receive clean, pixel-perfect Figma files complete with auto-generated 
              specs, assets, and documentation.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- TECH STACK SECTION -->
    <section class="tech-stack-section">
      <div class="tech-stack-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Technologies We Master</h2>
          <p class="section-subtitle">Modern tools and frameworks for cutting-edge web solutions</p>
        </div>
  
        <div class="tech-stack-grid">
          <div class="tech-category" data-aos="fade-up" data-aos-delay="100">
            <h3><i class="fas fa-paint-brush"></i> Design Tools</h3>
            <div class="tech-badges">
              <span class="tech-badge">Figma</span>
              <span class="tech-badge">Adobe XD</span>
              <span class="tech-badge">Sketch</span>
              <span class="tech-badge">InVision</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="200">
            <h3><i class="fas fa-code"></i> Frontend</h3>
            <div class="tech-badges">
              <span class="tech-badge">React</span>
              <span class="tech-badge">Vue.js</span>
              <span class="tech-badge">Next.js</span>
              <span class="tech-badge">TypeScript</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="300">
            <h3><i class="fas fa-server"></i> Backend</h3>
            <div class="tech-badges">
              <span class="tech-badge">Node.js</span>
              <span class="tech-badge">PHP</span>
              <span class="tech-badge">Python</span>
              <span class="tech-badge">Laravel</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="400">
            <h3><i class="fas fa-database"></i> Database</h3>
            <div class="tech-badges">
              <span class="tech-badge">PostgreSQL</span>
              <span class="tech-badge">MongoDB</span>
              <span class="tech-badge">MySQL</span>
              <span class="tech-badge">Supabase</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Your Guide to Common Questions & Solutions</h2>
      </div>

      <div class="faq-container">
        <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
          <button class="faq-question">
            <span>How many revisions are included?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>We include unlimited revisions during the design phase to ensure you're completely satisfied. Once development begins, we include 2 rounds of revisions. Additional changes can be accommodated based on scope.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
          <button class="faq-question">
            <span>What are your charges?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Our pricing is project-based and varies depending on complexity, features, and timeline. A typical website starts at $5,000, while complex web applications start at $15,000. We provide detailed quotes after understanding your requirements.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
          <button class="faq-question">
            <span>What is your MVP process?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>We follow a lean approach: 1) Define core features, 2) Create rapid prototypes, 3) Build MVP in 4-8 weeks, 4) Launch and gather user feedback, 5) Iterate based on real data. This gets your product to market quickly while minimizing risk.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
          <button class="faq-question">
            <span>Do you provide ongoing support?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Yes! We offer maintenance packages starting at $500/month including hosting, updates, security patches, and technical support. We're here to ensure your website continues to perform optimally.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
          <button class="faq-question">
            <span>How long does a typical project take?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Timeline varies by scope: Simple websites (4-6 weeks), Complex websites (8-12 weeks), Web applications (12-16 weeks). We provide a detailed timeline during project kickoff and keep you updated throughout.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- PROJECT SHOWCASE -->
    <section class="project-showcase-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Recent Web Design Projects</h2>
        <p class="section-subtitle">See how we've helped businesses transform their digital presence</p>
      </div>

      <div class="project-showcase-grid">
        <div class="project-showcase-card" data-aos="zoom-in" data-aos-delay="100">
          <div class="project-image">
            <img src="<?php echo asset('hero.png'); ?>" alt="Project 1">
            <div class="project-overlay">
              <a href="#" class="btn btn-white-sm">View Case Study</a>
            </div>
          </div>
          <div class="project-info">
            <span class="project-category">E-Commerce</span>
            <h3>Fashion Retail Platform</h3>
            <p>Complete redesign increased conversion by 156%</p>
          </div>
        </div>

        <div class="project-showcase-card" data-aos="zoom-in" data-aos-delay="200">
          <div class="project-image">
            <img src="<?php echo asset('about-2.png'); ?>" alt="Project 2">
            <div class="project-overlay">
              <a href="#" class="btn btn-white-sm">View Case Study</a>
            </div>
          </div>
          <div class="project-info">
            <span class="project-category">SaaS Dashboard</span>
            <h3>Analytics Platform</h3>
            <p>User engagement up 89% after UX overhaul</p>
          </div>
        </div>

        <div class="project-showcase-card" data-aos="zoom-in" data-aos-delay="300">
          <div class="project-image">
            <img src="<?php echo asset('service.jpg'); ?>" alt="Project 3">
            <div class="project-overlay">
              <a href="#" class="btn btn-white-sm">View Case Study</a>
            </div>
          </div>
          <div class="project-info">
            <span class="project-category">Corporate Website</span>
            <h3>Tech Company Rebrand</h3>
            <p>Modern design boosted lead generation by 230%</p>
          </div>
        </div>
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
        <button class="btn btn-primary-modern btn-lg" onclick="window.location.href='contact.php'">
          Get Started Today <i class="fas fa-arrow-right"></i>
        </button>
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