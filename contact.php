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

          <form id="contactForm" class="modern-contact-form">
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
                <label for="company">
                  <i class="fas fa-building"></i> Company
                </label>
                <input type="text" id="company" name="company" placeholder="Your Company">
              </div>
            </div>

            <div class="form-group-modern">
              <label for="service">
                <i class="fas fa-briefcase"></i> Service Interested In
              </label>
              <select id="service" name="service">
                <option value="">Select a service</option>
                <option value="web-design">Web Design & Development</option>
                <option value="branding">Branding & Creative Design</option>
                <option value="video-editing">Video Editing & Multimedia</option>
                <option value="content-creation">Content Creation & Media</option>
                <option value="admin-support">Administrative Support</option>
                <option value="other">Other</option>
              </select>
            </div>

            <div class="form-group-modern">
              <label for="budget">
                <i class="fas fa-dollar-sign"></i> Project Budget
              </label>
              <select id="budget" name="budget">
                <option value="">Select budget range</option>
                <option value="under-5k">Under $5,000</option>
                <option value="5k-10k">$5,000 - $10,000</option>
                <option value="10k-25k">$10,000 - $25,000</option>
                <option value="25k-50k">$25,000 - $50,000</option>
                <option value="50k-plus">$50,000+</option>
              </select>
            </div>

            <div class="form-group-modern">
              <label for="message">
                <i class="fas fa-comment-alt"></i> Tell us about your project *
              </label>
              <textarea id="message" name="message" rows="6" required placeholder="Describe your project, goals, timeline, and any specific requirements..."></textarea>
            </div>

            <div class="form-group-modern checkbox-group">
              <label class="checkbox-label">
                <input type="checkbox" name="newsletter" id="newsletter">
                <span class="checkbox-text">
                  <i class="fas fa-check"></i>
                  Send me updates about services and special offers
                </span>
              </label>
            </div>

            <button type="submit" class="btn btn-primary-modern btn-block btn-lg">
              <span class="btn-text">Send Message</span>
              <span class="btn-icon"><i class="fas fa-paper-plane"></i></span>
            </button>

            <p class="form-note">
              <i class="fas fa-shield-alt"></i> Your information is secure and will never be shared with third parties.
            </p>
          </form>
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

          <!-- Social Links -->
          <div class="social-links-card">
            <h3>Follow Us</h3>
            <p>Stay connected on social media</p>
            <div class="social-links-grid">
              <a href="#" class="social-link" data-tooltip="Facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-link" data-tooltip="Twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-link" data-tooltip="Instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="social-link" data-tooltip="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#" class="social-link" data-tooltip="Dribbble">
                <i class="fab fa-dribbble"></i>
              </a>
              <a href="#" class="social-link" data-tooltip="Behance">
                <i class="fab fa-behance"></i>
              </a>
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
    <section class="map-section" data-aos="fade-up">
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
    </section>

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
      // Form submission handler
      document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnIcon = submitBtn.querySelector('.btn-icon');
        
        // Disable button and show loading state
        submitBtn.disabled = true;
        btnText.textContent = 'Sending...';
        btnIcon.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        const formData = new FormData(this);
        const data = {
          name: formData.get('name'),
          email: formData.get('email'),
          phone: formData.get('phone'),
          company: formData.get('company'),
          service: formData.get('service'),
          budget: formData.get('budget'),
          message: formData.get('message'),
          newsletter: formData.get('newsletter') ? true : false
        };
        
        // Send to backend
        fetch('<?php echo baseUrl("contact-handler.php"); ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams(data)
        })
        .then(response => response.json())
        .then(result => {
          // Success message
          alert('Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.');
          this.reset();
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Oops! Something went wrong. Please try again or email us directly at <?php echo e($contactEmail); ?>');
        })
        .finally(() => {
          // Re-enable button
          submitBtn.disabled = false;
          btnText.textContent = 'Send Message';
          btnIcon.innerHTML = '<i class="fas fa-paper-plane"></i>';
        });
      });

      // Add floating label effect
      const inputs = document.querySelectorAll('.form-group-modern input, .form-group-modern textarea, .form-group-modern select');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
          if (!this.value) {
            this.parentElement.classList.remove('focused');
          }
        });
      });
    </script>

<?php include 'includes/site-footer.php'; ?>