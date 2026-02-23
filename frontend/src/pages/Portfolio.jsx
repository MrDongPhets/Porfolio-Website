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

// Renders a single card slot with a sliding image transition
function PeekCard({ currentSrc, currentAlt, prevSrc, prevAlt, direction, isAnimating, className, shade, children, onClick }) {
  return (
    <div className={`peek-card ${className}`} onClick={onClick}>
      {/* Outgoing image slides out */}
      {isAnimating && prevSrc && (
        <img
          key={`out-${prevSrc}`}
          src={prevSrc}
          alt={prevAlt}
          className={`peek-img peek-img--out peek-img--out-${direction}`}
        />
      )}
      {/* Incoming image slides in */}
      <img
        key={`in-${currentSrc}`}
        src={currentSrc}
        alt={currentAlt}
        className={`peek-img peek-img--in peek-img--in-${direction} ${isAnimating ? 'peek-img--animating' : ''}`}
      />
      {shade && <div className="peek-card-shade" />}
      {children}
    </div>
  );
}

export default function Portfolio() {
  useEffect(() => { document.title = 'Portfolio | MUSTARD Digitals'; }, []);
  const [allItems, setAllItems] = useState([]);
  const [categories, setCategories] = useState([]);
  const [activeCategory, setActiveCategory] = useState('all');
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [currentSlide, setCurrentSlide] = useState(0);
  const [prevSlide, setPrevSlide] = useState(null);
  const [direction, setDirection] = useState('next'); // 'next' | 'prev'
  const [isAnimating, setIsAnimating] = useState(false);
  const intervalRef = useRef(null);
  const navigate = useNavigate();

  useEffect(() => {
    getPortfolio()
      .then(data => {
        setAllItems(data.data || []);
        setCategories(data.categories || []);
      })
      .catch(() => setError('Failed to load portfolio. Please try again later.'))
      .finally(() => setLoading(false));
  }, []);

  const featuredItems = allItems.filter(item => item.is_featured);
  const filteredItems = activeCategory === 'all'
    ? allItems
    : allItems.filter(item => item.category?.toLowerCase() === activeCategory.toLowerCase());

  const totalSlides = featuredItems.length;

  const goToSlide = useCallback((idx, dir) => {
    if (isAnimating || totalSlides < 2) return;
    const next = ((idx % totalSlides) + totalSlides) % totalSlides;
    if (next === currentSlide) return;

    setPrevSlide(currentSlide);
    setDirection(dir || 'next');
    setCurrentSlide(next);
    setIsAnimating(true);
    setTimeout(() => {
      setIsAnimating(false);
      setPrevSlide(null);
    }, 500);
  }, [isAnimating, totalSlides, currentSlide]);

  const resetAndGoTo = useCallback((idx, dir) => {
    clearInterval(intervalRef.current);
    goToSlide(idx, dir);
    if (totalSlides >= 2) {
      intervalRef.current = setInterval(() => {
        setCurrentSlide(prev => {
          const next = (prev + 1) % totalSlides;
          setPrevSlide(prev);
          setDirection('next');
          setIsAnimating(true);
          setTimeout(() => { setIsAnimating(false); setPrevSlide(null); }, 500);
          return next;
        });
      }, 4000);
    }
  }, [goToSlide, totalSlides]);

  // Auto-advance
  useEffect(() => {
    if (totalSlides < 2) return;
    intervalRef.current = setInterval(() => {
      setCurrentSlide(prev => {
        const next = (prev + 1) % totalSlides;
        setPrevSlide(prev);
        setDirection('next');
        setIsAnimating(true);
        setTimeout(() => { setIsAnimating(false); setPrevSlide(null); }, 500);
        return next;
      });
    }, 4000);
    return () => clearInterval(intervalRef.current);
  }, [totalSlides]);

  const getIdx = useCallback((offset) =>
    ((currentSlide + offset) % totalSlides + totalSlides) % totalSlides,
    [currentSlide, totalSlides]
  );
  const getPrevIdx = useCallback((offset) =>
    prevSlide !== null ? ((prevSlide + offset) % totalSlides + totalSlides) % totalSlides : null,
    [prevSlide, totalSlides]
  );

  if (loading) {
    return (
      <main style={{ textAlign: 'center', padding: '120px 20px', color: 'var(--muted)' }}>
        <i className="fas fa-spinner fa-spin" style={{ fontSize: '48px', marginBottom: '16px' }}></i>
        <p>Loading portfolio...</p>
      </main>
    );
  }

  if (error) {
    return (
      <main style={{ textAlign: 'center', padding: '120px 20px', color: 'var(--muted)' }}>
        <i className="fas fa-exclamation-triangle" style={{ fontSize: '48px', marginBottom: '16px', color: 'var(--accent)' }}></i>
        <h2>Something went wrong</h2>
        <p style={{ marginBottom: '24px' }}>{error}</p>
        <button className="btn btn-primary-modern" onClick={() => window.location.reload()}>
          Try Again
        </button>
      </main>
    );
  }

  const centerItem = featuredItems[currentSlide];
  const leftItem   = featuredItems[getIdx(-1)];
  const rightItem  = featuredItems[getIdx(1)];

  const prevCenterItem = prevSlide !== null ? featuredItems[prevSlide] : null;
  const prevLeftItem   = prevSlide !== null ? featuredItems[getPrevIdx(-1)] : null;
  const prevRightItem  = prevSlide !== null ? featuredItems[getPrevIdx(1)] : null;

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

          <div className="peek-carousel-wrapper" data-aos="fade-up" data-aos-delay="200">

            {totalSlides > 1 && (
              <button
                className="peek-btn peek-btn--prev"
                onClick={() => resetAndGoTo(currentSlide - 1, 'prev')}
                aria-label="Previous"
              >
                <i className="fas fa-chevron-left"></i>
              </button>
            )}

            <div className="peek-stage">

              {/* Left side card */}
              {totalSlides > 1 && (
                <PeekCard
                  currentSrc={leftItem.image_url}
                  currentAlt={leftItem.title}
                  prevSrc={prevLeftItem?.image_url}
                  prevAlt={prevLeftItem?.title}
                  direction={direction}
                  isAnimating={isAnimating}
                  className="peek-card--side peek-card--left"
                  shade={true}
                  onClick={() => resetAndGoTo(currentSlide - 1, 'prev')}
                />
              )}

              {/* Center card */}
              <PeekCard
                currentSrc={centerItem.image_url}
                currentAlt={centerItem.title}
                prevSrc={prevCenterItem?.image_url}
                prevAlt={prevCenterItem?.title}
                direction={direction}
                isAnimating={isAnimating}
                className="peek-card--center"
                shade={false}
              >
                <div className="peek-card-overlay">
                  <span className="peek-badge">{centerItem.category}</span>
                  <h3>{centerItem.title}</h3>
                  <p>{centerItem.description}</p>
                  <Link to={`/portfolio/${centerItem.id}`} className="peek-link">
                    View Case Study <i className="fas fa-arrow-right"></i>
                  </Link>
                </div>
              </PeekCard>

              {/* Right side card */}
              {totalSlides > 1 && (
                <PeekCard
                  currentSrc={rightItem.image_url}
                  currentAlt={rightItem.title}
                  prevSrc={prevRightItem?.image_url}
                  prevAlt={prevRightItem?.title}
                  direction={direction}
                  isAnimating={isAnimating}
                  className="peek-card--side peek-card--right"
                  shade={true}
                  onClick={() => resetAndGoTo(currentSlide + 1, 'next')}
                />
              )}
            </div>

            {totalSlides > 1 && (
              <button
                className="peek-btn peek-btn--next"
                onClick={() => resetAndGoTo(currentSlide + 1, 'next')}
                aria-label="Next"
              >
                <i className="fas fa-chevron-right"></i>
              </button>
            )}

            {totalSlides > 1 && (
              <div className="carousel-indicators">
                {featuredItems.map((_, idx) => (
                  <button
                    key={idx}
                    className={`indicator${idx === currentSlide ? ' active' : ''}`}
                    onClick={() => resetAndGoTo(idx, idx > currentSlide ? 'next' : 'prev')}
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
                <>No projects in this category yet.{' '}
                  <button className="btn-link" onClick={() => setActiveCategory('all')}>
                    View all projects
                  </button>
                </>
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