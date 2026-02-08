<?php
// services.php - Services Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Our Services';

// Fetch all active services
$services = [];
$result = $db->select('services', '*', ['is_active' => true], 'display_order.asc');
if ($result['success'] && !empty($result['data'])) {
    $services = $result['data'];
}

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>


    <!-- Services Hero -->
    <div class="services-hero">
        <h1>Our Services</h1>
        <p>We offer comprehensive design solutions to help your brand stand out. From concept to completion, we deliver quality work that exceeds expectations.</p>
    </div>

    <!-- Services Section -->
    <section class="services-section">
        <?php if (!empty($services)): ?>
            <div class="services-grid-full">
                <?php foreach ($services as $service): ?>
                    <div class="service-card-full">
                        <div class="service-icon-large">
                            <?php echo $service['icon'] ?: '⚙️'; ?>
                        </div>
                        <h3><?php echo e($service['title']); ?></h3>
                        <p><?php echo e($service['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- How We Work Process -->
            <div class="process-section">
                <h2>How We Work</h2>
                <p class="process-subtitle">Our streamlined process ensures quality results every time</p>
                
                <div class="process-steps">
                    <div class="process-step">
                        <div class="step-number">1</div>
                        <h4>Discovery</h4>
                        <p>We start by understanding your goals, brand identity, and target audience to create the perfect strategy.</p>
                    </div>
                    
                    <div class="process-step">
                        <div class="step-number">2</div>
                        <h4>Design</h4>
                        <p>Our creative team develops stunning concepts that align with your vision and brand guidelines.</p>
                    </div>
                    
                    <div class="process-step">
                        <div class="step-number">3</div>
                        <h4>Refinement</h4>
                        <p>We work closely with you to perfect every detail until you're completely satisfied.</p>
                    </div>
                    
                    <div class="process-step">
                        <div class="step-number">4</div>
                        <h4>Delivery</h4>
                        <p>You receive all final files, assets, and documentation needed to implement your project.</p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="cta-section" style="margin-top: 80px;">
                <h2>Ready to Start Your Project?</h2>
                <p>Let's collaborate to bring your vision to life. Get in touch today to discuss your project requirements.</p>
                <div class="cta-buttons">
                    <a href="<?php echo baseUrl(); ?>#contact" class="btn-white">
                        <i class="fas fa-envelope"></i> Get in Touch
                    </a>
                    <a href="<?php echo baseUrl('portfolio.php'); ?>" class="btn-outline-white">
                        <i class="fas fa-briefcase"></i> View Our Work
                    </a>
                </div>
            </div>

        <?php else: ?>
            <div class="empty-services">
                <i class="fas fa-cog"></i>
                <h2>Services Coming Soon</h2>
                <p>We're currently updating our services. Check back soon!</p>
                <a href="<?php echo baseUrl(); ?>" class="btn" style="margin-top: 24px;">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        <?php endif; ?>
    </section>

<?php include 'includes/site-footer.php'; ?>