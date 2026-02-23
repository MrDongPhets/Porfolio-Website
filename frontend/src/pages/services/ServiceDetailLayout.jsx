/**
 * ServiceDetailLayout
 * Shared shell used by all 5 service detail pages.
 *
 * Props shape:
 *  hero       { title, desc, img, badgeIcon, badgeText }
 *  excellence { heading, body, img, stats: [{num, label}] }
 *  process    [{ icon, title, desc, features[] }]      (3 items)
 *  children   – unique middle sections per service
 *  tools      [{ label, icon, badges[] }]
 *  faqs       [{ q, a }]
 *  testimonials [{ initials, text, name, role }]
 */

import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import '../../styles/service-detail.css';

/* ── Reusable FAQ accordion ──────────────────────────────── */
function FAQ({ faqs }) {
  const [open, setOpen] = useState(null);
  return (
    <section className="faq-section">
      <div className="section-header" data-aos="fade-up">
        <h2 className="section-title-modern">Frequently Asked Questions</h2>
      </div>
      <div className="faq-container">
        {faqs.map((faq, i) => (
          <div
            className={`faq-item${open === i ? ' active' : ''}`}
            key={i}
            // data-aos="fade-up"
            // data-aos-delay={`${(i + 1) * 100}`}
          >
            <button
              className="faq-question"
              onClick={() => setOpen(open === i ? null : i)}
            >
              <span>{faq.q}</span>
              <i className={`fas ${open === i ? 'fa-minus' : 'fa-plus'}`}></i>
            </button>
            <div
              className="faq-answer"
              style={{ maxHeight: open === i ? '500px' : '0' }}
            >
              <p>{faq.a}</p>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}

/* ── Main layout ─────────────────────────────────────────── */
export default function ServiceDetailLayout({
  hero,
  excellence,
  process: steps,
  children,
  tools,
  faqs,
  testimonials,
}) {
  const navigate = useNavigate();

  return (
    <main>
      {/* Hero */}
      <section className="service-hero-section">
        <div className="service-hero-content" data-aos="fade-up">
          <h1 className="service-hero-title">{hero.title}</h1>
          <p className="service-hero-description">{hero.desc}</p>
          <a href="#process" className="btn btn-primary-modern btn-lg">
            {hero.ctaText || 'See How We Work'} <i className="fas fa-arrow-down"></i>
          </a>
        </div>
        <div className="service-hero-image" data-aos="fade-left" data-aos-delay="200">
          <img src={hero.img} alt={hero.title} />
          <div className="hero-badge-floating">
            <span className="badge-icon">{hero.badgeIcon}</span>
            <span className="badge-text">{hero.badgeText}</span>
          </div>
        </div>
      </section>

      {/* Excellence */}
      <section className="design-works-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">{excellence.heading}</h2>
          <p className="section-subtitle-large">{excellence.body}</p>
        </div>
        <div className="design-showcase-image" data-aos="zoom-in" data-aos-delay="200">
          <img src={excellence.img} alt="showcase" />
          <div className="showcase-overlay">
            <div className="overlay-stats">
              {excellence.stats.map((s, i) => (
                <div className="stat-bubble" key={i} data-aos="fade-up" data-aos-delay={`${400 + i * 100}`}>
                  <span className="stat-number">{s.num}</span>
                  <span className="stat-label">{s.label}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Process */}
      <section id="process" className="process-detailed-section">
        <div className="process-detailed-section-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">How We Work</h2>
          </div>
          <div className="process-detailed-grid">
            {steps.map((step, i) => (
              <div className="process-detailed-card" key={i} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
                <div className="process-step-number">
                  <div className="step-circle">
                    <i className={`fas ${step.icon}`}></i>
                  </div>
                </div>
                <h3>{step.title}</h3>
                <p>{step.desc}</p>
                <ul className="process-features">
                  {step.features.map(f => (
                    <li key={f}><i className="fas fa-check"></i> {f}</li>
                  ))}
                </ul>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Service-specific sections */}
      {children}

      {/* Tools / Tech Stack */}
      {tools && tools.length > 0 && (
        <section className="tech-stack-section">
          <div className="tech-stack-section-container">
            <div className="section-header" data-aos="fade-up">
              <h2 className="section-title-modern">Tools &amp; Platforms We Master</h2>
              <p className="section-subtitle">Professional software for exceptional results</p>
            </div>
            <div className="tech-stack-grid">
              {tools.map((cat, i) => (
                <div className="tech-category" key={i} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
                  <h3><i className={`fas ${cat.icon}`}></i> {cat.label}</h3>
                  <div className="tech-badges">
                    {cat.badges.map(b => <span className="tech-badge" key={b}>{b}</span>)}
                  </div>
                </div>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* FAQ */}
      <FAQ faqs={faqs} />

      {/* Testimonials */}
      <section className="testimonials-modern">
        <div className="testimonials-modern-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">What Clients Say</h2>
          </div>
          <div className="testimonials-grid">
            {testimonials.map((t, i) => (
              <div className="testimonial-card-modern" key={i} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
                <div className="testimonial-rating">
                  <div className="rating-stars">
                    {[1,2,3,4,5].map(s => <i key={s} className="fas fa-star active"></i>)}
                  </div>
                  <span className="rating-number">5.0</span>
                </div>
                <p className="testimonial-text">{t.text}</p>
                <div className="testimonial-author">
                  <div className="author-avatar">
                    <div className="avatar-placeholder">{t.initials}</div>
                  </div>
                  <div className="author-info">
                    <h4>{t.name}</h4>
                    <p>{t.role}</p>
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
          <div className="cta-icon"><i className="fas fa-lightbulb"></i></div>
          <h2>Meet the Minds Behind the Magic</h2>
          <p>We don&apos;t just create designs—we craft experiences that turn heads, spark emotions, and drive results.</p>
          <button className="btn btn-primary-modern btn-lg" onClick={() => navigate('/contact')}>
            Get Started Today <i className="fas fa-arrow-right"></i>
          </button>
        </div>
      </section>
    </main>
  );
}
