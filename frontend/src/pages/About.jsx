import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import '../styles/about.css';
import about from '../assets/hero.png';
import about1 from '../assets/about-2.png';


const MUSTARD_VALUES = [
  { letter: 'M', title: 'Mission Driven Service', desc: 'We serve with purpose, excellence, and intentionality, seeing our work as both professional service and meaningful impact.' },
  { letter: 'U', title: 'Unity in Team and Purpose', desc: 'We cultivate collaboration, encouragement, and shared vision, building strong relationships within the team and with clients.' },
  { letter: 'S', title: 'Stewardship and Integrity', desc: 'We handle time, talent, resources, and client trust responsibly, honoring God through honesty, accountability, and excellence.' },
  { letter: 'T', title: 'Transformational Growth', desc: 'We commit to continuous growth professionally, personally, and spiritually, developing leaders who positively influence others.' },
  { letter: 'A', title: 'Authenticity and Humility', desc: 'We work with sincerity, teachability, and humility, valuing character as much as competence.' },
  { letter: 'R', title: 'Reliability and Excellence', desc: 'We deliver consistent quality, dependable service, and professional results that clients can trust.' },
  { letter: 'D', title: 'Discipleship Through Work', desc: 'We see every project as an opportunity to model servant leadership, mentor others, and reflect values worth passing on.' },
];

const TEAM = [
  { name: 'Alex Chen', role: 'Co-Founder', img: '/assets/hero.png' },
  { name: 'Jordan Bennett', role: 'Creative Director', img: '/assets/about-2.png' },
  { name: 'Taylor Morgan', role: 'Head of User Strategy', img: '/assets/service.jpg' },
];

const CORE_VALUES = [
  { icon: 'fa-lightbulb', title: 'Innovation First', desc: 'We don\'t follow trends—we set them. Every project is an opportunity to push boundaries and explore new possibilities.' },
  { icon: 'fa-users', title: 'Client Partnership', desc: 'Your success is our success. We work alongside you as true partners, not just service providers.' },
  { icon: 'fa-gem', title: 'Pixel Perfection', desc: 'Details matter. We obsess over every pixel, interaction, and animation to deliver exceptional experiences.' },
  { icon: 'fa-bolt', title: 'Speed & Quality', desc: 'Fast delivery without compromising quality. We use modern tools and workflows to deliver results quickly.' },
];

