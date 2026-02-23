import { useState, useEffect } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import { getPortfolioDetail } from '../api/index.js';
import '../styles/portfolio-detail.css';

function getCategoryIcon(cat) {
  if (!cat) return 'fa-folder';
  const c = cat.toLowerCase();
  if (c.includes('web')) return 'fa-laptop-code';
  if (c.includes('brand')) return 'fa-palette';
  if (c.includes('logo')) return 'fa-pen-nib';
  if (c.includes('video')) return 'fa-video';
  if (c.includes('social')) return 'fa-hashtag';
  if (c.includes('print')) return 'fa-print';
  if (c.includes('ui') || c.includes('ux')) return 'fa-layer-group';
  if (c.includes('content')) return 'fa-images';
  return 'fa-folder';
}

export default function PortfolioDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [item, setItem] = useState(null);
  const [related, setRelated] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  useEffect(() => {
    getPortfolioDetail(id)
      .then(data => {
        setItem(data.data);
        setRelated(data.related || []);
        setError('');
        setLoading(false);
      })
      .catch(err => {
        setError(err.message || 'Project not found.');
        setLoading(false);
      });
  }, [id]);

  if (loading) {
    return (
      <main style={{ textAlign: 'center', padding: '120px 20px', color: 'var(--muted)' }}>
        <i className="fas fa-spinner fa-spin" style={{ fontSize: '48px', marginBottom: '16px' }}></i>
        <p>Loading project...</p>
      </main>
    );
  }

  if (error || !item) {
    return (
      <main style={{ textAlign: 'center', padding: '120px 20px', color: 'var(--muted)' }}>
        <i className="fas fa-folder-open" style={{ fontSize: '80px', marginBottom: '24px', opacity: 0.3 }}></i>
        <h2>Project Not Found</h2>
        <p style={{ marginBottom: '24px' }}>{error || 'This project doesn\'t exist or is no longer available.'}</p>
        <button className="btn btn-primary-modern" onClick={() => navigate('/portfolio')}>
          <i className="fas fa-arrow-left"></i> Back to Portfolio
        </button>
      </main>
    );
  }

  const toolsList = item.tools_list || [];
  const deliverablesList = item.deliverables_list || [];
  const galleryImages = item.gallery_images || [];

  return (
    <main>
      {/* Hero */}
      <section className="cs-hero">
        <img
          src={item.image_url}
          alt={item.title}
          className="cs-hero-image"
        />
        <div className="cs-hero-overlay"></div>
        <div className="cs-hero-content" data-aos="fade-up">
          <nav className="cs-breadcrumb">
            <Link to="/portfolio">Portfolio</Link>
            <i className="fas fa-chevron-right"></i>
            <span>{item.category}</span>
          </nav>

          <div className="cs-category-badge">
            <i className={`fas ${getCategoryIcon(item.category)}`}></i>
            {item.category}
          </div>

          <h1>{item.title}</h1>

          <div className="cs-hero-meta">
            {item.client_name && (
              <div className="cs-meta-item">
                <span className="cs-meta-label">Client</span>
                <span className="cs-meta-value">{item.client_name}</span>
              </div>
            )}
            {item.role && (
              <div className="cs-meta-item">
                <span className="cs-meta-label">Role</span>
                <span className="cs-meta-value">{item.role}</span>
              </div>
            )}
            {item.timeline && (
              <div className="cs-meta-item">
                <span className="cs-meta-label">Timeline</span>
                <span className="cs-meta-value">{item.timeline}</span>
              </div>
            )}
            <div className="cs-meta-item">
              <span className="cs-meta-label">Category</span>
              <span className="cs-meta-value">{item.category}</span>
            </div>
          </div>
        </div>
      </section>

      {/* Body */}
      <div className="cs-body">
        <main className="cs-main">
          {/* Overview */}
          {item.description && (
            <div className="cs-section" data-aos="fade-up">
              <div className="cs-section-eyebrow">
                <div className="cs-section-icon"><i className="fas fa-eye"></i></div>
                <span className="cs-section-number">Overview</span>
              </div>
              <p className="cs-overview-text">{item.description}</p>
            </div>
          )}

          {/* Challenge */}
          {item.challenge && (
            <>
              <hr className="cs-divider" />
              <div className="cs-section" data-aos="fade-up">
                <div className="cs-section-eyebrow">
                  <div className="cs-section-icon"><i className="fas fa-exclamation-triangle"></i></div>
                  <span className="cs-section-number">01 — The Challenge</span>
                </div>
                <h2>What We Were Up Against</h2>
                <p>{item.challenge}</p>
              </div>
            </>
          )}

          {/* Solution */}
          {item.solution && (
            <>
              <hr className="cs-divider" />
              <div className="cs-section" data-aos="fade-up">
                <div className="cs-section-eyebrow">
                  <div className="cs-section-icon"><i className="fas fa-lightbulb"></i></div>
                  <span className="cs-section-number">02 — The Solution</span>
                </div>
                <h2>Our Approach</h2>
                <p>{item.solution}</p>
              </div>
            </>
          )}

          {/* Gallery */}
          {galleryImages.length > 0 && (
            <>
              <hr className="cs-divider" />
              <div className="cs-section" data-aos="fade-up">
                <div className="cs-section-eyebrow">
                  <div className="cs-section-icon"><i className="fas fa-images"></i></div>
                  <span className="cs-section-number">Project Gallery</span>
                </div>
                <h2>Visual Highlights</h2>
                <div className="cs-gallery">
                  {galleryImages.map((url, i) => (
                    url && (
                      <div className="cs-gallery-item" key={i}>
                        <img src={url.trim()} alt={`${item.title} gallery ${i + 1}`} loading="lazy" />
                      </div>
                    )
                  ))}
                </div>
              </div>
            </>
          )}

          {/* Results */}
          {item.results && (
            <>
              <hr className="cs-divider" />
              <div className="cs-section cs-results-block" data-aos="fade-up">
                <div className="cs-section-eyebrow">
                  <div className="cs-section-icon" style={{ background: 'rgba(255,255,255,0.15)' }}>
                    <i className="fas fa-chart-line"></i>
                  </div>
                  <span className="cs-section-number">03 — Results &amp; Impact</span>
                </div>
                <h2>What We Achieved</h2>
                <p>{item.results}</p>
              </div>
            </>
          )}

          {/* Live Project Link */}
          {item.project_url && item.project_url !== '#' && (
            <>
              <hr className="cs-divider" />
              <div data-aos="fade-up" style={{ textAlign: 'center' }}>
                <a
                  href={item.project_url}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="btn btn-primary-modern"
                >
                  View Live Project <i className="fas fa-external-link-alt"></i>
                </a>
              </div>
            </>
          )}
        </main>

        {/* Sidebar */}
        <aside className="cs-sidebar" data-aos="fade-left">
          <p className="cs-sidebar-title">Project Details</p>

          {item.client_name && (
            <div className="cs-sidebar-group">
              <p className="cs-sidebar-group-label">Client</p>
              <p className="cs-sidebar-group-value">{item.client_name}</p>
            </div>
          )}

          <div className="cs-sidebar-group">
            <p className="cs-sidebar-group-label">Category</p>
            <p className="cs-sidebar-group-value">{item.category}</p>
          </div>

          {item.role && (
            <div className="cs-sidebar-group">
              <p className="cs-sidebar-group-label">My Role</p>
              <p className="cs-sidebar-group-value">{item.role}</p>
            </div>
          )}

          {item.timeline && (
            <div className="cs-sidebar-group">
              <p className="cs-sidebar-group-label">Timeline</p>
              <p className="cs-sidebar-group-value">{item.timeline}</p>
            </div>
          )}

          {toolsList.length > 0 && (
            <div className="cs-sidebar-group">
              <p className="cs-sidebar-group-label">Tools Used</p>
              <ul className="cs-tag-list">
                {toolsList.map(tool => (
                  <li className="cs-tag" key={tool}>{tool}</li>
                ))}
              </ul>
            </div>
          )}

          {deliverablesList.length > 0 && (
            <div className="cs-sidebar-group">
              <p className="cs-sidebar-group-label">Deliverables</p>
              <ul className="cs-tag-list">
                {deliverablesList.map(d => (
                  <li className="cs-tag" key={d}>{d}</li>
                ))}
              </ul>
            </div>
          )}

          <div className="cs-sidebar-group" style={{ marginTop: '32px' }}>
            <Link
              to="/contact"
              className="btn btn-primary-modern"
              style={{ width: '100%', display: 'block', textAlign: 'center' }}
            >
              Start Your Project <i className="fas fa-arrow-right"></i>
            </Link>
          </div>

          <div className="cs-sidebar-group" style={{ marginTop: '12px' }}>
            <Link
              to="/portfolio"
              style={{ display: 'flex', alignItems: 'center', gap: '8px', fontSize: '14px', color: 'var(--text-muted,#777)', textDecoration: 'none', justifyContent: 'center' }}
            >
              <i className="fas fa-arrow-left"></i> Back to Portfolio
            </Link>
          </div>
        </aside>
      </div>

      {/* Related Projects */}
      {related.length > 0 && (
        <section className="cs-related">
          <div className="cs-related-inner">
            <div className="cs-related-header" data-aos="fade-up">
              <h2>More {item.category} Projects</h2>
              <p>Explore more work in this category</p>
            </div>
            <div className="cs-related-grid">
              {related.map(ri => (
                <Link to={`/portfolio/${ri.id}`} className="cs-related-card" key={ri.id} data-aos="fade-up">
                  <img
                    src={ri.image_url}
                    alt={ri.title}
                    className="cs-related-card-image"
                    loading="lazy"
                  />
                  <div className="cs-related-card-body">
                    <span className="cs-related-card-category">{ri.category}</span>
                    <h3 className="cs-related-card-title">{ri.title}</h3>
                    <p className="cs-related-card-desc">{ri.description}</p>
                  </div>
                </Link>
              ))}
            </div>
          </div>
        </section>
      )}

      {/* CTA */}
      <section className="cs-cta" data-aos="fade-up">
        <h2>Ready to Start Your Project?</h2>
        <p>Let&apos;s collaborate and create something exceptional together. Reach out — we&apos;d love to hear about your vision.</p>
        <Link
          to="/contact"
          className="btn btn-outline-modern btn-lg"
          style={{ color: '#fff', borderColor: 'rgba(255,255,255,0.5)' }}
        >
          Get in Touch <i className="fas fa-arrow-right"></i>
        </Link>
      </section>
    </main>
  );
}
