<?php
// index.php - Dynamic Homepage
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

// Fetch services (top 3 for homepage)
$services = [];
$result = $db->select('services', '*', ['is_active' => true], 'display_order.asc', 3);
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

    <!-- HERO SECTION - DYNAMIC -->
    <section class="hero">
      <div>
        <h1><?php echo e($hero['title'] ?? 'Designs That Speak, Brands That Shine'); ?></h1>
        <p><?php echo e($hero['subtitle'] ?? 'From logos and brochures to stunning landing pages — I craft visuals that turn ideas into unforgettable experiences.'); ?></p>
        <?php if (!empty($hero['cta_text'])): ?>
          <p><button class="btn" id="cta"><?php echo e($hero['cta_text']); ?></button></p>
        <?php endif; ?>
      </div>
      <div class="hero-image">
        <?php if (!empty($hero['image_url'])): ?>
          <img src="<?php echo e(getImageUrl($hero['image_url'])); ?>" alt="hero image">
        <?php else: ?>
          <img src="<?php echo asset('hero.png'); ?>" alt="desk mockup">
        <?php endif; ?>
      </div>
    </section>

    <!-- ABOUT SECTION - DYNAMIC -->
    <section id="about" class="about-section">
      <div class="about">
        <?php if (!empty($about['image_url'])): ?>
          <img src="<?php echo e(getImageUrl($about['image_url'])); ?>" alt="about illustration">
        <?php else: ?>
          <img src="<?php echo asset('about-2.png'); ?>" alt="illustration">
        <?php endif; ?>
        <div>
          <h2><?php echo e($about['title'] ?? 'About ' . $siteName); ?></h2>
          <p><?php echo nl2br(e($about['content'] ?? 'Welcome to our creative studio, where creativity meets functionality. With over 5 years of experience in graphic design, I specialize in creating impactful visual identities that resonate with your audience.')); ?></p>
        </div>
      </div>
    </section>

    <!-- FEATURE QUOTE -->
    <section class="feature">
        <div class="quote">
            <img src="<?php echo asset('service.jpg'); ?>" alt="">
            <div class="quote-text">
                <h2>Building Brands That Stand Out</h2>
                <p>"I craft distinctive brand identities through logos, brochures, and visual designs that speak directly to your audience and strengthen your market presence."</p>
            </div>
        </div>
        <div class="services"></div>
    </section>

    <!-- SERVICES SECTION - DYNAMIC -->
    <?php if (!empty($services)): ?>
    <section id="services" class="services-homepage">
        <h3>What We Offer</h3>
        <p class="lead">Comprehensive design services tailored to your needs</p>

        <div class="services-grid-home">
            <?php foreach ($services as $service): ?>
                <div class="service-item">
                    <div class="service-icon-home"><?php echo $service['icon'] ?: '⚙️'; ?></div>
                    <h4><?php echo e($service['title']); ?></h4>
                    <p><?php echo e(truncate($service['description'], 120)); ?></p>
                 
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align:center; margin-top:40px;">
            <a href="<?php echo baseUrl('services.php'); ?>" class="btn" style="display:inline-block;">
                View All Services <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- WORK PROCESS - DYNAMIC -->
    <section id="work" class="work">
      <h3>WORK PROCESS</h3>
      <p class="lead">Turning your ideas into stunning visuals, step by step.</p>

      <div class="steps">
        <?php if (!empty($workSteps)): ?>
          <?php foreach ($workSteps as $step): ?>
            <div class="step">
              <div class="icon"><?php echo $step['icon']; ?></div>
              <h4><?php echo e($step['title']); ?></h4>
              <p style="color:var(--muted);font-size:14px"><?php echo e($step['description']); ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Default steps if none in database -->
          <div class="step">
            <div class="icon">💬</div>
            <h4>DISCUSS</h4>
            <p style="color:var(--muted);font-size:14px">We start by understanding your goals, style preferences, and project requirements.</p>
          </div>
          <div class="step">
            <div class="icon">✏️</div>
            <h4>CREATIVE CONCEPT</h4>
            <p style="color:var(--muted);font-size:14px">I transform ideas into design concepts, exploring colors, typography, and layouts.</p>
          </div>
          <div class="step">
            <div class="icon">📐</div>
            <h4>PRODUCTION</h4>
            <p style="color:var(--muted);font-size:14px">Finalizing your chosen design with precision — creating high-quality deliverables.</p>
          </div>
          <div class="step">
            <div class="icon">😊</div>
            <h4>HAPPY CLIENT</h4>
            <p style="color:var(--muted);font-size:14px">Your satisfaction is my priority — delivering designs that work perfectly.</p>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- PORTFOLIO SECTION - DYNAMIC -->
    <?php if (!empty($portfolioItems)): ?>
    <section id="portfolio" class="portfolio">
      <h3>FEATURED WORK</h3>
      <p class="lead">Explore our latest projects and creative solutions</p>

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
                    <p><?php echo e(truncate($item['description'], 80)); ?></p>
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

      <div style="text-align:center; margin-top:40px;">
        <a href="<?php echo baseUrl('portfolio.php'); ?>" class="btn" style="display:inline-block;">
          View All Projects <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </section>
    <?php endif; ?>

    <!-- REVIEWS - DYNAMIC -->
    <section id="reviews" class="reviews">
      <h3>What Clients Say</h3>
      <div class="carousel" id="carousel">
        <!-- review cards injected by JS -->
      </div>
      <div style="text-align:center;margin-top:16px">
        <button id="prev" class="toggle">◀</button>
        <button id="next" class="toggle">▶</button>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="contact">
      <div>
        <h3>Contact</h3>
        <p class="lead" style="max-width:540px">Interested in working together? Send a message and I'll get back to you soon.</p>

        <form id="contactForm">
          <div class="field">
            <label for="name">Name</label>
            <input id="name" required>
          </div>
          <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" required>
          </div>
          <div class="field">
            <label for="message">Message</label>
            <textarea id="message" rows="5" required></textarea>
          </div>
          <div style="display:flex;gap:12px;align-items:center">
            <button class="btn" type="submit">Send Message</button>
            <small style="color:var(--muted)">Or email: <a href="mailto:<?php echo e($contactEmail); ?>"><?php echo e($contactEmail); ?></a></small>
          </div>
        </form>
      </div>

      <aside>
        <div style="background:var(--card);padding:22px;border-radius:10px;box-shadow:var(--shadow)">
          <h4 style="margin-top:0">Get a quote</h4>
          <p style="color:var(--muted)">Tell me about your project — brief, timeline and budget — and I'll return a tailored proposal.</p>
          <ul style="color:var(--muted);padding-left:18px">
            <li>Logo & Identity</li>
            <li>Brochure & Print</li>
            <li>Figma Landing Pages</li>
          </ul>
        </div>
      </aside>
    </section>

    <script>
      // Pass testimonials from PHP to JavaScript
const reviews = <?php echo json_encode($testimonials); ?>;
    </script>

<?php include 'includes/site-footer.php'; ?>