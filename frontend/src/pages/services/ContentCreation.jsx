import ServiceDetailLayout from './ServiceDetailLayout';

const HERO = {
  title: 'Content Creation & Media',
  desc: 'Visual content, marketing graphics, multimedia assets, and branded materials for digital engagement. We create thumb-stopping content that captures attention, tells your story, and drives meaningful engagement across every platform and touchpoint.',
  img: '/assets/hero.png',
  badgeIcon: '✨',
  badgeText: 'Creative Content',
  ctaText: 'See What We Create',
};

const EXCELLENCE = {
  heading: 'Content That Captivates & Converts',
  body: "In today's digital landscape, content is king—but quality content is emperor. We don't just create pretty visuals; we craft strategic content that resonates with your audience, amplifies your brand message, and drives real business results. From scroll-stopping social graphics to comprehensive content calendars, we're your complete content creation partner.",
  img: '/assets/about-2.png',
  stats: [
    { num: '10K+', label: 'Assets Created' },
    { num: '250%', label: 'Avg. Engagement Boost' },
  ],
};

const PROCESS = [
  {
    icon: 'fa-bullseye',
    title: '1. Strategy & Planning',
    desc: 'We start by understanding your audience, brand voice, and content goals.',
    features: ['Content audit & analysis', 'Audience research & personas', 'Content calendar development'],
  },
  {
    icon: 'fa-pencil-alt',
    title: '2. Creation & Design',
    desc: 'Our creative team brings concepts to life with stunning visuals and compelling copy.',
    features: ['Visual design & graphics', 'Copywriting & messaging', 'Multi-format adaptation'],
  },
  {
    icon: 'fa-chart-line',
    title: '3. Optimize & Scale',
    desc: 'We analyze performance data and continuously refine content for maximum impact.',
    features: ['A/B testing & optimization', 'Performance analytics', 'Iterative improvements'],
  },
];

const CONTENT_SERVICES = [
  {
    icon: 'fab fa-instagram',
    title: 'Social Media Content',
    desc: 'Platform-optimized posts, stories, carousels, and graphics that stop the scroll and spark conversations.',
    items: ['Instagram posts & Stories', 'Facebook graphics & covers', 'LinkedIn infographics', 'Twitter/X visuals', 'TikTok thumbnails'],
  },
  {
    icon: 'fas fa-ad',
    title: 'Marketing Materials',
    desc: 'Eye-catching marketing assets designed to convert prospects into loyal customers.',
    items: ['Digital ad creatives', 'Email marketing templates', 'Landing page graphics', 'Banner ads & display', 'Promotional materials'],
  },
  {
    icon: 'fas fa-image',
    title: 'Visual Assets',
    desc: 'Professional photography, illustrations, and custom graphics for all your needs.',
    items: ['Product photography edits', 'Custom illustrations', 'Infographics & data viz', 'Icon sets & graphics', 'Stock photo curation'],
  },
  {
    icon: 'fas fa-file-alt',
    title: 'Brand Collateral',
    desc: 'Professional materials that reinforce your brand identity and credibility.',
    items: ['Presentation decks', 'One-pagers & flyers', 'Brochures & catalogs', 'Case studies & whitepapers', 'Reports & eBooks'],
  },
  {
    icon: 'fas fa-pen-fancy',
    title: 'Content Writing',
    desc: 'Compelling copy that engages, informs, and persuades your target audience.',
    items: ['Blog posts & articles', 'Social media captions', 'Website copy', 'Product descriptions', 'Email campaigns'],
  },
  {
    icon: 'fas fa-calendar-alt',
    title: 'Content Strategy',
    desc: 'Comprehensive planning and management to keep your content consistent and effective.',
    items: ['Content calendar planning', 'Editorial guidelines', 'Trend monitoring & insights', 'Competitor analysis', 'Performance reporting'],
  },
];

const PACKAGES = [
  {
    name: 'Starter',
    price: '$500',
    features: ['12 social media posts', '4 Instagram Stories', 'Basic content calendar', '2 revisions per asset', 'Stock photos included'],
    featured: false,
  },
  {
    name: 'Professional',
    price: '$1,200',
    features: ['24 social media posts', '8 Instagram Stories', '4 carousel posts', '2 blog graphics', 'Content strategy session', 'Caption writing included', 'Unlimited revisions', 'Priority support'],
    featured: true,
  },
  {
    name: 'Enterprise',
    price: '$2,500',
    features: ['50+ social media posts', 'Unlimited Stories', '8 carousel posts', '4 blog posts + graphics', 'Video thumbnails', 'Email templates', 'Dedicated account manager', 'Monthly strategy calls'],
    featured: false,
  },
];

const WHY_PERFORMS = [
  { icon: 'fa-brain', title: 'Data-Driven Creativity', desc: 'We blend creative excellence with analytics. Every piece of content is informed by performance data, audience insights, and platform best practices to maximize engagement.' },
  { icon: 'fa-sync', title: 'Consistent Brand Voice', desc: 'We maintain your unique brand personality across all content. From tone to visual style, we ensure every asset reinforces your brand identity and builds recognition.' },
  { icon: 'fa-bolt', title: 'Platform Optimization', desc: 'Each platform has its own language and best practices. We tailor content for optimal performance on Instagram, LinkedIn, Facebook, Twitter, TikTok, and more.' },
  { icon: 'fa-clock', title: 'Trend-Aware Creation', desc: 'We stay ahead of social media trends, algorithm changes, and content formats. Your content is always fresh, relevant, and positioned to take advantage of viral opportunities.' },
];

