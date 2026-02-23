import ServiceDetailLayout from './ServiceDetailLayout';

const HERO = {
  title: 'Branding & Creative Design',
  desc: 'Logo design, brand identity systems, and marketing visuals that strengthen brand recognition and consistency. We create cohesive visual languages that tell your story and resonate with your audience across every touchpoint.',
  img: '/assets/about-2.png',
  badgeIcon: '★',
  badgeText: 'Award Winning',
  ctaText: 'Explore Our Process',
};

const EXCELLENCE = {
  heading: 'Brands That Stand Out & Stay Memorable',
  body: "We don't just design logos—we craft complete brand ecosystems. From initial concept to final execution, we develop strategic visual identities that capture attention, build trust, and create lasting impressions. Every color, typeface, and design element is chosen with purpose to reflect your brand's personality and values.",
  img: '/assets/service.jpg',
  stats: [
    { num: '200+', label: 'Brands Created' },
    { num: '15+', label: 'Awards Won' },
  ],
};

const PROCESS = [
  {
    icon: 'fa-compass',
    title: '1. Discovery & Strategy',
    desc: "We dive deep into your brand's mission, values, target audience, and competitive landscape.",
    features: ['Brand workshops & interviews', 'Market research & analysis', 'Brand positioning strategy'],
  },
  {
    icon: 'fa-palette',
    title: '2. Concept Development',
    desc: 'We explore multiple creative directions and present concepts that align with your vision.',
    features: ['Logo explorations (3-5 concepts)', 'Color palette development', 'Typography selection'],
  },
  {
    icon: 'fa-star',
    title: '3. Refinement & Delivery',
    desc: 'We polish your chosen direction and deliver a complete brand identity system.',
    features: ['Final logo refinements', 'Brand style guide creation', 'Asset package delivery'],
  },
];

const DELIVERABLES = [
  {
    icon: 'fa-bookmark',
    title: 'Logo Package',
    items: ['Primary logo (full color)', 'Secondary logo variations', 'Monochrome versions', 'Favicon & social media icons', 'All file formats (AI, EPS, PNG, SVG, PDF)'],
  },
  {
    icon: 'fa-book',
    title: 'Brand Style Guide',
    items: ['Logo usage guidelines', 'Color palette with codes', 'Typography system', 'Spacing & layout rules', "Do's and don'ts"],
  },
  {
    icon: 'fa-images',
    title: 'Marketing Materials',
    items: ['Business card designs', 'Letterhead templates', 'Email signature design', 'Social media templates', 'Presentation deck template'],
  },
];

const BRANDING_SERVICES = [
  { icon: 'fa-flag', title: 'Logo Design & Identity', desc: 'Distinctive logos and visual marks that become the face of your brand. We create memorable symbols that work across all applications and stand the test of time.' },
  { icon: 'fa-swatchbook', title: 'Brand Identity Systems', desc: 'Complete visual languages including color palettes, typography, patterns, and graphic elements that ensure consistency across every brand touchpoint.' },
  { icon: 'fa-bullhorn', title: 'Marketing Collateral', desc: "Print and digital marketing materials that amplify your brand message—from brochures and packaging to social media graphics and advertising campaigns." },
  { icon: 'fa-sync-alt', title: 'Brand Refresh & Redesign', desc: 'Modernize outdated brands while preserving equity and recognition. We evolve your visual identity to stay relevant without losing what makes you unique.' },
];

const SPECIALTIES = [
  { icon: 'fa-building', title: 'Corporate Branding', desc: 'Professional identities for B2B companies, startups, and enterprises that command authority and trust.' },
  { icon: 'fa-store', title: 'Retail & E-Commerce', desc: 'Appealing brands for retail businesses and online stores that attract customers and drive sales.' },
  { icon: 'fa-utensils', title: 'Food & Beverage', desc: 'Appetizing brands for restaurants, cafes, and food products that make mouths water and create cravings.' },
  { icon: 'fa-heartbeat', title: 'Health & Wellness', desc: 'Trustworthy brands for healthcare, fitness, and wellness that communicate care and expertise.' },
  { icon: 'fa-rocket', title: 'Tech & Innovation', desc: 'Forward-thinking brands for technology companies and apps that showcase innovation and creativity.' },
  { icon: 'fa-graduation-cap', title: 'Education & Non-Profit', desc: 'Inspiring brands for educational institutions and causes that drive engagement and support.' },
];

