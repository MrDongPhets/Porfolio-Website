<?php
// about.php - About Us Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'About Us';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- HERO SECTION - ABOUT -->
    <section class="about-hero">
      <div class="about-hero-content" data-aos="fade-up">
        <h1 class="about-hero-title">
          We Design & Build Digital Experiences That Move the Needle
        </h1>
      </div>

      <div class="about-hero-images">
        <div class="hero-image-card card-1" data-aos="fade-right" data-aos-delay="200">
          <img src="<?php echo asset('hero.png'); ?>" alt="Team collaboration">
        </div>
        <div class="hero-image-card card-2" data-aos="fade-left" data-aos-delay="400">
          <img src="<?php echo asset('about-2.png'); ?>" alt="Creative workspace">
        </div>
        <div class="hero-accent-icon" data-aos="zoom-in" data-aos-delay="600">
          <i class="fas fa-asterisk"></i>
        </div>
      </div>

      <div class="about-hero-description" data-aos="fade-up" data-aos-delay="300">
        <p>
          We're not your average design shop. We're a strategic creative partner that turns your 
          engaging narratives with curated technology. Since 2019, we've helped turn bold ideas into 
          real results—websites that convert, apps that delight, and brands that stand out and connect.
        </p>
        <a href="#story" class="btn btn-primary-modern">
          Our Process <i class="fas fa-arrow-down"></i>
        </a>
      </div>
    </section>

    <!-- HOW WE WORK SECTION -->
    <section id="story" class="how-we-work-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">How We Work: Painless. Proven. Pixel-Perfect</h2>
      </div>

      <div class="work-process-grid">
        <div class="work-process-card" data-aos="fade-up" data-aos-delay="100">
          <div class="process-icon">
            <div class="icon-circle">
              <i class="fas fa-search"></i>
            </div>
          </div>
          <h3>Discover</h3>
          <p>We dive deep into your goals, audience, and market. Research is core to solving problems.</p>
          <a href="#discover" class="process-link">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="work-process-card" data-aos="fade-up" data-aos-delay="200">
          <div class="process-icon">
            <div class="icon-circle">
              <i class="fas fa-pencil-ruler"></i>
            </div>
          </div>
          <h3>Design & Build</h3>
          <p>We blend data with fresh, clean, champagne UX to deliver a brand people love.</p>
          <a href="#design" class="process-link">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>

        <div class="work-process-card" data-aos="fade-up" data-aos-delay="300">
          <div class="process-icon">
            <div class="icon-circle">
              <i class="fas fa-rocket"></i>
            </div>
          </div>
          <h3>Launch & Grow</h3>
          <p>We don't just deliver—we optimize for long-term success.</p>
          <a href="#launch" class="process-link">
            Learn More <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- MISSION & VISION SECTION -->
    <!-- <section class="mission-vision-section">
      <div class="mission-vision-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">Mission & Vision</h2>
          <p class="section-subtitle">The purpose and direction that guide everything we do</p>
        </div>

        <div class="mv-grid">
          <div class="mv-card mv-mission" data-aos="fade-right" data-aos-delay="100">
            <div class="mv-card-icon">
              <i class="fas fa-bullseye"></i>
            </div>
            <div class="mv-card-label">Mission</div>
            <h3>What We're Here to Do</h3>
            <p>To provide creative, reliable, and results-driven digital solutions while nurturing a team culture that develops integrity, servant leadership, professional excellence, and Christ-centered character.</p>
          </div>

          <div class="mv-card mv-vision" data-aos="fade-left" data-aos-delay="200">
            <div class="mv-card-icon">
              <i class="fas fa-binoculars"></i>
            </div>
            <div class="mv-card-label">Vision</div>
            <h3>Where We're Headed</h3>
            <p>To become a trusted global digital partner known not only for quality work and innovation, but also for raising leaders who positively impact businesses, communities, and lives through faith-informed service and excellence.</p>
          </div>
        </div>
      </div>
    </section> -->

    <!-- MUSTARD CORE VALUES -->
    <!-- <section class="awards-section">
      <div class="awards-section-container">
        <div class="section-header" data-aos="fade-up">
          <h2 class="section-title-modern">MUSTARD Core Values</h2>
          <p class="section-subtitle">The principles behind every decision, every project, every person</p>
        </div>

        <div class="awards-container">
          <div class="mustard-container">
            <span>M</span>
            <span>U</span>
            <span>S</span>
            <span>T</span>
            <span>A</span>
            <span>R</span>
            <span>D</span>
          </div>

          <div class="awards-list" data-aos="fade-left">
            <div class="award-item" data-aos="fade-up" data-aos-delay="100">
              <div class="award-info">
                <h3>Mission Driven Service</h3>
                <p>We serve with purpose, excellence, and intentionality, seeing our work as both professional service and meaningful impact.</p>
              </div>
              <div class="mustard-letter">M</div>
            </div>

            <div class="award-item" data-aos="fade-up" data-aos-delay="150">
              <div class="award-info">
                <h3>Unity in Team and Purpose</h3>
                <p>We cultivate collaboration, encouragement, and shared vision, building strong relationships within the team and with clients.</p>
              </div>
              <div class="mustard-letter">U</div>
            </div>

            <div class="award-item" data-aos="fade-up" data-aos-delay="200">
              <div class="award-info">
                <h3>Stewardship and Integrity</h3>
                <p>We handle time, talent, resources, and client trust responsibly, honoring God through honesty, accountability, and excellence.</p>
              </div>
              <div class="mustard-letter">S</div>
            </div>

            <div class="award-item" data-aos="fade-up" data-aos-delay="250">
              <div class="award-info">
                <h3>Transformational Growth</h3>
                <p>We commit to continuous growth professionally, personally, and spiritually, developing leaders who positively influence others.</p>
              </div>
              <div class="mustard-letter">T</div>
            </div>

            <div class="award-item" data-aos="fade-up" data-aos-delay="300">
              <div class="award-info">
                <h3>Authenticity and Humility</h3>
                <p>We work with sincerity, teachability, and humility, valuing character as much as competence.</p>
              </div>
              <div class="mustard-letter">A</div>
            </div>

            <div class="award-item" data-aos="fade-up" data-aos-delay="350">
              <div class="award-info">
                <h3>Reliability and Excellence</h3>
                <p>We deliver consistent quality, dependable service, and professional results that clients can trust.</p>
              </div>
              <div class="mustard-letter">R</div>
            </div>

            <div class="award-item" data-aos="fade-up" data-aos-delay="400">
              <div class="award-info">
                <h3>Discipleship Through Work</h3>
                <p>We see every project as an opportunity to model servant leadership, mentor others, and reflect values worth passing on.</p>
              </div>
              <div class="mustard-letter">D</div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- OUR STORY SECTION -->
    <section class="our-story-section">
      <div class="story-container">
        <div class="story-image" data-aos="fade-right">
          <img src="<?php echo asset('about-2.png'); ?>" alt="Our team at work">
          <div class="story-badge">
            <span class="badge-number">5+</span>
            <span class="badge-text">Years of Excellence</span>
          </div>
        </div>

        <div class="story-content" data-aos="fade-left">
          <h2 class="section-title-modern">
            From Garage Dreams to Pixel-Perfect Reality
          </h2>
          <p class="story-intro">
            We didn't start Web Rocket to follow design trends—we started it to leave them up 
            in the dust. Two Creators | defined by a hunger to break norms and an itch for 
            creating brands that don't just look good—they work harder.
          </p>
          <p class="story-text">
            Today, we're a squad of 15 designers, developers, and no-code wizards who still 
            operate like a startup.
          </p>

          <div class="story-highlights">
            <div class="highlight-item">
              <i class="fas fa-check-circle"></i>
              <span>Turning complex problems into creative milestones</span>
            </div>
            <div class="highlight-item">
              <i class="fas fa-check-circle"></i>
              <span>Building brands and designs momentum</span>
            </div>
            <div class="highlight-item">
              <i class="fas fa-check-circle"></i>
              <span>Pushing no-code tools to their absolute limits</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TEAM SECTION -->
    <section class="team-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">The Brains Behind Rocket</h2>
        <p class="section-subtitle">Meet the talented individuals who bring your vision to life</p>
      </div>

      <div class="team-grid">
        <div class="team-member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-image">
            <img src="<?php echo asset('hero.png'); ?>" alt="Alex Chen">
            <div class="member-overlay">
              <div class="member-social">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
              </div>
            </div>
          </div>
          <div class="member-info">
            <h3>Alex Chen</h3>
            <p>Co-Founder</p>
          </div>
        </div>

        <div class="team-member" data-aos="fade-up" data-aos-delay="200">
          <div class="member-image">
            <img src="<?php echo asset('about-2.png'); ?>" alt="Jordan Bennett">
            <div class="member-overlay">
              <div class="member-social">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
              </div>
            </div>
          </div>
          <div class="member-info">
            <h3>Jordan Bennett</h3>
            <p>Creative Director</p>
          </div>
        </div>

        <div class="team-member" data-aos="fade-up" data-aos-delay="300">
          <div class="member-image">
            <img src="<?php echo asset('service.jpg'); ?>" alt="Taylor Morgan">
            <div class="member-overlay">
              <div class="member-social">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
              </div>
            </div>
          </div>
          <div class="member-info">
            <h3>Taylor Morgan</h3>
            <p>Head of User Strategy</p>
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

    <!-- VALUES SECTION -->
    <section class="values-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">What Drives Us</h2>
        <p class="section-subtitle">Core values that shape everything we do</p>
      </div>

      <div class="values-grid">
        <div class="value-card" data-aos="fade-up" data-aos-delay="100">
          <div class="value-icon">
            <i class="fas fa-lightbulb"></i>
          </div>
          <h3>Innovation First</h3>
          <p>We don't follow trends—we set them. Every project is an opportunity to push boundaries and explore new possibilities.</p>
        </div>

        <div class="value-card" data-aos="fade-up" data-aos-delay="200">
          <div class="value-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Client Partnership</h3>
          <p>Your success is our success. We work alongside you as true partners, not just service providers.</p>
        </div>

        <div class="value-card" data-aos="fade-up" data-aos-delay="300">
          <div class="value-icon">
            <i class="fas fa-gem"></i>
          </div>
          <h3>Pixel Perfection</h3>
          <p>Details matter. We obsess over every pixel, interaction, and animation to deliver exceptional experiences.</p>
        </div>

        <div class="value-card" data-aos="fade-up" data-aos-delay="400">
          <div class="value-icon">
            <i class="fas fa-bolt"></i>
          </div>
          <h3>Speed & Quality</h3>
          <p>Fast delivery without compromising quality. We use modern tools and workflows to deliver results quickly.</p>
        </div>
      </div>
    </section>

<?php include 'includes/site-footer.php'; ?>