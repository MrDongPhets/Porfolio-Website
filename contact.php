<?php
// contact.php - Contact Page
require_once 'config/config.php';

// Set page title
$pageTitle = 'Contact Us';

// Fetch site settings
$siteName = getSetting('site_name', 'MR. DONGPHETS');
$contactEmail = getSetting('contact_email', 'hello@mdongphets.com');

// Include header
include 'includes/site-header.php';
?>

    <!-- Contact Hero -->
    <section class="contact-hero">
      <div class="contact-hero-content" data-aos="fade-up">
        <div class="hero-badge">
          <i class="fas fa-envelope"></i> Let's Talk
        </div>
        <h1>Get in Touch</h1>
        <p>Have a project in mind? Let's create something amazing together. We're here to bring your vision to life.</p>
      </div>
      
      <div class="social-links-contact" data-aos="fade-up" data-aos-delay="200">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
        <a href="#"><i class="fab fa-dribbble"></i></a>
      </div>
    </section>

    <!-- Contact Main Section -->
    <section class="contact-main-section">
      <div class="contact-container">
        <!-- Contact Form -->
        <div class="contact-form-wrapper" data-aos="fade-right">
          <div class="form-header">
            <h2>Send us a Message</h2>
            <p>Fill out the form below and we'll get back to you within 24 hours</p>
          </div>

          <!-- Contact Form -->
          <div class="contact-form-wrapper" data-aos="fade-right">
            <div class="form-header">
              <h2>Send us a Message</h2>
              <p>Fill out the form below and we'll get back to you within 24 hours</p>
            </div>

            <!-- IMPORTANT: Remove action attribute and add onsubmit="return false;" -->
            <form id="contactForm" class="modern-contact-form" onsubmit="return false;">
              <!-- Web3Forms Access Key -->
              <input type="hidden" name="access_key" value="c143c009-815d-4a18-b787-9db4e69b864a">
              
              <!-- Honeypot Spam Protection -->
              <input type="checkbox" name="botcheck" class="hidden" style="display: none;">
              
              <div class="form-row-modern">
                <div class="form-group-modern">
                  <label for="name">
                    <i class="fas fa-user"></i> Full Name *
                  </label>
                  <input type="text" id="name" name="name" required placeholder="John Doe">
                </div>

                <div class="form-group-modern">
                  <label for="email">
                    <i class="fas fa-envelope"></i> Email Address *
                  </label>
                  <input type="email" id="email" name="email" required placeholder="john@example.com">
                </div>
              </div>

              <div class="form-row-modern">
                <div class="form-group-modern">
                  <label for="phone">
                    <i class="fas fa-phone"></i> Phone Number
                  </label>
                  <input type="tel" id="phone" name="phone" placeholder="+1 (234) 567-8900">
                </div>

                <div class="form-group-modern">
                  <label for="service">
                    <i class="fas fa-briefcase"></i> Service Interested In
                  </label>
                  <select id="service" name="service">
                    <option value="">Select a service</option>
                    <option value="Website Design">Website Design</option>
                    <option value="Brand Identity">Brand Identity</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>

              <div class="form-group-modern">
                <label for="message">
                  <i class="fas fa-comment-dots"></i> Your Message *
                </label>
                <textarea id="message" name="message" required placeholder="Tell us about your project..."></textarea>
              </div>

              <div class="checkbox-group">
                <label class="checkbox-label">
                  <input type="checkbox" name="newsletter" value="yes">
                  <span class="checkbox-text">
                    <i class="fas fa-envelope-open-text"></i>
                    Subscribe to our newsletter for design tips and updates
                  </span>
                </label>
              </div>

              <!-- Use type="button" instead of type="submit" -->
              <button type="button" id="submitBtn" class="btn btn-primary-modern btn-lg btn-block">
                <span class="btn-text">Send Message</span>
                <span class="btn-icon"><i class="fas fa-paper-plane"></i></span>
              </button>

              <div class="form-note">
                <i class="fas fa-shield-alt"></i>
                Your information is secure and will never be shared
              </div>
            </form>
          </div>
        </div>

        <!-- Contact Info Sidebar -->
        <div class="contact-info-wrapper" data-aos="fade-left" data-aos-delay="200">
          <!-- Quick Contact Cards -->
          <div class="contact-card">
            <div class="contact-card-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-card-content">
              <h3>Email Us</h3>
              <p>Send us an email anytime</p>
              <a href="mailto:<?php echo e($contactEmail); ?>" class="contact-link">
                <?php echo e($contactEmail); ?>
              </a>
            </div>
          </div>

          <div class="contact-card">
            <div class="contact-card-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div class="contact-card-content">
              <h3>Call Us</h3>
              <p>Mon-Fri from 9am to 6pm</p>
              <a href="tel:+1234567890" class="contact-link">
                +1 (234) 567-8900
              </a>
            </div>
          </div>

          <div class="contact-card">
            <div class="contact-card-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-card-content">
              <h3>Visit Us</h3>
              <p>Come say hello at our office</p>
              <address class="contact-address">
                123 Creative Street<br>
                San Francisco, CA 94102<br>
                United States
              </address>
            </div>
          </div>

          <!-- Response Time -->
          <div class="response-time-card">
            <div class="response-icon">
              <i class="fas fa-clock"></i>
            </div>
            <h4>Quick Response Time</h4>
            <p>We typically respond within <strong>24 hours</strong> on business days</p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="contact-faq-section">
      <div class="section-header" data-aos="fade-up">
        <h2 class="section-title-modern">Frequently Asked Questions</h2>
        <p class="section-subtitle">Quick answers to common questions</p>
      </div>

      <div class="faq-grid">
        <div class="faq-card" data-aos="fade-up" data-aos-delay="100">
          <div class="faq-icon">
            <i class="fas fa-question-circle"></i>
          </div>
          <h3>How long does a typical project take?</h3>
          <p>Project timelines vary based on scope. Simple websites take 4-6 weeks, while complex projects can take 3-6 months. We'll provide a detailed timeline during consultation.</p>
        </div>

        <div class="faq-card" data-aos="fade-up" data-aos-delay="200">
          <div class="faq-icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <h3>What are your pricing structures?</h3>
          <p>We offer both project-based and retainer pricing. Rates depend on project complexity, timeline, and required services. Contact us for a custom quote.</p>
        </div>

        <div class="faq-card" data-aos="fade-up" data-aos-delay="300">
          <div class="faq-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3>Do you work with startups?</h3>
          <p>Absolutely! We love working with startups and offer flexible pricing options. We understand the unique challenges and can scale our services to your needs.</p>
        </div>

        <div class="faq-card" data-aos="fade-up" data-aos-delay="400">
          <div class="faq-icon">
            <i class="fas fa-globe"></i>
          </div>
          <h3>Do you work remotely?</h3>
          <p>Yes! We work with clients worldwide. Our remote collaboration tools ensure seamless communication regardless of your location.</p>
        </div>
      </div>
    </section>

    <!-- Map Section (Optional) -->
    <!-- <section class="map-section" data-aos="fade-up">
      <div class="map-container">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.086221973443!2d-122.41941708468193!3d37.77492797975903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c6c8f4459%3A0xb10ed6d9b5050fa5!2sSan%20Francisco%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1234567890123!5m2!1sen!2s" 
          width="100%" 
          height="450" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </section> -->

    <!-- CTA Section -->
    <section class="contact-cta-section" data-aos="fade-up">
      <div class="cta-content">
        <div class="cta-icon-large">
          <i class="fas fa-rocket"></i>
        </div>
        <h2>Ready to Start Your Project?</h2>
        <p>Book a free 30-minute consultation to discuss your project and get expert advice</p>
        <a href="#" class="btn btn-white-outline btn-lg">
          <i class="far fa-calendar-alt"></i> Schedule a Call
        </a>
      </div>
    </section>

