import ServiceDetailLayout from './ServiceDetailLayout';

const HERO = {
  title: 'Web Design & Development',
  desc: "We craft user experiences that drive action. We put optimization, whether it's a conversion-focused post-checkout or a mobile app that users genuinely love — from aesthetic polish to flawless functionality and perfect execution.",
  img: '/assets/hero.png',
  badgeIcon: '✓',
  badgeText: 'Pixel Perfect',
  ctaText: 'See How We Work',
};

const EXCELLENCE = {
  heading: 'Design That Works as Hard as You Do',
  body: "We craft user-centric experiences that blend aesthetics with functionality, turning complex workflows into intuitive experiences. Through prototyping and usability testing, we design digital products that reduce friction, boost engagement, and drive conversions—whether it's a bold dashboard, mobile app, or a commerce platform.",
  img: '/assets/about-2.png',
  stats: [
    { num: '150+', label: 'Projects Delivered' },
    { num: '98%', label: 'Client Satisfaction' },
  ],
};

const PROCESS = [
  {
    icon: 'fa-search',
    title: '1. Research & Define',
    desc: 'We start by knowing your business — its ambitions & challenges.',
    features: ['User research & personas', 'Competitor analysis', 'Goals & KPIs definition'],
  },
  {
    icon: 'fa-lightbulb',
    title: '2. Ideate & Prototype',
    desc: 'Transforming insights into tangible designs — Accelerate your growth.',
    features: ['Wireframing & flow mapping', 'Interactive prototypes', 'Design system creation'],
  },
  {
    icon: 'fa-check-circle',
    title: '3. Refine & Validate',
    desc: 'Perfecting every pixel with real user feedback & user reviews.',
    features: ['Usability testing', 'A/B testing & optimization', 'Final polish & delivery'],
  },
];

const SUPERPOWERS = [
  { icon: 'fa-brain', title: 'Psychology-Driven Design', desc: 'We apply proven principles and behavioral science to create designs that guide users intuitively through their journey and drive better outcomes.' },
  { icon: 'fa-users', title: 'Real-User Testing', desc: 'We validate every prototype with 5-10 real users from target audience, uncovering actionable insights before a single line of code is written.' },
  { icon: 'fa-code', title: 'Dev-Ready Handoffs', desc: 'Developers receive clean, pixel-perfect Figma files complete with auto-generated specs, assets, and documentation.' },
];

const PROJECTS = [
  { img: '/assets/hero.png', category: 'E-Commerce', title: 'Fashion Retail Platform', desc: 'Complete redesign increased conversion by 156%' },
  { img: '/assets/about-2.png', category: 'SaaS Dashboard', title: 'Analytics Platform', desc: 'User engagement up 89% after UX overhaul' },
  { img: '/assets/service.jpg', category: 'Corporate Website', title: 'Tech Company Rebrand', desc: 'Modern design boosted lead generation by 230%' },
];

const TOOLS = [
  { label: 'Design Tools', icon: 'fa-paint-brush', badges: ['Figma', 'Adobe XD', 'Sketch', 'InVision'] },
  { label: 'Frontend', icon: 'fa-code', badges: ['React', 'Vue.js', 'Next.js', 'TypeScript'] },
  { label: 'Backend', icon: 'fa-server', badges: ['Node.js', 'PHP', 'Python', 'Laravel'] },
  { label: 'Database', icon: 'fa-database', badges: ['PostgreSQL', 'MongoDB', 'MySQL', 'Supabase'] },
];

const FAQS = [
  { q: 'How many revisions are included?', a: "We include unlimited revisions during the design phase to ensure you're completely satisfied. Once development begins, we include 2 rounds of revisions. Additional changes can be accommodated based on scope." },
  { q: 'What are your charges?', a: 'Our pricing is project-based and varies depending on complexity, features, and timeline. A typical website starts at $5,000, while complex web applications start at $15,000. We provide detailed quotes after understanding your requirements.' },
  { q: 'What is your MVP process?', a: 'We follow a lean approach: 1) Define core features, 2) Create rapid prototypes, 3) Build MVP in 4-8 weeks, 4) Launch and gather user feedback, 5) Iterate based on real data. This gets your product to market quickly while minimizing risk.' },
  { q: 'Do you provide ongoing support?', a: "Yes! We offer maintenance packages starting at $500/month including hosting, updates, security patches, and technical support. We're here to ensure your website continues to perform optimally." },
  { q: 'How long does a typical project take?', a: 'Timeline varies by scope: Simple websites (4-6 weeks), Complex websites (8-12 weeks), Web applications (12-16 weeks). We provide a detailed timeline during project kickoff and keep you updated throughout.' },
];

const TESTIMONIALS = [
  { initials: 'MC', text: 'They redesigned our e-commerce site and we saw a 200% increase in conversions within 3 months. The attention to detail and UX expertise is unmatched.', name: 'Marcus Chen', role: 'CEO | FashionTech' },
  { initials: 'AL', text: "Best web design team I've worked with. They took our outdated site and transformed it into a modern, high-performing platform that our customers love.", name: 'Amanda Lee', role: 'Marketing Director | SaaS Company' },
  { initials: 'JP', text: 'They delivered our app MVP in 6 weeks and it was pixel-perfect. The dev-ready handoffs saved our development team countless hours.', name: 'Jordan Park', role: 'Founder | Tech Startup' },
];

export default function WebDesign() {
  return (
    <ServiceDetailLayout
      hero={HERO}
      excellence={EXCELLENCE}
      process={PROCESS}
      tools={TOOLS}
      faqs={FAQS}
      testimonials={TESTIMONIALS}
    >
      {/* UI/UX Design Superpowers */}
      <section className="superpowers-section">
        <div className="superpowers-container">
          <div className="superpowers-image" data-aos="fade-right">
            <img src="/assets/service.jpg" alt="Designer at work" />
          </div>
          <div className="superpowers-content" data-aos="fade-left">
            <h2 className="section-title-modern">Our UI/UX Design Superpowers</h2>
            {SUPERPOWERS.map(item => (
              <div className="superpower-item" key={item.title}>
                <h3><i className={`fas ${item.icon}`}></i> {item.title}</h3>
                <p>{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Project Showcase */}
      <section className="project-showcase-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Recent Web Design Projects</h2>
          <p className="section-subtitle">See how we&apos;ve helped businesses transform their digital presence</p>
        </div>
        <div className="project-showcase-grid">
          {PROJECTS.map((project, i) => (
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