const TOOLS = [
  { label: 'Design Tools', icon: 'fa-paint-brush', badges: ['Adobe Photoshop', 'Illustrator', 'Canva Pro', 'Figma'] },
  { label: 'Planning', icon: 'fa-calendar', badges: ['Later', 'Buffer', 'Notion', 'Asana'] },
  { label: 'Analytics', icon: 'fa-chart-bar', badges: ['Google Analytics', 'Hootsuite', 'Sprout Social', 'Meta Business Suite'] },
  { label: 'Resources', icon: 'fa-images', badges: ['Unsplash', 'Pexels', 'Adobe Stock', 'Envato Elements'] },
];

const FAQS = [
  { q: 'How many pieces of content do I need per month?', a: "It depends on your platforms and goals. We typically recommend: 12-20 posts for Instagram, 8-15 for LinkedIn, 20-30 for Twitter/X. Our Professional package (24 posts/month) covers most businesses' needs across 2-3 platforms. We'll assess your specific requirements during onboarding." },
  { q: 'Do you write captions and copy too?', a: "Yes! Our Professional and Enterprise packages include caption writing. We craft engaging captions with strategic hashtags, calls-to-action, and your brand voice. Starter package clients can add copywriting services for $200/month or provide their own captions." },
  { q: 'Can you schedule and post the content for us?', a: "Absolutely! We can handle full content scheduling and posting through tools like Buffer or Later. This service is included in Enterprise packages or available as an add-on ($300/month) for other tiers. We'll optimize posting times based on your audience analytics." },
  { q: 'What if I need specific content for an event or promotion?', a: "Rush projects are our specialty! We can create event-specific content with 24-48 hour turnaround for an additional fee. All packages include flexibility for timely content like sales, announcements, or trending topics—just give us a heads up." },
  { q: 'How do revisions work?', a: 'Starter packages include 2 revision rounds per asset. Professional and Enterprise packages include unlimited revisions. We share content via a review platform where you can comment directly on designs. Most clients approve content within 1-2 revision rounds.' },
  { q: 'Do I own the content you create?', a: 'Yes, you receive full rights to all content we create for you. We provide source files (PSD, AI) and web-ready exports. The only exception is stock photos/assets, which are licensed but included in your package pricing.' },
];

const TESTIMONIALS = [
  { initials: 'JL', text: 'Our Instagram engagement tripled in just 3 months! They understand what content resonates with our audience and consistently deliver scroll-stopping visuals.', name: 'Jessica Lee', role: 'Marketing Manager | Fashion Brand' },
  { initials: 'MK', text: "Finally, a team that gets B2B content! Our LinkedIn posts now actually get engagement. The infographics and thought leadership content have positioned us as industry experts.", name: 'Michael Kim', role: 'CEO | SaaS Company' },
  { initials: 'AP', text: "They take care of everything—from strategy to posting. I can focus on running my business while they handle our entire content presence. Worth every penny!", name: 'Alicia Patel', role: 'Founder | Wellness Studio' },
];

export default function ContentCreation() {
  return (
    <ServiceDetailLayout
      hero={HERO}
      excellence={EXCELLENCE}
      process={PROCESS}
      tools={TOOLS}
      faqs={FAQS}
      testimonials={TESTIMONIALS}
    >
      {/* What We Create */}
      <section className="content-services-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">What We Create</h2>
          <p className="section-subtitle">Comprehensive content solutions for every platform</p>
        </div>
        <div className="content-services-grid">
          {CONTENT_SERVICES.map((service, i) => (
            <div className="content-service-card" key={service.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="content-service-icon"><i className={service.icon}></i></div>
              <h3>{service.title}</h3>
              <p>{service.desc}</p>
              <ul className="content-service-list">
                {service.items.map(item => <li key={item}>{item}</li>)}
              </ul>
            </div>
          ))}
        </div>
      </section>

      {/* Content Packages */}
      <section className="content-packages-section">
        <div className="content-packages-section-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">Content Packages</h2>
            <p className="section-subtitle">Choose the plan that fits your needs</p>
          </div>
          <div className="packages-grid">
            {PACKAGES.map((pkg, i) => (
              <div className={`package-card${pkg.featured ? ' featured' : ''}`} key={pkg.name} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
                {pkg.featured && <div className="popular-badge">Most Popular</div>}
                <div className="package-header">
                  <h3>{pkg.name}</h3>
                  <div className="package-price">
                    <span className="price">{pkg.price}</span>
                    <span className="period">/month</span>
                  </div>
                </div>
                <ul className="package-features">
                  {pkg.features.map(f => (
                    <li key={f}><i className="fas fa-check"></i> {f}</li>
                  ))}
                </ul>
                <a href="/contact" className={`btn ${pkg.featured ? 'btn-primary-modern' : 'btn-outline-modern'} btn-block`}>
                  Get Started
                </a>
              </div>
            ))}
          </div>
          <div className="packages-note" data-aos="fade-up">
            <p><i className="fas fa-info-circle"></i> All packages include brand guideline adherence, source files, and monthly performance reports. Custom packages available.</p>
          </div>
        </div>
      </section>

      {/* Why Our Content Performs */}
      <section className="superpowers-section">
        <div className="superpowers-container">
          <div className="superpowers-image" data-aos="fade-right">
            <img src="/assets/service.jpg" alt="Content creation" />
          </div>
          <div className="superpowers-content" data-aos="fade-left">
            <h2 className="section-title-modern">Why Our Content Performs</h2>
            {WHY_PERFORMS.map(item => (
              <div className="superpower-item" key={item.title}>
                <h3><i className={`fas ${item.icon}`}></i> {item.title}</h3>
                <p>{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </ServiceDetailLayout>
  );
}