<script>
$(document).ready(function() {
    const form = $('#contactForm');
    const submitBtn = $('#submitBtn');
    
    if (form.length === 0 || submitBtn.length === 0) {
        console.error('Form or button not found!');
        return;
    }

    submitBtn.on('click', async function() {
        // Validate form using native HTML5 validation
        if (!form[0].checkValidity()) {
            form[0].reportValidity();
            return;
        }

        const btnText = submitBtn.find('.btn-text');
        const btnIcon = submitBtn.find('.btn-icon');
        
        // Disable button and show loading state
        submitBtn.prop('disabled', true);
        btnText.text('Sending...');
        btnIcon.html('<i class="fas fa-spinner fa-spin"></i>');
        
        const formData = new FormData(form[0]);
        
        try {
            // Send to Web3Forms (primary submission)
            const response = await fetch('https://api.web3forms.com/submit', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            console.log('Web3Forms response:', data);
            
            if (data.success) {
                // Try to save to database (optional)
                try {
                    const dbData = {
                        name: formData.get('name'),
                        email: formData.get('email'),
                        phone: formData.get('phone') || '',
                        service: formData.get('service') || '',
                        message: formData.get('message')
                    };
                    
                    const dbResponse = await $.ajax({
                        url: '<?php echo baseUrl("contact-handler.php"); ?>',
                        method: 'POST',
                        data: dbData,
                        dataType: 'json'
                    });
                    
                    console.log('✓ Message saved to database');
                } catch (dbError) {
                    console.warn('⚠ Database save error (non-critical):', dbError);
                }
                
                // Show success with SweetAlert2
                await Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    html: '<p>Thank you for reaching out! We\'ll get back to you within <strong>24 hours</strong>.</p>',
                    confirmButtonText: 'Great!',
                    confirmButtonColor: '#EBB92F'
                });
                
                // Reset form
                form[0].reset();
                
            } else {
                throw new Error(data.message || 'Form submission failed');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            
            // Show error with SweetAlert2
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `<p>Something went wrong. Please try again or email us directly at:</p>
                       <p><strong><?php echo e($contactEmail); ?></strong></p>`,
                confirmButtonText: 'OK',
                confirmButtonColor: '#EBB92F'
            });
        } finally {
            // Re-enable button
            submitBtn.prop('disabled', false);
            btnText.text('Send Message');
            btnIcon.html('<i class="fas fa-paper-plane"></i>');
        }
    });

    // Floating label effect
    form.find('.form-group-modern input, .form-group-modern textarea, .form-group-modern select').each(function() {
        $(this).on('focus', function() {
            $(this).parent().addClass('focused');
        });
        
        $(this).on('blur', function() {
            if (!$(this).val()) {
                $(this).parent().removeClass('focused');
            }
        });
    });
});
</script>

<?php include 'includes/site-footer.php'; ?>