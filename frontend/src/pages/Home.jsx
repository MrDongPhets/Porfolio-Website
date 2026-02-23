import { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { getHomeData, submitContact } from '../api/index.js';
import '../styles/style-modern.css';

const STATIC_SERVICES = [
  {
    num: '01', icon: 'fa-laptop-code',
    title: 'Web Design & Development',
    desc: 'Custom websites and web applications that combine stunning design with powerful functionality.',
    features: ['Responsive design', 'Fast performance', 'SEO optimized'],
  },
  {
    num: '02', icon: 'fa-palette',
    title: 'Branding & Creative Design',
    desc: 'Logo design, brand identity systems, and marketing visuals that strengthen brand recognition.',
    features: ['Logo design', 'Brand guidelines', 'Marketing materials'],
  },
  {
    num: '03', icon: 'fa-video',
    title: 'Video Editing & Multimedia',
    desc: 'Short-form social videos, long-form content editing, promotional assets, and branded video production.',
    features: ['Social media videos', 'YouTube editing', 'Motion graphics'],
  },
  {
    num: '04', icon: 'fa-images',
    title: 'Content Creation & Media',
    desc: 'Visual content, marketing graphics, multimedia assets, and branded materials for digital engagement.',
    features: ['Social media content', 'Marketing graphics', 'Infographics'],
  },
  {
    num: '05', icon: 'fa-user-cog',
    title: 'Administrative & Executive Support',
    desc: 'Virtual assistance, operational coordination, documentation, CRM management, and workflow optimization.',
    features: ['Email management', 'CRM coordination', 'Task automation'],
  },
];

const FALLBACK_TESTIMONIALS = [
  { id: 1, rating: 5, testimonial: '"Great project! people who truly understand the essence of brand design. They took time to get to know our team, our values, and our vision. I can\'t recommend them enough."', client_name: 'Sarah M.', company: 'CEO, Tech Startup' },
  { id: 2, rating: 5, testimonial: '"I can\'t say enough great things about this design team! From our very first call, they were professional, creative, and genuinely excited about our project."', client_name: 'David J.', company: 'Marketing Director' },
  { id: 3, rating: 5, testimonial: '"I can confidently say that our project exceeded all expectations thanks to the design agency. Their dedication to ensuring every detail was right."', client_name: 'Emma L.', company: 'Product Manager' },
];

function getInitials(name) {
  return (name || '')
    .split(' ')
    .slice(0, 2)
    .map(w => w[0]?.toUpperCase() || '')
    .join('');
}

export default function Home() {
  const navigate = useNavigate();
  const [data, setData] = useState(null);

  const [form, setForm] = useState({ name: '', email: '', message: '' });
  const [sending, setSending] = useState(false);
  const [contactResult, setContactResult] = useState(null);

  useEffect(() => {
    getHomeData()
      .then(d => setData(d))
      .catch(() => {});
  }, []);

  function handleContactChange(e) {
    const { name, value } = e.target;
    setForm(prev => ({ ...prev, [name]: value }));
  }

  async function handleContactSubmit(e) {
    e.preventDefault();
    setSending(true);
    setContactResult(null);
    try {
      await submitContact(form);
      setContactResult('success');
      setForm({ name: '', email: '', message: '' });
    } catch {
      setContactResult('error');
    } finally {
      setSending(false);
    }
  }

  const hero = data?.hero;
  const about = data?.about;
  const portfolioItems = data?.portfolio || [];
  const testimonials = (data?.testimonials?.length ? data.testimonials : FALLBACK_TESTIMONIALS).slice(0, 3);

  return (
    <main>
      {/* Hero */}
      <section className="hero-modern">
        <div className="hero-content-modern" data-aos="fade-up" data-aos-delay="200">
          <h1 className="hero-title-modern">
            {hero?.title || 'Where Stunning Design Meets Flawless Functionality'}
          </h1>
          <p className="hero-subtitle-modern">
            {hero?.subtitle || 'We craft all your designs: logos, flyers, branding, brochures, Figma landing pages, print-ready PDFs, and everything in between — with seamless collaboration and lightning-fast delivery.'}
          </p>

          <div className="hero-cta-buttons" data-aos="fade-up" data-aos-delay="400">
            <button className="btn btn-primary-modern" onClick={() => navigate('/contact')}>
              {hero?.cta_text || 'Get Started Today'}
              <i className="fas fa-arrow-right"></i>
            </button>
            <Link to="/portfolio" className="btn btn-outline-modern">
              <i className="fas fa-play-circle"></i> View Our Work
            </Link>
          </div>
        </div>

        <div className="hero-image-modern" data-aos="zoom-in" data-aos-delay="600">
          <img
            src={hero?.image_url || '/assets/hero.png'}
            alt="Creative team collaboration"
            className="hero-img-rounded"
          />
          <div className="float-element float-1" data-aos="fade-left" data-aos-delay="800">
            <i className="fas fa-palette"></i>
          </div>
          <div className="float-element float-2" data-aos="fade-right" data-aos-delay="1000">
            <i className="fas fa-code"></i>
          </div>
          <div className="float-element float-3" data-aos="fade-up" data-aos-delay="1200">
            <i className="fas fa-rocket"></i>
          </div>
        </div>
      </section>

      {/* About */}
      <section id="about" className="about-modern">
        <div className="about-container">
          <div className="about-content" data-aos="fade-right">
            <h2 className="section-title-modern">
              {about?.title || 'Unforgettable. Websites, Brands & Visuals for Bold Visionaries.'}
            </h2>
            <p className="about-description">
              {about?.content || "When you work with an elite agency, you don't just get a design. You walk away with a strategic partner who obsesses over every pixel, every color, and every user interaction."}
            </p>
            <button className="btn btn-primary-modern" onClick={() => navigate('/about')}>
              Explore More <i className="fas fa-arrow-right"></i>
            </button>
          </div>

          <div className="about-image" data-aos="fade-left">
            <img
              src={about?.image_url || '/assets/about-2.png'}
              alt="Creative workspace"
              className="about-img-rounded"
            />
          </div>
        </div>

        {/* Stats */}
        <div className="stats-section" data-aos="fade-up">
          {[
            { icon: 'fa-rocket', num: '72', label: 'Projects completed' },
            { icon: 'fa-users', num: '100+', label: 'Happy clients' },
            { icon: 'fa-clock', num: '10+', label: 'Years of experience' },
          ].map(stat => (
            <div className="stat-item" key={stat.label} data-aos="zoom-in">
              <div className="stat-icon"><i className={`fas ${stat.icon}`}></i></div>
              <h3 className="stat-number">{stat.num}</h3>
              <p className="stat-label">{stat.label}</p>
            </div>
          ))}
        </div>
      </section>

      {/* Services */}
      <section id="services" className="services-modern">
        <div className="services-modern-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">Services We Offer</h2>
            <p className="section-subtitle">Comprehensive design solutions tailored to your needs</p>
          </div>

          <div className="services-grid-modern">
            {STATIC_SERVICES.map((svc, i) => (
              <div className="service-card-modern" key={svc.num} data-aos="fade-up" data-aos-delay={`${i * 100}`}>
                <div className="service-number">{svc.num}</div>
                <div className="service-icon-modern">
                  <i className={`fas ${svc.icon}`}></i>
                </div>
                <h3 className="service-title">{svc.title}</h3>
                <p className="service-description">{svc.desc}</p>
                <ul className="service-features">
                  {svc.features.map(f => (
                    <li key={f}><i className="fas fa-check"></i> {f}</li>
                  ))}
                </ul>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Portfolio */}
      <section id="portfolio" className="portfolio-modern">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Showcase of Selected Work</h2>
          <p className="section-subtitle">Explore our latest projects and creative solutions</p>
        </div>

        <div className="portfolio-grid-modern">
          {portfolioItems.length > 0 ? portfolioItems.map((item, index) => (
            <div className="portfolio-card-modern" key={item.id} data-aos="zoom-in" data-aos-delay={`${index * 100}`}>
              <div className="portfolio-image-wrapper">
                <img src={item.image_url} alt={item.title} />
                <div className="portfolio-overlay-modern">
                  <div className="portfolio-overlay-content">
                    <span className="portfolio-category-badge">{item.category}</span>
                    <h3>{item.title}</h3>
                    {item.description && (
                      <p>{item.description.slice(0, 80)}{item.description.length > 80 ? '...' : ''}</p>
                    )}
                    <Link to={`/portfolio/${item.id}`} className="btn btn-white-sm">
                      View Case Study <i className="fas fa-arrow-right"></i>
                    </Link>
                  </div>
                </div>
              </div>
              <div className="portfolio-info-modern">
                <Link to={`/portfolio/${item.id}`} style={{ textDecoration: 'none', color: 'inherit' }}>
                  <h4>{item.title}</h4>
                </Link>
                <p className="portfolio-meta">
                  <span className="category">{item.category}</span>
                  <span className="separator">•</span>
                  <span className="date">
                    {new Date(item.created_at).toLocaleDateString('en-US', { month: 'short', year: 'numeric' })}
                  </span>
                </p>
              </div>
            </div>
          )) : (
            [
              { id: 1, img: '/assets/hero.png', cat: 'UI/UX DESIGN', title: 'Fintech Design - Google Study', desc: 'Modern fintech application design with seamless user experience' },
              { id: 2, img: '/assets/about-2.png', cat: 'BRANDING', title: 'Cosmetic - Brand Design', desc: 'Complete brand identity for a modern cosmetic line' },
              { id: 3, img: '/assets/service.jpg', cat: 'WEB DESIGN', title: 'Luxuria - Workflow Website', desc: 'Elegant e-commerce website with smooth animations' },
              { id: 4, img: '/assets/hero.png', cat: 'UI/UX', title: 'Dashboard - Saas Web of E-Stock', desc: 'Comprehensive dashboard design for stock management' },
            ].map((p, i) => (
              <div className="portfolio-card-modern" key={p.id} data-aos="zoom-in" data-aos-delay={`${i * 100}`}>
                <div className="portfolio-image-wrapper">
                  <img src={p.img} alt={p.title} />
                  <div className="portfolio-overlay-modern">
                    <div className="portfolio-overlay-content">
                      <span className="portfolio-category-badge">{p.cat}</span>
                      <h3>{p.title}</h3>
                      <p>{p.desc}</p>
                      <Link to="/portfolio" className="btn btn-white-sm">
                        View Project <i className="fas fa-arrow-right"></i>
                      </Link>
                    </div>
                  </div>
                </div>
                <div className="portfolio-info-modern">
                  <h4>{p.title}</h4>
                  <p className="portfolio-meta">{p.cat}</p>
                </div>
              </div>
            ))
          )}
        </div>

        <div className="text-center" data-aos="fade-up" style={{ marginTop: '48px' }}>
          <Link to="/portfolio" className="btn btn-outline-modern">
            View All Projects <i className="fas fa-arrow-right"></i>
          </Link>
        </div>
      </section>

      {/* Testimonials */}
      <section id="reviews" className="testimonials-modern">
        <div className="testimonials-modern-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">What Clients Say About Us</h2>
            <p className="section-subtitle">Don&apos;t just take our word for it</p>
          </div>

          <div className="testimonials-grid">
            {testimonials.map((t, i) => (
              <div className="testimonial-card-modern" key={t.id || i} data-aos="fade-up" data-aos-delay={`${i * 100}`}>
                <div className="testimonial-rating">
                  <div className="rating-stars">
                    {[1,2,3,4,5].map(s => (
                      <i key={s} className={`fas fa-star${s <= (t.rating || 5) ? ' active' : ''}`}></i>
                    ))}
                  </div>
                  <span className="rating-number">{t.rating || 5}.0</span>
                  <span className="rating-text">Excellent</span>
                </div>

                <p className="testimonial-text">{t.testimonial}</p>

                <div className="testimonial-author">
                  <div className="author-avatar">
                    {t.avatar_url ? (
                      <img src={t.avatar_url} alt={t.client_name} />
                    ) : (
                      <div className="avatar-placeholder">{getInitials(t.client_name)}</div>
                    )}
                  </div>
                  <div className="author-info">
                    <h4>{t.client_name}</h4>
                    <p>{t.company || 'Verified Customer'}</p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="cta-modern" data-aos="fade-up">
        <div className="cta-content">
          <div className="cta-icon">
            <i className="fas fa-lightbulb"></i>
          </div>
          <h2>Meet the Minds Behind the Magic</h2>
          <p>We don&apos;t just create designs—we craft experiences that turn heads, spark emotions, and drive results. Ready to start your next project?</p>
          <button className="btn btn-primary-modern btn-lg" onClick={() => navigate('/contact')}>
            Get Started Today <i className="fas fa-arrow-right"></i>
          </button>
        </div>
      </section>

      {/* Contact Mini-Section */}
      <section id="contact" className="contact-modern">
        <div className="contact-container">
          <div className="contact-info" data-aos="fade-right">
            <h2>Get the Good Inspiration</h2>
            <p>Want us to design something special for you or just curious about our rates? Drop us a message and we&apos;ll get back to you within 24 hours.</p>

            <div className="contact-details">
              {[
                { icon: 'fa-envelope', label: 'Email', content: <a href="mailto:hello@mdongphets.com">hello@mdongphets.com</a> },
                { icon: 'fa-phone', label: 'Phone', content: <a href="tel:+1234567890">+1 (234) 567-890</a> },
                { icon: 'fa-map-marker-alt', label: 'Location', content: <p>San Francisco, CA</p> },
              ].map(item => (
                <div className="contact-item" key={item.label}>
                  <i className={`fas ${item.icon}`}></i>
                  <div>
                    <h4>{item.label}</h4>
                    {item.content}
                  </div>
                </div>
              ))}
            </div>

            <div className="social-links">
              {['fa-facebook','fa-twitter','fa-instagram','fa-linkedin','fa-dribbble'].map(icon => (
                <a href="#" key={icon}><i className={`fab ${icon}`}></i></a>
              ))}
            </div>
          </div>

          <form className="contact-form-modern" onSubmit={handleContactSubmit} data-aos="fade-left">
            {contactResult === 'success' && (
              <div style={{ background: '#d4edda', color: '#155724', border: '1px solid #c3e6cb', borderRadius: '8px', padding: '12px', marginBottom: '16px' }}>
                <i className="fas fa-check-circle" style={{ marginRight: '8px' }}></i>
                Message sent! We&apos;ll be in touch within 24 hours.
              </div>
            )}
            {contactResult === 'error' && (
              <div style={{ background: '#f8d7da', color: '#721c24', border: '1px solid #f5c6cb', borderRadius: '8px', padding: '12px', marginBottom: '16px' }}>
                <i className="fas fa-exclamation-circle" style={{ marginRight: '8px' }}></i>
                Something went wrong. Please <Link to="/contact">use the contact page</Link>.
              </div>
            )}

            <div className="form-row">
              <div className="form-group">
                <label htmlFor="home-name">Name *</label>
                <input
                  type="text" id="home-name" name="name" required
                  placeholder="Your full name"
                  value={form.name} onChange={handleContactChange}
                />
              </div>
              <div className="form-group">
                <label htmlFor="home-email">Email *</label>
                <input
                  type="email" id="home-email" name="email" required
                  placeholder="your@email.com"
                  value={form.email} onChange={handleContactChange}
                />
              </div>
            </div>

            <div className="form-group">
              <label htmlFor="home-message">Message *</label>
              <textarea
                id="home-message" name="message" required
                placeholder="Tell us about your project..."
                value={form.message} onChange={handleContactChange}
              ></textarea>
            </div>

            <button type="submit" className="btn btn-primary-modern" disabled={sending}>
              <span>{sending ? 'Sending...' : 'Send Message'}</span>
              <i className={`fas ${sending ? 'fa-spinner fa-spin' : 'fa-paper-plane'}`}></i>
            </button>
          </form>
        </div>
      </section>
    </main>
  );
}
