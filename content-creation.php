    <?php
// services/content-creation.php - Content Creation & Media Service Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Content Creation & Media';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- SERVICE HERO SECTION -->
    <section class="service-hero-section">
      <div class="service-hero-content" data-aos="fade-up">
        <h1 class="service-hero-title">Content Creation & Media</h1>
        <p class="service-hero-description">
          Visual content, marketing graphics, multimedia assets, and branded materials for 
          digital engagement. We create thumb-stopping content that captures attention, 
          tells your story, and drives meaningful engagement across every platform and touchpoint.
        </p>
        <a href="#process" class="btn btn-primary-modern btn-lg">
          See What We Create <i class="fas fa-arrow-down"></i>
        </a>
      </div>

      <div class="service-hero-image" data-aos="fade-left" data-aos-delay="200">
        <img src="<?php echo asset('hero.png'); ?>" alt="Content Creation">
        <div class="hero-badge-floating">
          <span class="badge-icon">✨</span>
          <span class="badge-text">Creative Content</span>
        </div>
      </div>
    </section>

    <!-- CONTENT EXCELLENCE SECTION -->
    <section class="design-works-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Content That Captivates & Converts</h2>
        <p class="section-subtitle-large">
          In today's digital landscape, content is king—but quality content is emperor. We don't 
          just create pretty visuals; we craft strategic content that resonates with your audience, 
          amplifies your brand message, and drives real business results. From scroll-stopping social 
          graphics to comprehensive content calendars, we're your complete content creation partner.
        </p>
      </div>

      <div class="design-showcase-image" data-aos="zoom-in" data-aos-delay="200">
        <img src="<?php echo asset('about-2.png'); ?>" alt="Content creation showcase">
        <div class="showcase-overlay">
          <div class="overlay-stats">
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="400">
              <span class="stat-number">10K+</span>
              <span class="stat-label">Assets Created</span>
            </div>
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="500">
              <span class="stat-number">250%</span>
              <span class="stat-label">Avg. Engagement Boost</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT CREATION PROCESS -->
    <section id="process" class="process-detailed-section">
      <div class="process-detailed-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Our Content Creation Process</h2>
        </div>
  
        <div class="process-detailed-grid">
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="100">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-bullseye"></i>
              </div>
            </div>
            <h3>1. Strategy & Planning</h3>
            <p>We start by understanding your audience, brand voice, and content goals.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Content audit & analysis</li>
              <li><i class="fas fa-check"></i> Audience research & personas</li>
              <li><i class="fas fa-check"></i> Content calendar development</li>
            </ul>
          </div>
  
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="200">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-pencil-alt"></i>
              </div>
            </div>
            <h3>2. Creation & Design</h3>
            <p>Our creative team brings concepts to life with stunning visuals and compelling copy.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Visual design & graphics</li>
              <li><i class="fas fa-check"></i> Copywriting & messaging</li>
              <li><i class="fas fa-check"></i> Multi-format adaptation</li>
            </ul>
          </div>
  
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="300">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-chart-line"></i>
              </div>
            </div>
            <h3>3. Optimize & Scale</h3>
            <p>We analyze performance data and continuously refine content for maximum impact.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> A/B testing & optimization</li>
              <li><i class="fas fa-check"></i> Performance analytics</li>
              <li><i class="fas fa-check"></i> Iterative improvements</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT SERVICES -->
    <section class="content-services-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">What We Create</h2>
        <p class="section-subtitle">Comprehensive content solutions for every platform</p>
      </div>

      <div class="content-services-grid">
        <div class="content-service-card" data-aos="fade-up" data-aos-delay="100">
          <div class="content-service-icon">
            <i class="fab fa-instagram"></i>
          </div>
          <h3>Social Media Content</h3>
          <p>Platform-optimized posts, stories, carousels, and graphics that stop the scroll and spark conversations.</p>
          <ul class="content-service-list">
            <li>Instagram posts & Stories</li>
            <li>Facebook graphics & covers</li>
            <li>LinkedIn infographics</li>
            <li>Twitter/X visuals</li>
            <li>TikTok thumbnails</li>
          </ul>
        </div>

        <div class="content-service-card" data-aos="fade-up" data-aos-delay="200">
          <div class="content-service-icon">
            <i class="fas fa-ad"></i>
          </div>
          <h3>Marketing Materials</h3>
          <p>Eye-catching marketing assets designed to convert prospects into loyal customers.</p>
          <ul class="content-service-list">
            <li>Digital ad creatives</li>
            <li>Email marketing templates</li>
            <li>Landing page graphics</li>
            <li>Banner ads & display</li>
            <li>Promotional materials</li>
          </ul>
        </div>

        <div class="content-service-card" data-aos="fade-up" data-aos-delay="300">
          <div class="content-service-icon">
            <i class="fas fa-image"></i>
          </div>
          <h3>Visual Assets</h3>
          <p>Professional photography, illustrations, and custom graphics for all your needs.</p>
          <ul class="content-service-list">
            <li>Product photography edits</li>
            <li>Custom illustrations</li>
            <li>Infographics & data viz</li>
            <li>Icon sets & graphics</li>
            <li>Stock photo curation</li>
          </ul>
        </div>

        <div class="content-service-card" data-aos="fade-up" data-aos-delay="400">
          <div class="content-service-icon">
            <i class="fas fa-file-alt"></i>
          </div>
          <h3>Brand Collateral</h3>
          <p>Professional materials that reinforce your brand identity and credibility.</p>
          <ul class="content-service-list">
            <li>Presentation decks</li>
            <li>One-pagers & flyers</li>
            <li>Brochures & catalogs</li>
            <li>Case studies & whitepapers</li>
            <li>Reports & eBooks</li>
          </ul>
        </div>

        <div class="content-service-card" data-aos="fade-up" data-aos-delay="500">
          <div class="content-service-icon">
            <i class="fas fa-pen-fancy"></i>
          </div>
          <h3>Content Writing</h3>
          <p>Compelling copy that engages, informs, and persuades your target audience.</p>
          <ul class="content-service-list">
            <li>Blog posts & articles</li>
            <li>Social media captions</li>
            <li>Website copy</li>
            <li>Product descriptions</li>
            <li>Email campaigns</li>
          </ul>
        </div>

        <div class="content-service-card" data-aos="fade-up" data-aos-delay="600">
          <div class="content-service-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <h3>Content Strategy</h3>
          <p>Comprehensive planning and management to keep your content consistent and effective.</p>
          <ul class="content-service-list">
            <li>Content calendar planning</li>
            <li>Editorial guidelines</li>
            <li>Trend monitoring & insights</li>
            <li>Competitor analysis</li>
            <li>Performance reporting</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- CONTENT PACKAGES -->
    <section class="content-packages-section">
      <div class="content-packages-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Content Packages</h2>
          <p class="section-subtitle">Choose the plan that fits your needs</p>
        </div>
  
        <div class="packages-grid">
          <div class="package-card" data-aos="fade-up" data-aos-delay="100">
            <div class="package-header">
              <h3>Starter</h3>
              <div class="package-price">
                <span class="price">$500</span>
                <span class="period">/month</span>
              </div>
            </div>
            <ul class="package-features">
              <li><i class="fas fa-check"></i> 12 social media posts</li>
              <li><i class="fas fa-check"></i> 4 Instagram Stories</li>
              <li><i class="fas fa-check"></i> Basic content calendar</li>
              <li><i class="fas fa-check"></i> 2 revisions per asset</li>
              <li><i class="fas fa-check"></i> Stock photos included</li>
            </ul>
            <a href="contact.php" class="btn btn-outline-modern btn-block">
              Get Started
            </a>
          </div>
  
          <div class="package-card featured" data-aos="fade-up" data-aos-delay="200">
            <div class="popular-badge">Most Popular</div>
            <div class="package-header">
              <h3>Professional</h3>
              <div class="package-price">
                <span class="price">$1,200</span>
                <span class="period">/month</span>
              </div>
            </div>
            <ul class="package-features">
              <li><i class="fas fa-check"></i> 24 social media posts</li>
              <li><i class="fas fa-check"></i> 8 Instagram Stories</li>
              <li><i class="fas fa-check"></i> 4 carousel posts</li>
              <li><i class="fas fa-check"></i> 2 blog graphics</li>
              <li><i class="fas fa-check"></i> Content strategy session</li>
              <li><i class="fas fa-check"></i> Caption writing included</li>
              <li><i class="fas fa-check"></i> Unlimited revisions</li>
              <li><i class="fas fa-check"></i> Priority support</li>
            </ul>
            <a href="contact.php" class="btn btn-primary-modern btn-block">
              Get Started
            </a>
          </div>
  
          <div class="package-card" data-aos="fade-up" data-aos-delay="300">
            <div class="package-header">
              <h3>Enterprise</h3>
              <div class="package-price">
                <span class="price">$2,500</span>
                <span class="period">/month</span>
              </div>
            </div>
            <ul class="package-features">
              <li><i class="fas fa-check"></i> 50+ social media posts</li>
              <li><i class="fas fa-check"></i> Unlimited Stories</li>
              <li><i class="fas fa-check"></i> 8 carousel posts</li>
              <li><i class="fas fa-check"></i> 4 blog posts + graphics</li>
              <li><i class="fas fa-check"></i> Video thumbnails</li>
              <li><i class="fas fa-check"></i> Email templates</li>
              <li><i class="fas fa-check"></i> Dedicated account manager</li>
              <li><i class="fas fa-check"></i> Monthly strategy calls</li>
            </ul>
            <a href="contact.php" class="btn btn-outline-modern btn-block">
              Get Started
            </a>
          </div>
        </div>
  
        <div class="packages-note" data-aos="fade-up">
          <p><i class="fas fa-info-circle"></i> All packages include brand guideline adherence, source files, and monthly performance reports. Custom packages available.</p>
        </div>
      </div>
    </section>

    <!-- CONTENT TYPES SHOWCASE -->
    <section class="superpowers-section">
      <div class="superpowers-container">
        <div class="superpowers-image" data-aos="fade-right">
          <img src="<?php echo asset('service.jpg'); ?>" alt="Content creation">
          <div class="content-stats-badge">
            <div class="stat-row">
              <i class="fas fa-heart"></i>
              <span>+340% Engagement</span>
            </div>
            <div class="stat-row">
              <i class="fas fa-share"></i>
              <span>+210% Shares</span>
            </div>
          </div>
        </div>

        <div class="superpowers-content" data-aos="fade-left">
          <h2 class="section-title-modern">Why Our Content Performs</h2>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-brain"></i>
              Data-Driven Creativity
            </h3>
            <p>
              We blend creative excellence with analytics. Every piece of content is informed by 
              performance data, audience insights, and platform best practices to maximize engagement.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-sync"></i>
              Consistent Brand Voice
            </h3>
            <p>
              We maintain your unique brand personality across all content. From tone to visual style, 
              we ensure every asset reinforces your brand identity and builds recognition.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-bolt"></i>
              Platform Optimization
            </h3>
            <p>
              Each platform has its own language and best practices. We tailor content for optimal 
              performance on Instagram, LinkedIn, Facebook, Twitter, TikTok, and more.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-clock"></i>
              Trend-Aware Creation
            </h3>
            <p>
              We stay ahead of social media trends, algorithm changes, and content formats. Your 
              content is always fresh, relevant, and positioned to take advantage of viral opportunities.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT TOOLS -->
    <section class="tech-stack-section">
      <div class="tech-stack-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Tools & Platforms We Use</h2>
          <p class="section-subtitle">Professional software for high-quality content creation</p>
        </div>
  
        <div class="tech-stack-grid">
          <div class="tech-category" data-aos="fade-up" data-aos-delay="100">
            <h3><i class="fas fa-paint-brush"></i> Design Tools</h3>
            <div class="tech-badges">
              <span class="tech-badge">Adobe Photoshop</span>
              <span class="tech-badge">Illustrator</span>
              <span class="tech-badge">Canva Pro</span>
              <span class="tech-badge">Figma</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="200">
            <h3><i class="fas fa-calendar"></i> Planning</h3>
            <div class="tech-badges">
              <span class="tech-badge">Later</span>
              <span class="tech-badge">Buffer</span>
              <span class="tech-badge">Notion</span>
              <span class="tech-badge">Asana</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="300">
            <h3><i class="fas fa-chart-bar"></i> Analytics</h3>
            <div class="tech-badges">
              <span class="tech-badge">Google Analytics</span>
              <span class="tech-badge">Hootsuite</span>
              <span class="tech-badge">Sprout Social</span>
              <span class="tech-badge">Meta Business Suite</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="400">
            <h3><i class="fas fa-images"></i> Resources</h3>
            <div class="tech-badges">
              <span class="tech-badge">Unsplash</span>
              <span class="tech-badge">Pexels</span>
              <span class="tech-badge">Adobe Stock</span>
              <span class="tech-badge">Envato Elements</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT PORTFOLIO -->
    <section class="project-showcase-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Content We've Created</h2>
        <p class="section-subtitle">Real results from real campaigns</p>
      </div>

      <div class="content-portfolio-grid">
        <div class="content-portfolio-item" data-aos="zoom-in" data-aos-delay="100">
          <div class="content-image">
            <img src="<?php echo asset('hero.png'); ?>" alt="Social media campaign">
            <div class="content-overlay">
              <div class="content-stats">
                <span><i class="fas fa-heart"></i> 12.5K</span>
                <span><i class="fas fa-comment"></i> 834</span>
                <span><i class="fas fa-share"></i> 2.1K</span>
              </div>
            </div>
          </div>
          <div class="content-info">
            <span class="content-type">Social Campaign</span>
            <h3>Tech Product Launch</h3>
            <p>Instagram carousel series for new product</p>
          </div>
        </div>

        <div class="content-portfolio-item" data-aos="zoom-in" data-aos-delay="200">
          <div class="content-image">
            <img src="<?php echo asset('about-2.png'); ?>" alt="Infographic">
            <div class="content-overlay">
              <div class="content-stats">
                <span><i class="fas fa-heart"></i> 8.3K</span>
                <span><i class="fas fa-comment"></i> 432</span>
                <span><i class="fas fa-share"></i> 1.7K</span>
              </div>
            </div>
          </div>
          <div class="content-info">
            <span class="content-type">Infographic</span>
            <h3>Industry Statistics</h3>
            <p>LinkedIn data visualization post</p>
          </div>
        </div>

        <div class="content-portfolio-item" data-aos="zoom-in" data-aos-delay="300">
          <div class="content-image">
            <img src="<?php echo asset('service.jpg'); ?>" alt="Marketing materials">
            <div class="content-overlay">
              <div class="content-stats">
                <span><i class="fas fa-heart"></i> 15.2K</span>
                <span><i class="fas fa-comment"></i> 1.2K</span>
                <span><i class="fas fa-share"></i> 3.4K</span>
              </div>
            </div>
          </div>
          <div class="content-info">
            <span class="content-type">Email Campaign</span>
            <h3>Holiday Promotion</h3>
            <p>Seasonal email template series</p>
          </div>
        </div>

        <div class="content-portfolio-item" data-aos="zoom-in" data-aos-delay="400">
          <div class="content-image">
            <img src="<?php echo asset('hero.png'); ?>" alt="Story series">
            <div class="content-overlay">
              <div class="content-stats">
                <span><i class="fas fa-eye"></i> 45K</span>
                <span><i class="fas fa-comment"></i> 2.8K</span>
                <span><i class="fas fa-share"></i> 890</span>
              </div>
            </div>
          </div>
          <div class="content-info">
            <span class="content-type">Story Series</span>
            <h3>Behind The Scenes</h3>
            <p>Instagram Stories campaign</p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Content Creation FAQ</h2>
      </div>

      <div class="faq-container">
        <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
          <button class="faq-question">
            <span>How many pieces of content do I need per month?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>It depends on your platforms and goals. We typically recommend: 12-20 posts for Instagram, 8-15 for LinkedIn, 20-30 for Twitter/X. Our Professional package (24 posts/month) covers most businesses' needs across 2-3 platforms. We'll assess your specific requirements during onboarding.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
          <button class="faq-question">
            <span>Do you write captions and copy too?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Yes! Our Professional and Enterprise packages include caption writing. We craft engaging captions with strategic hashtags, calls-to-action, and your brand voice. Starter package clients can add copywriting services for $200/month or provide their own captions.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
          <button class="faq-question">
            <span>Can you schedule and post the content for us?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Absolutely! We can handle full content scheduling and posting through tools like Buffer or Later. This service is included in Enterprise packages or available as an add-on ($300/month) for other tiers. We'll optimize posting times based on your audience analytics.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
          <button class="faq-question">
            <span>What if I need specific content for an event or promotion?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Rush projects are our specialty! We can create event-specific content with 24-48 hour turnaround for an additional fee. All packages include flexibility for timely content like sales, announcements, or trending topics—just give us a heads up.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
          <button class="faq-question">
            <span>How do revisions work?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Starter packages include 2 revision rounds per asset. Professional and Enterprise packages include unlimited revisions. We share content via a review platform where you can comment directly on designs. Most clients approve content within 1-2 revision rounds.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
          <button class="faq-question">
            <span>Do I own the content you create?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Yes, you receive full rights to all content we create for you. We provide source files (PSD, AI) and web-ready exports. The only exception is stock photos/assets, which are licensed but included in your package pricing.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="testimonials-modern">
      <div class="testimonials-modern-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">What Clients Say</h2>
          <p class="section-subtitle">Brands we've helped grow</p>
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
            
            <p class="testimonial-text">"Our Instagram engagement tripled in just 3 months! They understand what content resonates with our audience and consistently deliver scroll-stopping visuals."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">JL</div>
              </div>
              <div class="author-info">
                <h4>Jessica Lee</h4>
                <p>Marketing Manager | Fashion Brand</p>
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
            
            <p class="testimonial-text">"Finally, a team that gets B2B content! Our LinkedIn posts now actually get engagement. The infographics and thought leadership content have positioned us as industry experts."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">MK</div>
              </div>
              <div class="author-info">
                <h4>Michael Kim</h4>
                <p>CEO | SaaS Company</p>
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
            
            <p class="testimonial-text">"They take care of everything—from strategy to posting. I can focus on running my business while they handle our entire content presence. Worth every penny!"</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">AP</div>
              </div>
              <div class="author-info">
                <h4>Alicia Patel</h4>
                <p>Founder | Wellness Studio</p>
              </div>
            </div>
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