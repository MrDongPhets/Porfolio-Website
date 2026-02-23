import { useState, useEffect } from 'react';
import { submitContact } from '../api/index.js';
import '../styles/contact.css';

export default function Contact() {
  useEffect(() => { document.title = 'Contact | MUSTARD Digitals'; }, []);
  const [form, setForm] = useState({
    name: '', email: '', phone: '', service: '', message: '', newsletter: false,
  });
  const [sending, setSending] = useState(false);
  const [success, setSuccess] = useState(false);
  const [error, setError] = useState('');

  function handleChange(e) {
    const { name, value, type, checked } = e.target;
    setForm(prev => ({ ...prev, [name]: type === 'checkbox' ? checked : value }));
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setSending(true);
    setError('');
    try {
      await submitContact({
        name: form.name,
        email: form.email,
        phone: form.phone,
        service: form.service,
        message: form.message,
        newsletter: form.newsletter ? 'yes' : '',
      });
      setSuccess(true);
      setForm({ name: '', email: '', phone: '', service: '', message: '', newsletter: false });
    } catch (err) {
      setError(err.message || 'Something went wrong. Please try again.');
    } finally {
      setSending(false);
    }
  }

  return (
    <main>
      {/* Contact Hero */}
      <section className="contact-hero">
        <div className="contact-hero-content" data-aos="fade-up">
          <div className="hero-badge">
            <i className="fas fa-envelope"></i> Let&apos;s Talk
          </div>
          <h1>Get in Touch</h1>
          <p>Have a project in mind? Let&apos;s create something amazing together. We&apos;re here to bring your vision to life.</p>
        </div>

        <div className="social-links-contact" data-aos="fade-up" data-aos-delay="200">
          <a href="#"><i className="fab fa-facebook"></i></a>
          <a href="#"><i className="fab fa-twitter"></i></a>
          <a href="#"><i className="fab fa-instagram"></i></a>
          <a href="#"><i className="fab fa-linkedin"></i></a>
          <a href="#"><i className="fab fa-dribbble"></i></a>
        </div>
      </section>

      {/* Contact Main Section */}
      <section className="contact-main-section">
        <div className="contact-container">
          {/* Contact Form */}
          <div className="contact-form-wrapper" data-aos="fade-right">
            <div className="form-header">
              <h2>Send us a Message</h2>
              <p>Fill out the form below and we&apos;ll get back to you within 24 hours</p>
            </div>

            {success && (
              <div style={{
                background: '#d4edda', color: '#155724', border: '1px solid #c3e6cb',
                borderRadius: '8px', padding: '16px', marginBottom: '24px',
              }}>
                <i className="fas fa-check-circle" style={{ marginRight: '8px' }}></i>
                <strong>Message Sent!</strong> Thank you for reaching out. We&apos;ll get back to you within 24 hours.
              </div>
            )}

            {error && (
              <div style={{
                background: '#f8d7da', color: '#721c24', border: '1px solid #f5c6cb',
                borderRadius: '8px', padding: '16px', marginBottom: '24px',
              }}>
                <i className="fas fa-exclamation-circle" style={{ marginRight: '8px' }}></i>
                {error}
              </div>
            )}

            <form className="modern-contact-form" onSubmit={handleSubmit}>
              <div className="form-row-modern">
                <div className="form-group-modern">
                  <label htmlFor="name">
                    <i className="fas fa-user"></i> Full Name *
                  </label>
                  <input
                    type="text" id="name" name="name" required
                    placeholder="John Doe"
                    value={form.name} onChange={handleChange}
                  />
                </div>
                <div className="form-group-modern">
                  <label htmlFor="email">
                    <i className="fas fa-envelope"></i> Email Address *
                  </label>
                  <input
                    type="email" id="email" name="email" required
                    placeholder="john@example.com"
                    value={form.email} onChange={handleChange}
                  />
                </div>
              </div>

              <div className="form-row-modern">
                <div className="form-group-modern">
                  <label htmlFor="phone">
                    <i className="fas fa-phone"></i> Phone Number
                  </label>
                  <input
                    type="tel" id="phone" name="phone"
                    placeholder="+1 (234) 567-8900"
                    value={form.phone} onChange={handleChange}
                  />
                </div>
                <div className="form-group-modern">
                  <label htmlFor="service">
                    <i className="fas fa-briefcase"></i> Service Interested In
                  </label>
                  <select id="service" name="service" value={form.service} onChange={handleChange}>
                    <option value="">Select a service</option>
                    <option value="Website Design">Website Design</option>
                    <option value="Brand Identity">Brand Identity</option>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>

              <div className="form-group-modern">
                <label htmlFor="message">
                  <i className="fas fa-comment-dots"></i> Your Message *
                </label>
                <textarea
                  id="message" name="message" required
                  placeholder="Tell us about your project..."
                  value={form.message} onChange={handleChange}
                ></textarea>
              </div>

              <div className="checkbox-group">
                <label className="checkbox-label">
                  <input
                    type="checkbox" name="newsletter"
                    checked={form.newsletter} onChange={handleChange}
                  />
                  <span className="checkbox-text">
                    <i className="fas fa-envelope-open-text"></i>
                    Subscribe to our newsletter for design tips and updates
                  </span>
                </label>
              </div>

              <button type="submit" className="btn btn-primary-modern btn-lg btn-block" disabled={sending}>
                <span className="btn-text">{sending ? 'Sending...' : 'Send Message'}</span>
                <span className="btn-icon">
                  <i className={`fas ${sending ? 'fa-spinner fa-spin' : 'fa-paper-plane'}`}></i>
                </span>
              </button>

              <div className="form-note">
                <i className="fas fa-shield-alt"></i>
                Your information is secure and will never be shared
              </div>
            </form>
          </div>

          {/* Contact Info Sidebar */}
          <div className="contact-info-wrapper" data-aos="fade-left" data-aos-delay="200">
            <div className="contact-card">
              <div className="contact-card-icon">
                <i className="fas fa-envelope"></i>
              </div>
              <div className="contact-card-content">
                <h3>Email Us</h3>
                <p>Send us an email anytime</p>
                <a href="mailto:hello@mdongphets.com" className="contact-link">
                  hello@mdongphets.com
                </a>
              </div>
            </div>

            <div className="contact-card">
              <div className="contact-card-icon">
                <i className="fas fa-phone-alt"></i>
              </div>
              <div className="contact-card-content">
                <h3>Call Us</h3>
                <p>Mon-Fri from 9am to 6pm</p>
                <a href="tel:+1234567890" className="contact-link">
                  +1 (234) 567-8900
                </a>
              </div>
            </div>

            <div className="contact-card">
              <div className="contact-card-icon">
                <i className="fas fa-map-marker-alt"></i>
              </div>
              <div className="contact-card-content">
                <h3>Visit Us</h3>
                <p>Come say hello at our office</p>
                <address className="contact-address">
                  123 Creative Street<br />
                  San Francisco, CA 94102<br />
                  United States
                </address>
              </div>
            </div>

            <div className="response-time-card">
              <div className="response-icon">
                <i className="fas fa-clock"></i>
              </div>
              <h4>Quick Response Time</h4>
              <p>We typically respond within <strong>24 hours</strong> on business days</p>
            </div>
          </div>
        </div>
      </section>

      {/* FAQ Section */}
      <section className="contact-faq-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Frequently Asked Questions</h2>
          <p className="section-subtitle">Quick answers to common questions</p>
        </div>

        <div className="faq-grid">
          {[
            { icon: 'fa-question-circle', q: 'How long does a typical project take?', a: 'Project timelines vary based on scope. Simple websites take 4-6 weeks, while complex projects can take 3-6 months. We\'ll provide a detailed timeline during consultation.' },
            { icon: 'fa-dollar-sign', q: 'What are your pricing structures?', a: 'We offer both project-based and retainer pricing. Rates depend on project complexity, timeline, and required services. Contact us for a custom quote.' },
            { icon: 'fa-handshake', q: 'Do you work with startups?', a: 'Absolutely! We love working with startups and offer flexible pricing options. We understand the unique challenges and can scale our services to your needs.' },
            { icon: 'fa-globe', q: 'Do you work remotely?', a: 'Yes! We work with clients worldwide. Our remote collaboration tools ensure seamless communication regardless of your location.' },
          ].map((faq, i) => (
            <div className="faq-card" key={i} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="faq-icon">
                <i className={`fas ${faq.icon}`}></i>
              </div>
              <h3>{faq.q}</h3>
              <p>{faq.a}</p>
            </div>
          ))}
        </div>
      </section>

      {/* CTA Section */}
      <section className="contact-cta-section" data-aos="fade-up">
        <div className="cta-content">
          <div className="cta-icon-large">
            <i className="fas fa-rocket"></i>
          </div>
          <h2>Ready to Start Your Project?</h2>
          <p>Book a free 30-minute consultation to discuss your project and get expert advice</p>
          <a href="#" className="btn btn-white-outline btn-lg">
            <i className="far fa-calendar-alt"></i> Schedule a Call
          </a>
        </div>
      </section>
    </main>
  );
}
