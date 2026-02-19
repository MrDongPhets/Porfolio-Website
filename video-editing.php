<?php
// services/video-editing.php - Video Editing & Multimedia Service Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Video Editing & Multimedia';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- SERVICE HERO SECTION -->
    <section class="service-hero-section">
      <div class="service-hero-content" data-aos="fade-up">
        <h1 class="service-hero-title">Video Editing & Multimedia</h1>
        <p class="service-hero-description">
          Short-form social videos, long-form content editing, promotional assets, and branded 
          video production. We transform raw footage into compelling stories that captivate 
          audiences, drive engagement, and deliver your message with cinematic quality.
        </p>
        <a href="#process" class="btn btn-primary-modern btn-lg">
          See Our Work <i class="fas fa-arrow-down"></i>
        </a>
      </div>

      <div class="service-hero-image" data-aos="fade-left" data-aos-delay="200">
        <img src="<?php echo asset('service.jpg'); ?>" alt="Video Editing Process">
        <div class="hero-badge-floating">
          <span class="badge-icon">▶</span>
          <span class="badge-text">4K Quality</span>
        </div>
      </div>
    </section>

    <!-- VIDEO EXCELLENCE SECTION -->
    <section class="design-works-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Stories That Move People</h2>
        <p class="section-subtitle-large">
          In a world where attention spans are shrinking, your video content needs to hook viewers 
          in the first 3 seconds and keep them watching until the end. We specialize in creating 
          scroll-stopping videos that blend stunning visuals, strategic pacing, and emotional 
          storytelling—whether it's a 15-second Instagram Reel or a 10-minute YouTube documentary.
        </p>
      </div>

      <div class="design-showcase-image video-showcase" data-aos="zoom-in" data-aos-delay="200">
        <img src="<?php echo asset('hero.png'); ?>" alt="Video editing showcase">
        <div class="video-play-overlay">
          <button class="play-button">
            <i class="fas fa-play"></i>
          </button>
        </div>
        <div class="showcase-overlay">
          <div class="overlay-stats">
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="400">
              <span class="stat-number">500+</span>
              <span class="stat-label">Videos Produced</span>
            </div>
            <div class="stat-bubble" data-aos="fade-up" data-aos-delay="500">
              <span class="stat-number">10M+</span>
              <span class="stat-label">Total Views</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- VIDEO PRODUCTION PROCESS -->
    <section id="process" class="process-detailed-section">
      <div class="process-detailed-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Our Video Production Process</h2>
        </div>
  
        <div class="process-detailed-grid">
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="100">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-file-video"></i>
              </div>
            </div>
            <h3>1. Pre-Production</h3>
            <p>Strategic planning and creative concepting to ensure your video hits the mark.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Scriptwriting & storyboarding</li>
              <li><i class="fas fa-check"></i> Shot list creation</li>
              <li><i class="fas fa-check"></i> Style & mood board development</li>
            </ul>
          </div>
  
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="200">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-cut"></i>
              </div>
            </div>
            <h3>2. Editing & Post</h3>
            <p>Professional editing with color grading, sound design, and motion graphics.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Multi-cam & multi-format editing</li>
              <li><i class="fas fa-check"></i> Color correction & grading</li>
              <li><i class="fas fa-check"></i> Audio mixing & sound design</li>
            </ul>
          </div>
  
          <div class="process-detailed-card" data-aos="fade-up" data-aos-delay="300">
            <div class="process-step-number">
              <div class="step-circle">
                <i class="fas fa-rocket"></i>
              </div>
            </div>
            <h3>3. Delivery & Optimization</h3>
            <p>Platform-optimized exports ready for distribution across all channels.</p>
            <ul class="process-features">
              <li><i class="fas fa-check"></i> Multiple format exports</li>
              <li><i class="fas fa-check"></i> Platform-specific optimization</li>
              <li><i class="fas fa-check"></i> Thumbnail & caption creation</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- VIDEO SERVICES -->
    <section class="superpowers-section">
      <div class="superpowers-container">
        <div class="superpowers-image" data-aos="fade-right">
          <img src="<?php echo asset('about-2.png'); ?>" alt="Video editing services">
          <div class="video-timeline-badge">
            <i class="fas fa-video"></i>
            <span>Professional Editing</span>
          </div>
        </div>

        <div class="superpowers-content" data-aos="fade-left">
          <h2 class="section-title-modern">Our Video Services</h2>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-mobile-alt"></i>
              Short-Form Social Content
            </h3>
            <p>
              TikToks, Reels, Shorts, and Stories that stop the scroll. Fast-paced edits with 
              trending music, captions, and effects optimized for maximum engagement and virality.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-film"></i>
              Long-Form Content Editing
            </h3>
            <p>
              YouTube videos, podcasts, webinars, and documentaries. Professional editing with 
              B-roll, graphics, lower thirds, and chapter markers for comprehensive content.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-bullhorn"></i>
              Promotional & Commercial Videos
            </h3>
            <p>
              Product demos, explainer videos, testimonials, and ads that convert viewers into 
              customers. Polished production value with strategic messaging.
            </p>
          </div>

          <div class="superpower-item">
            <h3>
              <i class="fas fa-magic"></i>
              Motion Graphics & Animation
            </h3>
            <p>
              Animated logos, kinetic typography, infographic videos, and 2D/3D animations that 
              bring concepts to life with eye-catching visual effects.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- VIDEO TYPES SECTION -->
    <section class="video-types-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Video Formats We Master</h2>
        <p class="section-subtitle">From quick social clips to cinematic productions</p>
      </div>

      <div class="video-types-grid">
        <div class="video-type-card" data-aos="fade-up" data-aos-delay="100">
          <div class="video-type-header">
            <i class="fab fa-tiktok"></i>
            <h3>Social Media Videos</h3>
          </div>
          <ul class="video-type-list">
            <li>Instagram Reels (15-90 sec)</li>
            <li>TikTok videos (15-60 sec)</li>
            <li>YouTube Shorts (60 sec)</li>
            <li>Facebook & LinkedIn videos</li>
            <li>Stories & ephemeral content</li>
          </ul>
          <div class="video-type-badge">Starting at $200</div>
        </div>

        <div class="video-type-card featured" data-aos="fade-up" data-aos-delay="200">
          <div class="featured-badge">Most Popular</div>
          <div class="video-type-header">
            <i class="fab fa-youtube"></i>
            <h3>YouTube Content</h3>
          </div>
          <ul class="video-type-list">
            <li>Full video editing (10-60 min)</li>
            <li>Podcast editing & clipping</li>
            <li>Thumbnail design included</li>
            <li>Intro/outro animations</li>
            <li>SEO-optimized descriptions</li>
          </ul>
          <div class="video-type-badge">Starting at $500</div>
        </div>

        <div class="video-type-card" data-aos="fade-up" data-aos-delay="300">
          <div class="video-type-header">
            <i class="fas fa-briefcase"></i>
            <h3>Commercial Productions</h3>
          </div>
          <ul class="video-type-list">
            <li>Product demonstrations</li>
            <li>Brand videos & commercials</li>
            <li>Explainer videos</li>
            <li>Customer testimonials</li>
            <li>Event coverage & highlights</li>
          </ul>
          <div class="video-type-badge">Starting at $1,500</div>
        </div>
      </div>
    </section>

    <!-- EDITING TOOLS & SOFTWARE -->
    <section class="tech-stack-section">
      <div class="tech-stack-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Professional Tools We Use</h2>
          <p class="section-subtitle">Industry-standard software for broadcast-quality results</p>
        </div>
  
        <div class="tech-stack-grid">
          <div class="tech-category" data-aos="fade-up" data-aos-delay="100">
            <h3><i class="fas fa-cut"></i> Video Editing</h3>
            <div class="tech-badges">
              <span class="tech-badge">Adobe Premiere Pro</span>
              <span class="tech-badge">Final Cut Pro</span>
              <span class="tech-badge">DaVinci Resolve</span>
              <span class="tech-badge">After Effects</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="200">
            <h3><i class="fas fa-palette"></i> Color Grading</h3>
            <div class="tech-badges">
              <span class="tech-badge">DaVinci Resolve</span>
              <span class="tech-badge">Lumetri Color</span>
              <span class="tech-badge">FilmConvert</span>
              <span class="tech-badge">Color Finale</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="300">
            <h3><i class="fas fa-volume-up"></i> Audio Production</h3>
            <div class="tech-badges">
              <span class="tech-badge">Adobe Audition</span>
              <span class="tech-badge">Logic Pro</span>
              <span class="tech-badge">Izotope RX</span>
              <span class="tech-badge">Soundstripe</span>
            </div>
          </div>
  
          <div class="tech-category" data-aos="fade-up" data-aos-delay="400">
            <h3><i class="fas fa-magic"></i> Motion Graphics</h3>
            <div class="tech-badges">
              <span class="tech-badge">After Effects</span>
              <span class="tech-badge">Cinema 4D</span>
              <span class="tech-badge">Blender</span>
              <span class="tech-badge">Element 3D</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PORTFOLIO SHOWCASE -->
    <section class="video-portfolio-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Recent Video Projects</h2>
        <p class="section-subtitle">See our work in action</p>
      </div>

      <div class="video-portfolio-grid">
        <div class="video-portfolio-item" data-aos="zoom-in" data-aos-delay="100">
          <div class="video-thumbnail">
            <img src="<?php echo asset('hero.png'); ?>" alt="Brand commercial">
            <div class="video-play-button">
              <i class="fas fa-play"></i>
            </div>
            <div class="video-duration">0:30</div>
            <div class="video-category">Commercial</div>
          </div>
          <div class="video-portfolio-info">
            <h3>Tech Product Launch</h3>
            <p>Sleek product reveal for consumer electronics</p>
            <div class="video-stats">
              <span><i class="fas fa-eye"></i> 2.4M views</span>
              <span><i class="fas fa-heart"></i> 89K likes</span>
            </div>
          </div>
        </div>

        <div class="video-portfolio-item" data-aos="zoom-in" data-aos-delay="200">
          <div class="video-thumbnail">
            <img src="<?php echo asset('about-2.png'); ?>" alt="Social media reel">
            <div class="video-play-button">
              <i class="fas fa-play"></i>
            </div>
            <div class="video-duration">0:15</div>
            <div class="video-category">Social</div>
          </div>
          <div class="video-portfolio-info">
            <h3>Viral Instagram Reel</h3>
            <p>Fast-paced fashion brand content</p>
            <div class="video-stats">
              <span><i class="fas fa-eye"></i> 5.1M views</span>
              <span><i class="fas fa-heart"></i> 234K likes</span>
            </div>
          </div>
        </div>

        <div class="video-portfolio-item" data-aos="zoom-in" data-aos-delay="300">
          <div class="video-thumbnail">
            <img src="<?php echo asset('service.jpg'); ?>" alt="YouTube video">
            <div class="video-play-button">
              <i class="fas fa-play"></i>
            </div>
            <div class="video-duration">12:45</div>
            <div class="video-category">YouTube</div>
          </div>
          <div class="video-portfolio-info">
            <h3>Educational Explainer</h3>
            <p>In-depth tutorial with motion graphics</p>
            <div class="video-stats">
              <span><i class="fas fa-eye"></i> 847K views</span>
              <span><i class="fas fa-heart"></i> 42K likes</span>
            </div>
          </div>
        </div>

        <div class="video-portfolio-item" data-aos="zoom-in" data-aos-delay="400">
          <div class="video-thumbnail">
            <img src="<?php echo asset('hero.png'); ?>" alt="Brand story">
            <div class="video-play-button">
              <i class="fas fa-play"></i>
            </div>
            <div class="video-duration">2:30</div>
            <div class="video-category">Brand</div>
          </div>
          <div class="video-portfolio-info">
            <h3>Company Culture Video</h3>
            <p>Authentic behind-the-scenes storytelling</p>
            <div class="video-stats">
              <span><i class="fas fa-eye"></i> 356K views</span>
              <span><i class="fas fa-heart"></i> 18K likes</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Video Production FAQ</h2>
      </div>

      <div class="faq-container">
        <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
          <button class="faq-question">
            <span>How much does video editing cost?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Pricing varies by project complexity: Social media clips start at $200, YouTube videos start at $500, and commercial productions start at $1,500. We offer package deals for ongoing content needs (10+ videos/month) with 20-30% discounts.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
          <button class="faq-question">
            <span>What's the typical turnaround time?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Social clips: 2-3 days. YouTube videos: 5-7 days. Commercial productions: 10-14 days. Rush delivery (24-48 hours) is available for an additional 50% fee. Timelines depend on video length and complexity.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
          <button class="faq-question">
            <span>Do you provide videography or just editing?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>We specialize in editing but can coordinate full production services through our network of videographers and production crews. For local projects, we offer complete shoot-to-edit packages. We also excel at editing existing footage you've already captured.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
          <button class="faq-question">
            <span>What file formats do you accept and deliver?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>We accept all major formats (MP4, MOV, AVI, MXF, ProRes, etc.). We deliver optimized files for each platform: MP4 for YouTube/web, vertical formats for TikTok/Reels, and high-res masters for broadcasting. Source files and project files available upon request.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
          <button class="faq-question">
            <span>Can you add subtitles and captions?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Absolutely! We include auto-captions for all videos, manually reviewed for accuracy. We offer multiple caption styles: minimalist, bold social media style, or custom branded captions matching your visual identity. Available in multiple languages.</p>
          </div>
        </div>

        <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
          <button class="faq-question">
            <span>Do you provide music and sound effects?</span>
            <i class="fas fa-plus"></i>
          </button>
          <div class="faq-answer">
            <p>Yes! We have subscriptions to premium royalty-free music libraries (Artlist, Epidemic Sound, Soundstripe). All music is licensed for commercial use. We also offer custom sound design, mixing, and audio enhancement to ensure professional quality.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="testimonials-modern">
      <div class="testimonials-modern-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">What Creators Say</h2>
          <p class="section-subtitle">Trusted by content creators and brands worldwide</p>
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
            
            <p class="testimonial-text">"They turned my raw footage into viral gold! My engagement increased 300% after they started editing my Reels. They just GET what works on social media."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">SM</div>
              </div>
              <div class="author-info">
                <h4>Sarah Mitchell</h4>
                <p>Content Creator | 500K followers</p>
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
            
            <p class="testimonial-text">"Professional, fast, and creative. They handle all our YouTube content and we've seen a 45% increase in watch time. Best investment we've made."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">JC</div>
              </div>
              <div class="author-info">
                <h4>James Chen</h4>
                <p>Tech Channel | 2M subscribers</p>
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
            
            <p class="testimonial-text">"Our product launch video exceeded all expectations. The motion graphics and color grading were stunning. Generated over $100K in sales in the first week."</p>
            
            <div class="testimonial-author">
              <div class="author-avatar">
                <div class="avatar-placeholder">ER</div>
              </div>
              <div class="author-info">
                <h4>Emily Rodriguez</h4>
                <p>Marketing Director | E-commerce</p>
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