export default function About() {
  const navigate = useNavigate();
  useEffect(() => { document.title = 'About | MUSTARD Digitals'; }, []);

  return (
    <main>
      {/* Hero */}
      <section className="about-hero">
        <div className="about-hero-content" data-aos="fade-up">
          <h1 className="about-hero-title">
            We Design &amp; Build Digital Experiences That Move the Needle
          </h1>
        </div>

        <div className="about-hero-images">
          <div className="hero-image-card card-1" data-aos="fade-right" data-aos-delay="200">
            <img src={about} alt="Team collaboration" />
          </div>
          <div className="hero-image-card card-2" data-aos="fade-left" data-aos-delay="400">
            <img src={about1} alt="Creative workspace" />
          </div>
          <div className="hero-accent-icon" data-aos="zoom-in" data-aos-delay="600">
            <i className="fas fa-asterisk"></i>
          </div>
        </div>

        <div className="about-hero-description" data-aos="fade-up" data-aos-delay="300">
          <p>
            We&apos;re not your average design shop. We&apos;re a strategic creative partner that turns your
            engaging narratives with curated technology. Since 2019, we&apos;ve helped turn bold ideas into
            real results—websites that convert, apps that delight, and brands that stand out and connect.
          </p>
          <a href="#story" className="btn btn-primary-modern">
            Our Process <i className="fas fa-arrow-down"></i>
          </a>
        </div>
      </section>

      {/* How We Work */}
      <section id="story" className="how-we-work-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">How We Work: Painless. Proven. Pixel-Perfect</h2>
        </div>

        <div className="work-process-grid">
          {[
            { icon: 'fa-search', title: 'Discover', desc: 'We dive deep into your goals, audience, and market. Research is core to solving problems.', delay: 100 },
            { icon: 'fa-pencil-ruler', title: 'Design & Build', desc: 'We blend data with fresh, clean, champagne UX to deliver a brand people love.', delay: 200 },
            { icon: 'fa-rocket', title: 'Launch & Grow', desc: 'We don\'t just deliver—we optimize for long-term success.', delay: 300 },
          ].map(step => (
            <div className="work-process-card" key={step.title} data-aos="fade-up" data-aos-delay={step.delay}>
              <div className="process-icon">
                <div className="icon-circle">
                  <i className={`fas ${step.icon}`}></i>
                </div>
              </div>
              <h3>{step.title}</h3>
              <p>{step.desc}</p>
            </div>
          ))}
        </div>
      </section>

      {/* MUSTARD Core Values */}
      <section className="awards-section">
        <div className="awards-section-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">MUSTARD Core Values</h2>
            <p className="section-subtitle">The principles behind every decision, every project, every person</p>
          </div>

          <div className="awards-container">
            <div className="mustard-container">
              {['M','U','S','T','A','R','D'].map(l => <span key={l}>{l}</span>)}
            </div>

            <div className="awards-list" data-aos="fade-left">
              {MUSTARD_VALUES.map((v, i) => (
                <div className="award-item" key={v.letter} data-aos="fade-up" data-aos-delay={`${100 + i * 50}`}>
                  <div className="award-info">
                    <h3>{v.title}</h3>
                    <p>{v.desc}</p>
                  </div>
                  <div className="mustard-letter">{v.letter}</div>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Our Story */}
      <section className="our-story-section">
        <div className="story-container">
          <div className="story-image" data-aos="fade-right">
            <img src="/assets/about-2.png" alt="Our team at work" />
            <div className="story-badge">
              <span className="badge-number">5+</span>
              <span className="badge-text">Years of Excellence</span>
            </div>
          </div>

          <div className="story-content" data-aos="fade-left">
            <h2 className="section-title-modern">
              From Garage Dreams to Pixel-Perfect Reality
            </h2>
            <p className="story-intro">
              We didn&apos;t start Web Rocket to follow design trends—we started it to leave them up
              in the dust. Two Creators | defined by a hunger to break norms and an itch for
              creating brands that don&apos;t just look good—they work harder.
            </p>
            <p className="story-text">
              Today, we&apos;re a squad of 15 designers, developers, and no-code wizards who still
              operate like a startup.
            </p>

            <div className="story-highlights">
              {[
                'Turning complex problems into creative milestones',
                'Building brands and designs momentum',
                'Pushing no-code tools to their absolute limits',
              ].map(item => (
                <div className="highlight-item" key={item}>
                  <i className="fas fa-check-circle"></i>
                  <span>{item}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Team */}
      <section className="team-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">The Brains Behind Rocket</h2>
          <p className="section-subtitle">Meet the talented individuals who bring your vision to life</p>
        </div>

        <div className="team-grid">
          {TEAM.map((member, i) => (
            <div className="team-member" key={member.name} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="member-image">
                <img src={member.img} alt={member.name} />
                <div className="member-overlay">
                  <div className="member-social">
                    <a href="#"><i className="fab fa-linkedin"></i></a>
                    <a href="#"><i className="fab fa-twitter"></i></a>
                    <a href="#"><i className="fab fa-dribbble"></i></a>
                  </div>
                </div>
              </div>
              <div className="member-info">
                <h3>{member.name}</h3>
                <p>{member.role}</p>
              </div>
            </div>
          ))}
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

      {/* Values */}
      <section className="values-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">What Drives Us</h2>
          <p className="section-subtitle">Core values that shape everything we do</p>
        </div>

        <div className="values-grid">
          {CORE_VALUES.map((v, i) => (
            <div className="value-card" key={v.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="value-icon">
                <i className={`fas ${v.icon}`}></i>
              </div>
              <h3>{v.title}</h3>
              <p>{v.desc}</p>
            </div>
          ))}
        </div>
      </section>
    </main>
  );
}
