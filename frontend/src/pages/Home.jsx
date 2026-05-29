import { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { getHomeData, submitContact } from '../api/index.js';
import HeroCanvas from '../components/ui/HeroCanvas.jsx';
import BrandMarquee from '../components/BrandMarquee.jsx';
import mustardSeed from "../assets/mustard-seed.png";
import '../styles/style-modern.css';
import Pricing from '../components/Pricing.jsx';
import FAQs from '../components/FAQs.jsx';

const STATIC_SERVICES = [
  {
    num: '01', icon: 'fa-laptop-code',
    title: 'Web Design & Development',
    desc: 'Websites that look good and work harder. From landing pages to full-stack builds.',
    features: ['Responsive design', 'Fast performance', 'SEO optimized'],
  },
  {
    num: '02', icon: 'fa-palette',
    title: 'Branding & Creative Design',
    desc: 'Logos, brand kits, and visual identities that tell your story at a glance.',
    features: ['Logo design', 'Brand guidelines', 'Marketing materials'],
  },
  {
    num: '03', icon: 'fa-video',
    title: 'Video Editing & Production',
    desc: 'Short-form reels, YouTube content, promos, and motion graphics — done right.',
    features: ['Social media videos', 'YouTube editing', 'Motion graphics'],
  },

  {
    num: '04', icon: 'fa-user-cog',
    title: 'Administrative & Executive Support',
    desc: 'Virtual assistants who handle the details so you can focus on the big picture.',
    features: ['Email management', 'CRM coordination', 'Task automation'],
  },
   {
    num: '05', icon: 'fa-microchip',
    title: 'Emerging Tech & Custom Solutions',
    desc: 'AI-assisted projects, database systems, and custom digital builds for unique needs.',
    features: [ 'AI-powered workflow automation', 'Custom database architecture', 'API & third-party integrations' ],
  },
];

const STATIC_STATS = [
  { icon: 'fa-check-circle', num: '120+', label: 'Projects Completed',   desc: 'Delivered across web, brand, video & more' },
  { icon: 'fa-store',        num: '65+',  label: 'Businesses Supported', desc: 'Entrepreneurs & brands across 4 countries' },
  { icon: 'fa-th',           num: '5',    label: 'Service Areas',        desc: 'One team. Every digital need covered.' },
  { icon: 'fa-clock',        num: '48hr', label: 'Fast Turnaround',      desc: 'Quick delivery without cutting corners' },
  { icon: 'fa-heart',        num: '100%', label: 'Values-Driven',        desc: 'Integrity & excellence in every deliverable' },
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
  const [dataLoading, setDataLoading] = useState(true);
  useEffect(() => { document.title = 'MUSTARD Digitals — Creative Design Studio'; }, []);

  const [form, setForm] = useState({ name: '', email: '', message: '' });
  const [sending, setSending] = useState(false);
  const [contactResult, setContactResult] = useState(null);

  useEffect(() => {
    getHomeData()
      .then(d => setData(d))
      .catch(() => {})
      .finally(() => setDataLoading(false));
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
  const stats = data?.stats?.length ? data.stats : STATIC_STATS;
  return (
    <main>
      {/* Hero */}
      <section className="hero-modern">
         <HeroCanvas /> 
        <div className="hero-content-modern" data-aos="fade-up" data-aos-delay="200">
          <h1 className="hero-title-modern">
  The Digital Team Your Business<span className="hero-accent-word"> Deserves.</span>
</h1>
          <p className="hero-subtitle-modern">
            {hero?.subtitle || 'We\'re a Philippines-based digital solutions team helping businesses worldwide grow through creative design, web development, video production, and reliable operational support — all in one place.'}
          </p>

          <div className="hero-cta-buttons" data-aos="fade-up" data-aos-delay="400">
            <button className="btn btn-primary-modern hero-btn" onClick={() => navigate('/contact')}>
              {hero?.cta_text || 'Claim Your Free Trial'} <i className="fas fa-arrow-right"></i>
            </button>
          </div>
          <div className="hero-gap">
           <p className="button-note" data-aos="fade-up" data-aos-delay="500">
             2 hours <span className="hero-accent-word">•</span> Real work <span className="hero-accent-word">•</span> Zero commitment
            </p>
            </div>
        </div>
        {/* Temporaryly removing hero image and floating icons for a cleaner look, can be re-added later.
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
        */}
        <div className="impact-stats">
         {stats.map((s, i) => (
              <div className="impact-stat-item" key={i} data-aos="fade-up" data-aos-delay={`${i * 100}`}>
                <div className="impact-stat-icon">
                  <i className={`fas ${s.icon}`}></i>
                </div>
                <h3 className="impact-stat-num">{s.num}</h3>
                <p className="impact-stat-label">{s.label}</p>
                <p className="impact-stat-desc">{s.desc}</p>
              </div>
            ))}
            </div>
            <BrandMarquee />
      </section>
 {/* Intro / Brand Statement Section */}
 <section className="about-modern growth-modern">
  <div className="about-container growth-container">

    {/* LEFT CONTENT */}
    <div className="about-content growth-content" data-aos="fade-right">

      <h2 className="section-title-modern growth-title">
        Built to Grow.
        <br />
        <span>Built to Last.</span>
      </h2>

      <p className="about-description growth-description">
        Mustard Digitals was born from a simple conviction — that
        small beginnings lead to significant impact. Today we're a
        remote team helping entrepreneurs and businesses grow
        through web design, branding, video, content, and virtual
        support.
      </p>

      <p className="about-description growth-description growth-highlight">
        Not just great work. The right team behind it.
      </p>

      <a
        href="https://calendly.com/mustarddigitalsolutions/30min?month=2026-05"
        target="_blank"
        rel="noopener noreferrer"
        className="btn-primary-modern growth-btn"
      >
        <i className="fas fa-calendar"></i>
        Book a Free Discovery Call
      </a>

    </div>

    {/* RIGHT VISUAL */}
    <div className="growth-visual" data-aos="fade-left">

  {/* Background Rings */}
  <div className="growth-rings"></div>

 <div className="mustard-growth">

  <div className="mustard-core-glow"></div>
 {[...Array(20)].map((_, i) => (
  <span
    key={i}
    className={`seed-particle particle-${i + 1}`}
  ></span>
))}
</div>
 <img
    src={mustardSeed}
    alt="Mustard seed"
    className="mustard-logo"
  />
</div>
  </div>
</section>
    
{/* Services */}
<section id="services" className="services-modern">
  <div className="services-modern-container">
    
    <div className="services-bg-grid"></div>

    <div className="section-header">
      <h2 className=" services-title">
        What We Do
      </h2>

      <p className="section-subtitle services-subtitle">
        One coordinated team. Every digital need.
      </p>
    </div>

    <div className="services-grid-modern">
      {STATIC_SERVICES.map((svc, i) => (
        <div
          className={`service-card-modern `}
          key={svc.num}
          data-aos="fade-up"
          data-aos-delay={`${i * 100}`}
        >
          {/* Glow */}
          <div className="service-card-glow"></div>

       

          {/* Icon */}
          <div className="service-icon-wrapper">
            <div className="service-icon-modern">
              <i className={`fas ${svc.icon}`}></i>
            </div>
          </div>

          {/* Content */}
          <div className="service-content">
            <h3 className="service-title">{svc.title}</h3>

            <p className="service-description">{svc.desc}</p>

            <div className="service-divider"></div>

            <ul className="service-features">
              {svc.features.map((f) => (
                <li key={f}>
                  <i className="fas fa-check"></i>
                  <span>{f}</span>
                </li>
              ))}
            </ul>
          </div>
        </div>
      ))}
    </div>
    <div className="text-center" data-aos="fade-up" style={{ marginTop: '48px' }}>
    <div className="hero-cta-buttons" data-aos="fade-up" data-aos-delay="400" >
            <button className="btn btn-primary-modern" onClick={() => navigate('/services')}>          
              Explore All Services <i className="fas fa-arrow-right"></i>
            </button>
    </div>
      </div>
  </div>
</section>

 {/* Testimonials */}
      <section id="reviews" className="testimonials-modern">
        <div className="testimonials-modern-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">What Our Clients Say</h2>
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

    {/* Pricing */}
 <section className="" data-aos="fade-up">
  <Pricing />
  <div className="text-center" data-aos="fade-up" style={{ marginTop: '48px' }}>
    <h2>Still on the <span className="hero-accent-word">fence?</span></h2>
    <p>Let the work speak for itself.</p>
    </div>
  <div className="text-center" data-aos="fade-up" style={{ marginTop: '1px' }}>
    <div className="hero-cta-buttons" data-aos="fade-up" data-aos-delay="400" >
            <button className="btn btn-primary-modern" onClick={() => navigate('/contact')}>          
            Start Your Free 2-Hour Trial <i className="fas fa-arrow-right"></i>
            </button>
    </div>
      </div>
 </section>
{/* FAQs Accordion*/}
<section className="" data-aos="fade-up">
  <FAQs />
</section>
      

      {/* Contact Mini-Section */}
      <section id="contact" className="contact-modern">
        <div className="contact-container">
          <div className="contact-info" data-aos="fade-right">
            <h2>Ready to Grow Your Business?</h2>
            <p>Let's talk about your goals. We'll put together a plan that fits.
</p>

            <div className="contact-details">
              {[
                { icon: 'fa-envelope', label: 'Email', content: <a href="mailto:mustarddigitalsolutions@gmail.com">mustarddigitalsolutions@gmail.com</a> },
                { icon: 'fa-phone', label: 'Phone', content: <a href="tel: +62 9949674922">+63 9949674922</a> },
      
              ].map(item => (
                <div className="contact-item" key={item.label}>
                  <i className={`fas ${item.icon}`}></i>
                  <div>
                    <h4>{item.label}</h4>
                    {item.content}
                  </div>
                </div>
              ))}
                      <a
        href="https://calendly.com/mustarddigitalsolutions/30min?month=2026-05"
        target="_blank"
        rel="noopener noreferrer"
        className="btn-primary-modern growth-btn"
      >
        <i className="fas fa-calendar"></i>
        Book a Free Discovery Call
      </a>
            </div>

            <div className="social-links">
  <a
    href="https://www.facebook.com/profile.php?id=61588532360783"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Facebook"
  >
    <i className="fab fa-facebook-f"></i>
  </a>

  <a
    href="https://www.instagram.com/mustard_digitals"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Instagram"
  >
    <i className="fab fa-instagram"></i>
  </a>

  <a
    href="https://www.linkedin.com/company/mustard-digitals/"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="LinkedIn"
  >
    <i className="fab fa-linkedin-in"></i>
  </a>

   <a
    href="https://wa.me/639949674922"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="WhatsApp"
  >
    <i className="fab fa-whatsapp"></i>
  </a>
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
