import { useState, useEffect, useRef, useCallback } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { getPortfolio } from '../api/index.js';
import '../styles/portfolio.css';

function getCategoryIcon(cat) {
  if (!cat) return 'fa-folder';
  const c = cat.toLowerCase();
  if (c.includes('web')) return 'fa-laptop-code';
  if (c.includes('brand')) return 'fa-palette';
  if (c.includes('video')) return 'fa-video';
  if (c.includes('content')) return 'fa-images';
  return 'fa-folder';
}

export default function Portfolio() {
  const [allItems, setAllItems] = useState([]);
  const [categories, setCategories] = useState([]);
  const [activeCategory, setActiveCategory] = useState('all');
  const [loading, setLoading] = useState(true);
  const [currentSlide, setCurrentSlide] = useState(0);
  const intervalRef = useRef(null);
  const navigate = useNavigate();

  useEffect(() => {
    getPortfolio()
      .then(data => {
        setAllItems(data.data || []);
        setCategories(data.categories || []);
      })
      .catch(() => {})
      .finally(() => setLoading(false));
  }, []);

  const featuredItems = allItems.filter(item => item.is_featured);
  const filteredItems = activeCategory === 'all'
    ? allItems
    : allItems.filter(item => item.category?.toLowerCase() === activeCategory.toLowerCase());

  const totalSlides = featuredItems.length;

  const goToSlide = useCallback((idx) => {
    setCurrentSlide(((idx % totalSlides) + totalSlides) % totalSlides);
  }, [totalSlides]);

  // Auto-advance carousel
  useEffect(() => {
    if (totalSlides < 2) return;
    intervalRef.current = setInterval(() => {
      setCurrentSlide(prev => (prev + 1) % totalSlides);
    }, 5000);
    return () => clearInterval(intervalRef.current);
  }, [totalSlides]);

  if (loading) {
    return (
      <main style={{ textAlign: 'center', padding: '120px 20px', color: 'var(--muted)' }}>
        <i className="fas fa-spinner fa-spin" style={{ fontSize: '48px', marginBottom: '16px' }}></i>
        <p>Loading portfolio...</p>
      </main>
    );
  }

  return (
    <main>
      {/* Portfolio Hero */}
      <section className="portfolio-hero">
        <div className="portfolio-hero-content" data-aos="fade-up">
          <h1>Our Portfolio</h1>
          <p>Discover our creative journey through a collection of carefully crafted projects</p>
        </div>

        <div className="portfolio-stats" data-aos="fade-up" data-aos-delay="200">
          <div className="stat-item">
            <span className="stat-number">{allItems.length}</span>
            <span className="stat-label">Projects Completed</span>
          </div>
          <div className="stat-item">
            <span className="stat-number">98%</span>
            <span className="stat-label">Client Satisfaction</span>
          </div>
          <div className="stat-item">
            <span className="stat-number">{allItems.length}</span>
            <span className="stat-label">Happy Clients</span>
          </div>
        </div>
      </section>

      {/* Featured Carousel */}
      {featuredItems.length > 0 && (
        <section className="featured-carousel-section">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">Featured Projects</h2>
            <p className="section-subtitle">Our best work showcased</p>
          </div>

          <div className="featured-carousel" data-aos="zoom-in" data-aos-delay="200">
            <div className="carousel-container">
              {totalSlides > 1 && (
                <button
                  className="carousel-btn prev-btn"
                  onClick={() => goToSlide(currentSlide - 1)}
                  aria-label="Previous"
                >
                  <i className="fas fa-chevron-left"></i>
                </button>
              )}

              <div className="carousel-track-container">
                <div
                  className="carousel-track"
                  style={{ transform: `translateX(-${currentSlide * 100}%)` }}
                >
                  {featuredItems.map(item => (
                    <div className="carousel-slide" key={item.id}>
                      <div className="carousel-image">
                        <img src={item.image_url} alt={item.title} />
                        <div className="carousel-overlay">
                          <span className="carousel-category">{item.category}</span>
                          <h3>{item.title}</h3>
                          <p>{item.description}</p>
                          <Link
                            to={`/portfolio/${item.id}`}
                            className="carousel-link"
                          >
                            View Case Study <i className="fas fa-arrow-right"></i>
                          </Link>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {totalSlides > 1 && (
                <button
                  className="carousel-btn next-btn"
                  onClick={() => goToSlide(currentSlide + 1)}
                  aria-label="Next"
                >
                  <i className="fas fa-chevron-right"></i>
                </button>
              )}
            </div>

            {totalSlides > 1 && (
              <div className="carousel-indicators">
                {featuredItems.map((_, idx) => (
                  <button
                    key={idx}
                    className={`indicator${idx === currentSlide ? ' active' : ''}`}
                    onClick={() => goToSlide(idx)}
                    aria-label={`Go to slide ${idx + 1}`}
                  />
                ))}
              </div>
            )}
          </div>
        </section>
      )}

      {/* Category Filters */}
      <section className="portfolio-filters-section">
        <div className="filter-tabs" data-aos="fade-up">
          <button
            className={`filter-tab${activeCategory === 'all' ? ' active' : ''}`}
            onClick={() => setActiveCategory('all')}
          >
            <i className="fas fa-th"></i> All Projects
          </button>
          {categories.map(cat => (
            <button
              key={cat}
              className={`filter-tab${activeCategory === cat ? ' active' : ''}`}
              onClick={() => setActiveCategory(cat)}
            >
              <i className={`fas ${getCategoryIcon(cat)}`}></i> {cat}
            </button>
          ))}
        </div>
      </section>

      {/* Portfolio Grid */}
      <section className="portfolio-section">
        {filteredItems.length > 0 ? (
          <>
            <div className="portfolio-count" data-aos="fade-up">
              <span className="count-number">{filteredItems.length}</span>
              {' '}project{filteredItems.length !== 1 ? 's' : ''}
              {activeCategory !== 'all' ? ` in ${activeCategory}` : ''}
            </div>

            <div className="portfolio-grid-masonry">
              {filteredItems.map((item, index) => (
                <div
                  className="portfolio-card"
                  key={item.id}
                  data-aos="fade-up"
                  data-aos-delay={`${(index % 6) * 50}`}
                >
                  <div className="portfolio-card-image">
                    <img src={item.image_url} alt={item.title} loading="lazy" />
                    <div className="portfolio-card-overlay">
                      <div className="overlay-content">
                        <span className="portfolio-badge">{item.category}</span>
                        <h3>{item.title}</h3>
                        <p>{item.description}</p>
                        <Link to={`/portfolio/${item.id}`} className="portfolio-btn">
                          <span>View Case Study</span>
                          <i className="fas fa-arrow-right"></i>
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </>
        ) : (
          <div className="empty-state" data-aos="fade-up">
            <i className="fas fa-folder-open"></i>
            <h3>No projects found</h3>
            <p>
              {activeCategory !== 'all' ? (
                <>No projects in this category yet. <button className="btn-link" onClick={() => setActiveCategory('all')}>View all projects</button></>
              ) : (
                'Check back soon for new projects!'
              )}
            </p>
          </div>
        )}
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
    </main>
  );
}
