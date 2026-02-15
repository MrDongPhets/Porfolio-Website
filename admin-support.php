<?php
// services/admin-support.php - Administrative & Executive Support Service Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Administrative & Executive Support';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- SERVICE HERO SECTION -->
    <section class="service-hero-section">
      <div class="service-hero-content" data-aos="fade-up">
        <h1 class="service-hero-title">Administrative & Executive Support</h1>
        <p class="service-hero-description">
          Virtual assistance, operational coordination, documentation, CRM management, and 
          workflow optimization. We handle the behind-the-scenes work so you can focus on 
          what matters most—growing your business and serving your clients.
        </p>
        <a href="#process" class="btn btn-primary-modern btn-lg">
          See How We Help <i class="fas fa-arrow-down"></i>
        </a>
      </div>

      <div class="service-hero-image" data-aos="fade-left" data-aos-delay="200">
        <img src="<?php echo asset('about-2.png'); ?>" alt="Administrative Support">
        <div class="hero-badge-floating">
          <span class="badge-icon">⚡</span>
          <span class="badge-text">24/7 Support</span>
        </div>
      </div>
    </section>

    <!-- SUPPORT EXCELLENCE SECTION -->
    <section class="design-works-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Your Extended Team, On-Demand</h2>
        <p class="section-subtitle-large">
          Running a business means wearing multiple hats—but you don't have to wear them all 
          at once. Our virtual administrative professionals become seamless extensions of your 
          team, handling everything from inbox management to complex operational workflows. 
          With our support, you reclaim 15-20 hours per week to focus on strategic growth, 
          client relationships, and the work only you can do.
        </p>
      </div>

      <div class="design-showcase-image" data-aos="zoom-in" data-aos-delay="200">
        <img src="<?php echo asset('service.jpg'); ?>" alt="Virtual assistant working">
        <div class="showcase-overlay">
          <div class="overlay-stats">
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="400">
              <span class="stat-number">15-20hrs</span>
              <span class="stat-label">Time Saved Weekly</span>
            </div>
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="500">
              <span class="stat-number">500+</span>
              <span class="stat-label">Businesses Supported</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SUPPORT PROCESS -->
    <section id="process" class="process-detailed-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">How We Work With You</h2>
      </div>

      <div class="process-detailed-grid">
        <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="100">
          <div class="process-step-number">
            <div class="step-circle">
              <i class="fas fa-handshake"></i>
            </div>
          </div>
          <h3>1. Onboarding & Setup</h3>
          <p>We learn your business, processes, tools, and communication preferences.</p>
          <ul class="process-features">
            <li><i class="fas fa-check"></i> Comprehensive needs assessment</li>
            <li><i class="fas fa-check"></i> Tool & system access setup</li>
            <li><i class="fas fa-check"></i> Workflow documentation</li>
          </ul>
        </div>

        <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="200">
          <div class="process-step-number">
            <div class="step-circle">
              <i class="fas fa-tasks"></i>
            </div>
          </div>
          <h3>2. Daily Operations</h3>
          <p>We execute tasks seamlessly, keeping you informed with regular updates.</p>
          <ul class="process-features">
            <li><i class="fas fa-check"></i> Task execution & management</li>
            <li><i class="fas fa-check"></i> Proactive problem-solving</li>
            <li><i class="fas fa-check"></i> Clear communication protocols</li>
          </ul>
        </div>

        <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="300">
          <div class="process-step-number">
            <div class="step-circle">
              <i class="fas fa-chart-line"></i>
            </div>
          </div>
          <h3>3. Optimize & Scale</h3>
          <p>We continuously improve processes and adapt as your business grows.</p>
          <ul class="process-features">
            <li><i class="fas fa-check"></i> Process improvement suggestions</li>
            <li><i class="fas fa-check"></i> Weekly/monthly reporting</li>
            <li><i class="fas fa-check"></i> Scalable support levels</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- ADMIN SERVICES -->
    <section class="content-services-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Services We Provide</h2>
        <p class="section-subtitle">Comprehensive administrative support for modern businesses</p>
      </div>

      <div class="admin-services-grid">
        <div class="admin-service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="admin-service-icon">
            <i class="fas fa-envelope-open-text"></i>
          </div>
          <h3>Email & Calendar Management</h3>
          <p>Keep your inbox under control and your schedule optimized for productivity.</p>
          <ul class="admin-service-list">
            <li>Inbox triage & prioritization</li>
            <li>Email drafting & responses</li>
            <li>Calendar scheduling & coordination</li>
            <li>Meeting preparation & follow-ups</li>
            <li>Appointment reminders</li>
          </ul>
        </div>

        <div class="admin-service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="admin-service-icon">
            <i class="fas fa-user-friends"></i>
          </div>
          <h3>Customer Relationship Management</h3>
          <p>Maintain strong client relationships with organized, responsive communication.</p>
          <ul class="admin-service-list">
            <li>CRM data entry & updates</li>
            <li>Client communication management</li>
            <li>Follow-up automation</li>
            <li>Lead tracking & nurturing</li>
            <li>Customer support coordination</li>
          </ul>
        </div>

        <div class="admin-service-card" data-aos="fade-up" data-aos-delay="300">
          <div class="admin-service-icon">
            <i class="fas fa-file-invoice"></i>
          </div>
          <h3>Documentation & Data Entry</h3>
          <p>Accurate, organized records that keep your business running smoothly.</p>
          <ul class="admin-service-list">
            <li>Document creation & formatting</li>
            <li>Data entry & management</li>
            <li>Spreadsheet management</li>
            <li>Report compilation</li>
            <li>File organization & archiving</li>
          </ul>
        </div>

        <div class="admin-service-card" data-aos="fade-up" data-aos-delay="400">
          <div class="admin-service-icon">
            <i class="fas fa-plane"></i>
          </div>
          <h3>Travel & Event Coordination</h3>
          <p>Seamless planning for business travel, meetings, and corporate events.</p>
          <ul class="admin-service-list">
            <li>Travel booking & itineraries</li>
            <li>Accommodation arrangements</li>
            <li>Event planning & logistics</li>
            <li>Vendor coordination</li>
            <li>Expense tracking & reporting</li>
          </ul>
        </div>

        <div class="admin-service-card" data-aos="fade-up" data-aos-delay="500">
          <div class="admin-service-icon">
            <i class="fas fa-search-dollar"></i>
          </div>
          <h3>Research & Analysis</h3>
          <p>Actionable insights and information to support strategic decision-making.</p>
          <ul class="admin-service-list">
            <li>Market research</li>
            <li>Competitor analysis</li>
            <li>Data compilation & reporting</li>
            <li>Vendor/supplier research</li>
            <li>Presentation preparation</li>
          </ul>
        </div>

        <div class="admin-service-card" data-aos="fade-up" data-aos-delay="600">
          <div class="admin-service-icon">
            <i class="fas fa-cogs"></i>
          </div>
          <h3>Process & Workflow Optimization</h3>
          <p>Streamline operations with efficient systems and automated workflows.</p>
          <ul class="admin-service-list">
            <li>Standard operating procedures</li>
            <li>Workflow automation setup</li>
            <li>Tool integration & management</li>
            <li>Process documentation</li>
            <li>Efficiency recommendations</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- SUPPORT PACKAGES -->
    <section class="content-packages-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Support Packages</h2>
        <p class="section-subtitle">Flexible support levels to match your needs</p>
      </div>

      <div class="packages-grid">
        <div class="package-card" data-aos="fade-up" data-aos-delay="100">
          <div class="package-header">
            <h3>Essential</h3>
            <div class="package-price">
              <span class="price">$800</span>
              <span class="period">/month</span>
            </div>
            <p class="package-hours">20 hours/month</p>
          </div>
          <ul class="package-features">
            <li><i class="fas fa-check"></i> Email & calendar management</li>
            <li><i class="fas fa-check"></i> Basic data entry</li>
            <li><i class="fas fa-check"></i> Meeting scheduling</li>
            <li><i class="fas fa-check"></i> Document formatting</li>
            <li><i class="fas fa-check"></i> Response within 24 hours</li>
            <li><i class="fas fa-check"></i> Weekly status updates</li>
          </ul>
          <a href="<?php echo baseUrl(); ?>#contact" class="btn btn-outline-modern btn-block">
            Get Started
          </a>
        </div>

        <div class="package-card featured" data-aos="fade-up" data-aos-delay="200">
          <div class="popular-badge">Most Popular</div>
          <div class="package-header">
            <h3>Professional</h3>
            <div class="package-price">
              <span class="price">$1,500</span>
              <span class="period">/month</span>
            </div>
            <p class="package-hours">40 hours/month</p>
          </div>
          <ul class="package-features">
            <li><i class="fas fa-check"></i> All Essential features</li>
            <li><i class="fas fa-check"></i> CRM management</li>
            <li><i class="fas fa-check"></i> Client communication</li>
            <li><i class="fas fa-check"></i> Travel coordination</li>
            <li><i class="fas fa-check"></i> Research & reporting</li>
            <li><i class="fas fa-check"></i> Process documentation</li>
            <li><i class="fas fa-check"></i> Response within 4 hours</li>
            <li><i class="fas fa-check"></i> Daily status updates</li>
          </ul>
          <a href="<?php echo baseUrl(); ?>#contact" class="btn btn-primary-modern btn-block">
            Get Started
          </a>
        </div>

        <div class="package-card" data-aos="fade-up" data-aos-delay="300">
          <div class="package-header">
            <h3>Executive</h3>
            <div class="package-price">
              <span class="price">$2,800</span>
              <span class="period">/month</span>
            </div>
            <p class="package-hours">80 hours/month</p>
          </div>
          <ul class="package-features">
            <li><i class="fas fa-check"></i> All Professional features</li>
            <li><i class="fas fa-check"></i> Dedicated assistant</li>
            <li><i class="fas fa-check"></i> Project management</li>
            <li><i class="fas fa-check"></i> Team coordination</li>
            <li><i class="fas fa-check"></i> Event planning & execution</li>
            <li><i class="fas fa-check"></i> Workflow optimization</li>
            <li><i class="fas fa-check"></i> Priority response (1 hour)</li>
            <li><i class="fas fa-check"></i> Weekly strategy calls</li>
          </ul>
          <a href="<?php echo baseUrl(); ?>#contact" class="btn btn-outline-modern btn-block">
            Get Started
          </a>
        </div>
      </div>

      <div class="packages-note" data-aos="fade-up">
        <p><i class="fas fa-info-circle"></i> All packages include rollover of unused hours (up to 25%), no setup fees, and flexible month-to-month contracts. Custom hourly rates available.</p>
      </div>
    </section>

    <!-- TOOLS & SYSTEMS -->
    <section class="superpowers-section">
      <div class="superpowers-container">
        <div class="superpowers-image" data-aos="fade-right">
          <img src="<?php echo asset('hero.png'); ?>" alt="Virtual assistant tools">
          <div class="tools-badge">
            <i class="fas fa-tools"></i>
            <span>Expert in 50+ Tools</span>
          </div>
        </div>

        <div class="superpowers-content" data-aos="fade-left">
          <h2 class="section-title-modern">Why Choose Our Support Team</h2>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-graduation-cap"></i>
              Highly Trained Professionals
            </h3>
            <p>
              Our team consists of experienced administrative professionals with backgrounds in 
              corporate management, executive assistance, and operations. Each assistant undergoes 
              rigorous training in our processes and best practices.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-shield-alt"></i>
              Security & Confidentiality
            </h3>
            <p>
              We take data security seriously. All team members sign NDAs, undergo background 
              checks, and are trained in confidentiality protocols. We use secure systems and 
              encrypted communication for all sensitive information.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-sync-alt"></i>
              Seamless Integration
            </h3>
            <p>
              We adapt to your existing tools and workflows—no need to change systems. Whether 
              you use Gmail, Outlook, Asana, Monday, or any other platform, we integrate smoothly 
              and get up to speed quickly.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-clock"></i>
              Consistent Availability
            </h3>
            <p>
              With team coverage across time zones, you have support when you need it. No vacation 
              gaps, no sick days—just reliable, consistent assistance that keeps your business running.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- TOOLS WE USE -->
    <section class="tech-stack-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Tools & Platforms We Master</h2>
        <p class="section-subtitle">Expert proficiency in the systems you already use</p>
      </div>

      <div class="tech-stack-grid">
        <div class="tech-category" data-aos="fade-up" data-aos-delay="100">
          <h3><i class="fas fa-envelope"></i> Email & Calendar</h3>
          <div class="tech-badges">
            <span class="tech-badge">Gmail</span>
            <span class="tech-badge">Outlook</span>
            <span class="tech-badge">Apple Mail</span>
            <span class="tech-badge">Calendly</span>
          </div>
        </div>

        <div class="tech-category" data-aos="fade-up" data-aos-delay="200">
          <h3><i class="fas fa-tasks"></i> Project Management</h3>
          <div class="tech-badges">
            <span class="tech-badge">Asana</span>
            <span class="tech-badge">Monday.com</span>
            <span class="tech-badge">Trello</span>
            <span class="tech-badge">ClickUp</span>
          </div>
        </div>

        <div class="tech-category" data-aos="fade-up" data-aos-delay="300">
          <h3><i class="fas fa-database"></i> CRM Systems</h3>
          <div class="tech-badges">
            <span class="tech-badge">Salesforce</span>
            <span class="tech-badge">HubSpot</span>
            <span class="tech-badge">Pipedrive</span>
            <span class="tech-badge">Zoho CRM</span>
          </div>
        </div>

        <div class="tech-category" data-aos="fade-up" data-aos-delay="400">
          <h3><i class="fas fa-file-alt"></i> Documentation</h3>
          <div class="tech-badges">
            <span class="tech-badge">Google Workspace</span>
            <span class="tech-badge">Microsoft Office</span>
            <span class="tech-badge">Notion</span>
            <span class="tech-badge">Airtable</span>
          </div>
        </div>

        <div class="tech-category" data-aos="fade-up" data-aos-delay="500">
          <h3><i class="fas fa-comments"></i> Communication</h3>
          <div class="tech-badges">
            <span class="tech-badge">Slack</span>
            <span class="tech-badge">Microsoft Teams</span>
            <span class="tech-badge">Zoom</span>
            <span class="tech-badge">WhatsApp Business</span>
          </div>
        </div>

        <div class="tech-category" data-aos="fade-up" data-aos-delay="600">
          <h3><i class="fas fa-robot"></i> Automation</h3>
          <div class="tech-badges">
            <span class="tech-badge">Zapier</span>
            <span class="tech-badge">Make</span>
            <span class="tech-badge">IFTTT</span>
            <span class="tech-badge">Automate.io</span>
          </div>
        </div>
      </div>
    </section>

    <!-- USE CASES -->
    <section class="use-cases-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Who We Help</h2>
        <p class="section-subtitle">Administrative support tailored to different business types</p>
      </div>

      <div class="use-cases-grid">
        <div class="use-case-card" data-aos="fade-up" data-aos-delay="100">
          <div class="use-case-icon">
            <i class="fas fa-user-tie"></i>
          </div>
          <h3>Entrepreneurs & Founders</h3>
          <p>Focus on strategy and growth while we handle daily operations, inbox management, and administrative tasks that drain your time.</p>
          <div class="use-case-tags">
            <span>Calendar Management</span>
            <span>Email Handling</span>
            <span>Travel Booking</span>
          </div>
        </div>

        <div class="use-case-card" data-aos="fade-up" data-aos-delay="200">
          <div class="use-case-icon">
            <i class="fas fa-briefcase"></i>
          </div>
          <h3>Small Business Owners</h3>
          <p>Scale without overhead. Get executive-level support without the cost of a full-time employee, with flexibility to adjust as you grow.</p>
          <div class="use-case-tags">
            <span>CRM Management</span>
            <span>Client Relations</span>
            <span>Documentation</span>
          </div>
        </div>

        <div class="use-case-card" data-aos="fade-up" data-aos-delay="300">
          <div class="use-case-icon">
            <i class="fas fa-users-cog"></i>
          </div>
          <h3>Remote Teams</h3>
          <p>Coordinate distributed teams with centralized administrative support, project coordination, and workflow management across time zones.</p>
          <div class="use-case-tags">
            <span>Team Coordination</span>
            <span>Project Tracking</span>
            <span>Meeting Scheduling</span>
          </div>
        </div>

        <div class="use-case-card" data-aos="fade-up" data-aos-delay="400">
          <div class="use-case-icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <h3>Consultants & Agencies</h3>
          <p>Maximize billable hours by offloading client onboarding, proposal creation, scheduling, and administrative overhead to our team.</p>
          <div class="use-case-tags">
            <span>Client Onboarding</span>
            <span>Proposal Writing</span>
            <span>Reporting</span>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Frequently Asked Questions</h2>
      </div>

      <div class="faq-container">
        <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
          <button class="faq-question">
            <span>How quickly can we get started?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Most clients are up and running within 3-5 business days. After you sign up, we schedule an onboarding call to understand your needs, set up access to your tools, and assign your dedicated assistant. For urgent needs, we offer expedited onboarding (24-48 hours) at no extra charge.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
          <button class="faq-question">
            <span>What if I don't use all my hours?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Unused hours roll over to the next month (up to 25% of your monthly allocation). For example, if you have 40 hours/month and use only 30, you'll have 50 hours the following month. This ensures you get full value from your investment while maintaining flexibility.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
          <button class="faq-question">
            <span>Will I work with the same person every time?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Yes! Professional and Executive packages include a dedicated assistant who learns your preferences, business, and workflows. Essential packages have primary and backup assistants for coverage. All team members have access to your account notes for seamless continuity.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
          <button class="faq-question">
            <span>How do you ensure data security?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>We implement bank-level security: all assistants sign NDAs and undergo background checks, we use encrypted communication (Signal, encrypted email), secure password managers (1Password, LastPass), 2FA on all accounts, and SOC 2 Type II compliant practices. We never share client information or use it for any purpose outside your business needs.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
          <button class="faq-question">
            <span>Can I upgrade or downgrade my plan?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Absolutely! Our plans are flexible month-to-month. You can upgrade anytime for immediate access to more hours and features. Downgrades take effect at your next billing cycle. Many clients start with Essential and scale up as they realize the value of having more support.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
          <button class="faq-question">
            <span>What happens if my assistant is unavailable?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>You're always covered. Each assistant has a trained backup who has access to your account and standard procedures. For time-sensitive matters, our team lead can step in immediately. We maintain detailed documentation so any team member can assist you seamlessly—no gaps in service, ever.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="testimonials-modern">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Client Success Stories</h2>
        <p class="section-subtitle">How administrative support transformed their businesses</p>
      </div>

      <div class="testimonials-grid">
        <div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-rating">
            <div class="rating-stars">
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
            </div>
            <span class="rating-number">5.0</span>
          </div>
          
          <p class="testimonial-text">"I got 15 hours back per week—no exaggeration. My assistant handles everything from scheduling to client follow-ups. I can finally focus on growing the business instead of drowning in admin work."</p>
          
          <div class="testimonial-author">
            <div class="author-avatar">
              <div class="avatar-placeholder">RJ</div>
            </div>
            <div class="author-info">
              <h4>Rachel Johnson</h4>
              <p>Founder | Marketing Agency</p>
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
            <span class="rating-number">5.0</span>
          </div>
          
          <p class="testimonial-text">"Best business decision I made this year. My VA manages my entire CRM, follows up with leads, and keeps everything organized. Our client retention improved by 40% because nothing falls through the cracks anymore."</p>
          
          <div class="testimonial-author">
            <div class="author-avatar">
              <div class="avatar-placeholder">DT</div>
            </div>
            <div class="author-info">
              <h4>David Thompson</h4>
              <p>Real Estate Broker</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card-modern" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-rating">
            <div class="rating-stars">
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
              <i class="fas fa-star active"></i>
            </div>
            <span class="rating-number">5.0</span>
          </div>
          
          <p class="testimonial-text">"Having executive support without the $80K salary is a game-changer. My assistant coordinates my team, manages projects, and handles travel—all the things that used to eat up my entire day. Worth every penny."</p>
          
          <div class="testimonial-author">
            <div class="author-avatar">
              <div class="avatar-placeholder">SC</div>
            </div>
            <div class="author-info">
              <h4>Sarah Chen</h4>
              <p>CEO | Tech Startup</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-service-page" data-aos="fade-up">
      <div class="cta-content">
        <div class="cta-avatar-circle">
          <img src="<?php echo asset('service.jpg'); ?>" alt="Virtual Assistant">
        </div>
        <h2>Ready to Reclaim Your Time?</h2>
        <p>Let's discuss how our administrative support can help you focus on what matters most.</p>
        <a href="<?php echo baseUrl(); ?>#contact" class="btn btn-primary-modern btn-lg">
          Schedule a Consultation <i class="fas fa-arrow-right"></i>
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