const FAQS = [
  { q: "What's included in a complete brand identity package?", a: "Our complete package includes: primary and secondary logo designs, color palette, typography system, brand style guide, business card design, letterhead, email signature, social media templates, and all source files in multiple formats. You'll have everything needed to maintain consistent branding." },
  { q: 'How long does the branding process take?', a: 'A typical brand identity project takes 4-6 weeks from kickoff to final delivery. This includes discovery (1 week), concept development (2 weeks), refinement (1-2 weeks), and final production (1 week). Rush timelines are available for an additional fee.' },
  { q: 'How many logo concepts will I see?', a: 'We present 3-5 distinct logo concepts in the initial round, each exploring different creative directions. After you select your preferred concept, we refine it through 2-3 revision rounds until it\'s perfect. This focused approach ensures quality over quantity.' },
  { q: 'Do you help with trademark registration?', a: "While we don't handle legal registration directly, we provide preliminary trademark searches and can recommend intellectual property attorneys. We design with trademark considerations in mind to maximize your chances of successful registration." },
  { q: 'Can you refresh my existing brand instead of starting from scratch?', a: "Absolutely! Brand refreshes are perfect when you have existing equity but need modernization. We'll evaluate your current brand, identify what works, and evolve the elements that need updating while maintaining brand recognition and loyalty." },
];

const TESTIMONIALS = [
  { initials: 'RS', text: 'Our rebrand completely transformed how clients perceive us. The new identity is professional, memorable, and perfectly captures our brand values.', name: 'Rebecca Santos', role: 'Founder | Consulting Firm' },
  { initials: 'TM', text: "They created a brand identity that we're incredibly proud of. From logo to style guide, everything is cohesive and exactly on-point. Highly recommend!", name: 'Thomas Mitchell', role: 'CMO | Retail Brand' },
  { initials: 'KP', text: 'The branding work they did for our restaurant was outstanding. Our customers constantly compliment our look and feel, and our social media engagement has doubled.', name: 'Karen Park', role: 'Owner | Restaurant Group' },
];

const RECENT_BRANDS = [
  { img: '/assets/hero.png', category: 'Tech Startup', title: 'Quantum Labs Identity', desc: 'Complete rebrand for AI research company' },
  { img: '/assets/about-2.png', category: 'Food & Beverage', title: 'Urban Bistro Concept', desc: 'Fresh identity for farm-to-table restaurant' },
  { img: '/assets/service.jpg', category: 'Health & Wellness', title: 'Zenith Fitness Studio', desc: 'Modern brand for boutique gym chain' },
];

export default function Branding() {
  return (
    <ServiceDetailLayout
      hero={HERO}
      excellence={EXCELLENCE}
      process={PROCESS}
      tools={[]}
      faqs={FAQS}
      testimonials={TESTIMONIALS}
    >
      {/* What You'll Receive */}
      <section className="deliverables-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">What You&apos;ll Receive</h2>
          <p className="section-subtitle">Comprehensive brand assets ready for immediate use</p>
        </div>
        <div className="deliverables-grid">
          {DELIVERABLES.map((d, i) => (
            <div className="deliverable-card" key={d.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="deliverable-icon"><i className={`fas ${d.icon}`}></i></div>
              <h3>{d.title}</h3>
              <ul>{d.items.map(item => <li key={item}>{item}</li>)}</ul>
            </div>
          ))}
        </div>
      </section>

      {/* Our Branding Services */}
      <section className="superpowers-section">
        <div className="superpowers-container">
          <div className="superpowers-image" data-aos="fade-right">
            <img src="/assets/hero.png" alt="Brand design services" />
          </div>
          <div className="superpowers-content" data-aos="fade-left">
            <h2 className="section-title-modern">Our Branding Services</h2>
            {BRANDING_SERVICES.map(item => (
              <div className="superpower-item" key={item.title}>
                <h3><i className={`fas ${item.icon}`}></i> {item.title}</h3>
                <p>{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Design Specialties */}
      <section className="tech-stack-section">
        <div className="tech-stack-section-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">Design Specialties</h2>
            <p className="section-subtitle">Areas where we excel in creating exceptional brand experiences</p>
          </div>
          <div className="specialties-grid">
            {SPECIALTIES.map((s, i) => (
              <div className="specialty-card" key={s.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
                <div className="specialty-icon"><i className={`fas ${s.icon}`}></i></div>
                <h3>{s.title}</h3>
                <p>{s.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Recent Branding Projects */}
      <section className="project-showcase-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Recent Branding Projects</h2>
          <p className="section-subtitle">Brands we&apos;ve helped bring to life</p>
        </div>
        <div className="project-showcase-grid">
          {RECENT_BRANDS.map((project, i) => (
            <div className="project-showcase-card" key={i} data-aos="zoom-in" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="project-image">
                <img src={project.img} alt={project.title} />
                <div className="project-overlay">
                  <a href="/portfolio" className="btn btn-white-sm">View Case Study</a>
                </div>
              </div>
              <div className="project-info">
                <span className="project-category">{project.category}</span>
                <h3>{project.title}</h3>
                <p>{project.desc}</p>
              </div>
            </div>
          ))}
        </div>
      </section>
    </ServiceDetailLayout>
  );
}
