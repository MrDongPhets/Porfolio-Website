import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { getServices } from '../api/index.js';
import '../styles/services.css';

const STATIC_SERVICES = [
  { id: 1, icon: 'fas fa-laptop-code', title: 'Web Design & Development', description: 'Custom websites and web applications that combine stunning design with powerful functionality. We build responsive, fast, and SEO-optimized sites that convert visitors into clients.' },
  { id: 2, icon: 'fas fa-palette', title: 'Branding & Creative Design', description: 'Logo design, brand identity systems, and marketing visuals that strengthen brand recognition and tell your story. From concept to brand guidelines, we create brands that stick.' },
  { id: 3, icon: 'fas fa-video', title: 'Video Editing & Multimedia', description: 'Short-form social videos, long-form content editing, promotional assets, and branded video production. We create compelling motion content that captures attention and drives engagement.' },
  { id: 4, icon: 'fas fa-images', title: 'Content Creation & Media', description: 'Visual content, marketing graphics, multimedia assets, and branded materials for digital engagement. Consistent, high-quality content that builds your brand across every platform.' },
  { id: 5, icon: 'fas fa-user-cog', title: 'Administrative & Executive Support', description: 'Virtual assistance, operational coordination, documentation, CRM management, and workflow optimization. We handle the behind-the-scenes so you can focus on what matters most.' },
];

export default function Services() {
  const [services, setServices] = useState([]);
  const [loading, setLoading] = useState(true);
  const navigate = useNavigate();

  useEffect(() => {
    getServices()
      .then(data => setServices(data.data?.length ? data.data : STATIC_SERVICES))
      .catch(() => setServices(STATIC_SERVICES))
      .finally(() => setLoading(false));
  }, []);

  return (
    <main>
      {/* Services Hero */}
      <div className="services-hero">
        <h1>Our Services</h1>
        <p>We offer comprehensive design solutions to help your brand stand out. From concept to completion, we deliver quality work that exceeds expectations.</p>
      </div>

      {/* Services Section */}
      <section className="services-section">
        {loading ? (
          <div style={{ textAlign: 'center', padding: '80px 20px', color: 'var(--muted)' }}>
            <i className="fas fa-spinner fa-spin" style={{ fontSize: '48px', marginBottom: '16px' }}></i>
            <p>Loading services...</p>
          </div>
        ) : (
          <>
            <div className="services-grid-full">
              {services.map(service => (
                <div className="service-card-full" key={service.id} data-aos="fade-up">
                  <div className="service-icon-large">
                    <i className={service.icon || 'fas fa-cog'}></i>
                  </div>
                  <h3 className="service-title">{service.title}</h3>
                  <p>{service.description}</p>
                </div>
              ))}
            </div>

            {/* How We Work Process */}
            <div className="process-section">
              <h2>How We Work</h2>
              <p className="process-subtitle">Our streamlined process ensures quality results every time</p>

              <div className="process-steps">
                {[
                  { n: 1, title: 'Discovery', desc: 'We start by understanding your goals, brand identity, and target audience to create the perfect strategy.' },
                  { n: 2, title: 'Design', desc: 'Our creative team develops stunning concepts that align with your vision and brand guidelines.' },
                  { n: 3, title: 'Refinement', desc: 'We work closely with you to perfect every detail until you\'re completely satisfied.' },
                  { n: 4, title: 'Delivery', desc: 'You receive all final files, assets, and documentation needed to implement your project.' },
                ].map(step => (
                  <div className="process-step" key={step.n} data-aos="fade-up" data-aos-delay={`${step.n * 100}`}>
                    <div className="step-number">{step.n}</div>
                    <h4>{step.title}</h4>
                    <p>{step.desc}</p>
                  </div>
                ))}
              </div>
            </div>

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
          </>
        )}
      </section>
    </main>
  );
}
