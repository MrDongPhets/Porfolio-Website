import ServiceDetailLayout from './ServiceDetailLayout';

const HERO = {
  title: 'Administrative & Executive Support',
  desc: 'Virtual assistance, operational coordination, documentation, CRM management, and workflow optimization. We handle the behind-the-scenes work so you can focus on what matters most—growing your business and serving your clients.',
  img: '/assets/about-2.png',
  badgeIcon: '⚡',
  badgeText: '24/7 Support',
  ctaText: 'See How We Help',
};

const EXCELLENCE = {
  heading: 'Your Extended Team, On-Demand',
  body: "Running a business means wearing multiple hats—but you don't have to wear them all at once. Our virtual administrative professionals become seamless extensions of your team, handling everything from inbox management to complex operational workflows. With our support, you reclaim 15-20 hours per week to focus on strategic growth, client relationships, and the work only you can do.",
  img: '/assets/service.jpg',
  stats: [
    { num: '15-20hrs', label: 'Time Saved Weekly' },
    { num: '500+', label: 'Businesses Supported' },
  ],
};

const PROCESS = [
  {
    icon: 'fa-handshake',
    title: '1. Onboarding & Setup',
    desc: 'We learn your business, processes, tools, and communication preferences.',
    features: ['Comprehensive needs assessment', 'Tool & system access setup', 'Workflow documentation'],
  },
  {
    icon: 'fa-tasks',
    title: '2. Daily Operations',
    desc: 'We execute tasks seamlessly, keeping you informed with regular updates.',
    features: ['Task execution & management', 'Proactive problem-solving', 'Clear communication protocols'],
  },
  {
    icon: 'fa-chart-line',
    title: '3. Optimize & Scale',
    desc: 'We continuously improve processes and adapt as your business grows.',
    features: ['Process improvement suggestions', 'Weekly/monthly reporting', 'Scalable support levels'],
  },
];

const ADMIN_SERVICES = [
  {
    icon: 'fa-envelope-open-text',
    title: 'Email & Calendar Management',
    desc: 'Keep your inbox under control and your schedule optimized for productivity.',
    items: ['Inbox triage & prioritization', 'Email drafting & responses', 'Calendar scheduling & coordination', 'Meeting preparation & follow-ups', 'Appointment reminders'],
  },
  {
    icon: 'fa-user-friends',
    title: 'Customer Relationship Management',
    desc: 'Maintain strong client relationships with organized, responsive communication.',
    items: ['CRM data entry & updates', 'Client communication management', 'Follow-up automation', 'Lead tracking & nurturing', 'Customer support coordination'],
  },
  {
    icon: 'fa-file-invoice',
    title: 'Documentation & Data Entry',
    desc: 'Accurate, organized records that keep your business running smoothly.',
    items: ['Document creation & formatting', 'Data entry & management', 'Spreadsheet management', 'Report compilation', 'File organization & archiving'],
  },
  {
    icon: 'fa-plane',
    title: 'Travel & Event Coordination',
    desc: 'Seamless planning for business travel, meetings, and corporate events.',
    items: ['Travel booking & itineraries', 'Accommodation arrangements', 'Event planning & logistics', 'Vendor coordination', 'Expense tracking & reporting'],
  },
  {
    icon: 'fa-search-dollar',
    title: 'Research & Analysis',
    desc: 'Actionable insights and information to support strategic decision-making.',
    items: ['Market research', 'Competitor analysis', 'Data compilation & reporting', 'Vendor/supplier research', 'Presentation preparation'],
  },
  {
    icon: 'fa-cogs',
    title: 'Process & Workflow Optimization',
    desc: 'Streamline operations with efficient systems and automated workflows.',
    items: ['Standard operating procedures', 'Workflow automation setup', 'Tool integration & management', 'Process documentation', 'Efficiency recommendations'],
  },
];

const PACKAGES = [
  {
    name: 'Essential',
    price: '$800',
    hours: '20 hours/month',
    features: ['Email & calendar management', 'Basic data entry', 'Meeting scheduling', 'Document formatting', 'Response within 24 hours', 'Weekly status updates'],
    featured: false,
  },
  {
    name: 'Professional',
    price: '$1,500',
    hours: '40 hours/month',
    features: ['All Essential features', 'CRM management', 'Client communication', 'Travel coordination', 'Research & reporting', 'Process documentation', 'Response within 4 hours', 'Daily status updates'],
    featured: true,
  },
  {
    name: 'Executive',
    price: '$2,800',
    hours: '80 hours/month',
    features: ['All Professional features', 'Dedicated assistant', 'Project management', 'Team coordination', 'Event planning & execution', 'Workflow optimization', 'Priority response (1 hour)', 'Weekly strategy calls'],
    featured: false,
  },
];

const WHY_CHOOSE = [
  { icon: 'fa-graduation-cap', title: 'Highly Trained Professionals', desc: 'Our team consists of experienced administrative professionals with backgrounds in corporate management, executive assistance, and operations. Each assistant undergoes rigorous training in our processes and best practices.' },
  { icon: 'fa-shield-alt', title: 'Security & Confidentiality', desc: 'We take data security seriously. All team members sign NDAs, undergo background checks, and are trained in confidentiality protocols. We use secure systems and encrypted communication for all sensitive information.' },
  { icon: 'fa-sync-alt', title: 'Seamless Integration', desc: "We adapt to your existing tools and workflows—no need to change systems. Whether you use Gmail, Outlook, Asana, Monday, or any other platform, we integrate smoothly and get up to speed quickly." },
  { icon: 'fa-clock', title: 'Consistent Availability', desc: 'With team coverage across time zones, you have support when you need it. No vacation gaps, no sick days—just reliable, consistent assistance that keeps your business running.' },
];

const TOOLS = [
  { label: 'Email & Calendar', icon: 'fa-envelope', badges: ['Gmail', 'Outlook', 'Apple Mail', 'Calendly'] },
  { label: 'Project Management', icon: 'fa-tasks', badges: ['Asana', 'Monday.com', 'Trello', 'ClickUp'] },
  { label: 'CRM Systems', icon: 'fa-database', badges: ['Salesforce', 'HubSpot', 'Pipedrive', 'Zoho CRM'] },
  { label: 'Documentation', icon: 'fa-file-alt', badges: ['Google Workspace', 'Microsoft Office', 'Notion', 'Airtable'] },
  { label: 'Communication', icon: 'fa-comments', badges: ['Slack', 'Microsoft Teams', 'Zoom', 'WhatsApp Business'] },
  { label: 'Automation', icon: 'fa-robot', badges: ['Zapier', 'Make', 'IFTTT', 'Automate.io'] },
];

const USE_CASES = [
  {
    icon: 'fa-user-tie',
    title: 'Entrepreneurs & Founders',
    desc: 'Focus on strategy and growth while we handle daily operations, inbox management, and administrative tasks that drain your time.',
    tags: ['Calendar Management', 'Email Handling', 'Travel Booking'],
  },
  {
    icon: 'fa-briefcase',
    title: 'Small Business Owners',
    desc: 'Scale without overhead. Get executive-level support without the cost of a full-time employee, with flexibility to adjust as you grow.',
    tags: ['CRM Management', 'Client Relations', 'Documentation'],
  },
  {
    icon: 'fa-users-cog',
    title: 'Remote Teams',
    desc: 'Coordinate distributed teams with centralized administrative support, project coordination, and workflow management across time zones.',
    tags: ['Team Coordination', 'Project Tracking', 'Meeting Scheduling'],
  },
  {
    icon: 'fa-chart-line',
    title: 'Consultants & Agencies',
    desc: 'Maximize billable hours by offloading client onboarding, proposal creation, scheduling, and administrative overhead to our team.',
    tags: ['Client Onboarding', 'Proposal Writing', 'Reporting'],
  },
];

const FAQS = [
  { q: 'How quickly can we get started?', a: 'Most clients are up and running within 3-5 business days. After you sign up, we schedule an onboarding call to understand your needs, set up access to your tools, and assign your dedicated assistant. For urgent needs, we offer expedited onboarding (24-48 hours) at no extra charge.' },
  { q: "What if I don't use all my hours?", a: 'Unused hours roll over to the next month (up to 25% of your monthly allocation). For example, if you have 40 hours/month and use only 30, you\'ll have 50 hours the following month. This ensures you get full value from your investment while maintaining flexibility.' },
  { q: 'Will I work with the same person every time?', a: 'Yes! Professional and Executive packages include a dedicated assistant who learns your preferences, business, and workflows. Essential packages have primary and backup assistants for coverage. All team members have access to your account notes for seamless continuity.' },
  { q: 'How do you ensure data security?', a: 'We implement bank-level security: all assistants sign NDAs and undergo background checks, we use encrypted communication (Signal, encrypted email), secure password managers (1Password, LastPass), 2FA on all accounts, and SOC 2 Type II compliant practices. We never share client information or use it for any purpose outside your business needs.' },
  { q: 'Can I upgrade or downgrade my plan?', a: 'Absolutely! Our plans are flexible month-to-month. You can upgrade anytime for immediate access to more hours and features. Downgrades take effect at your next billing cycle. Many clients start with Essential and scale up as they realize the value of having more support.' },
  { q: 'What happens if my assistant is unavailable?', a: "You're always covered. Each assistant has a trained backup who has access to your account and standard procedures. For time-sensitive matters, our team lead can step in immediately. We maintain detailed documentation so any team member can assist you seamlessly—no gaps in service, ever." },
];

const TESTIMONIALS = [
  { initials: 'RJ', text: 'I got 15 hours back per week—no exaggeration. My assistant handles everything from scheduling to client follow-ups. I can finally focus on growing the business instead of drowning in admin work.', name: 'Rachel Johnson', role: 'Founder | Marketing Agency' },
  { initials: 'DT', text: 'Best business decision I made this year. My VA manages my entire CRM, follows up with leads, and keeps everything organized. Our client retention improved by 40% because nothing falls through the cracks anymore.', name: 'David Thompson', role: 'Real Estate Broker' },
  { initials: 'SC', text: "Having executive support without the $80K salary is a game-changer. My assistant coordinates my team, manages projects, and handles travel—all the things that used to eat up my entire day. Worth every penny.", name: 'Sarah Chen', role: 'CEO | Tech Startup' },
];

export default function AdminSupport() {
  return (
    <ServiceDetailLayout
      hero={HERO}
      excellence={EXCELLENCE}
      process={PROCESS}
      tools={TOOLS}
      faqs={FAQS}
      testimonials={TESTIMONIALS}
    >
      {/* Services We Provide */}
      <section className="content-services-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Services We Provide</h2>
          <p className="section-subtitle">Comprehensive administrative support for modern businesses</p>
        </div>
        <div className="admin-services-grid">
          {ADMIN_SERVICES.map((service, i) => (
            <div className="admin-service-card" key={service.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="admin-service-icon"><i className={`fas ${service.icon}`}></i></div>
              <h3>{service.title}</h3>
              <p>{service.desc}</p>
              <ul className="admin-service-list">
                {service.items.map(item => <li key={item}>{item}</li>)}
              </ul>
            </div>
          ))}
        </div>
      </section>

      {/* Support Packages */}
      <section className="content-packages-section">
        <div className="content-packages-section-container">
          <div className="section-header" data-aos="fade-up">
            <h2 className="section-title-modern">Support Packages</h2>
            <p className="section-subtitle">Flexible support levels to match your needs</p>
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
                  <p className="package-hours">{pkg.hours}</p>
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
            <p><i className="fas fa-info-circle"></i> All packages include rollover of unused hours (up to 25%), no setup fees, and flexible month-to-month contracts. Custom hourly rates available.</p>
          </div>
        </div>
      </section>

      {/* Why Choose Our Support Team */}
      <section className="superpowers-section">
        <div className="superpowers-container">
          <div className="superpowers-image" data-aos="fade-right">
            <img src="/assets/hero.png" alt="Virtual assistant tools" />
          </div>
          <div className="superpowers-content" data-aos="fade-left">
            <h2 className="section-title-modern">Why Choose Our Support Team</h2>
            {WHY_CHOOSE.map(item => (
              <div className="superpower-item" key={item.title}>
                <h3><i className={`fas ${item.icon}`}></i> {item.title}</h3>
                <p>{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Who We Help */}
      <section className="use-cases-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Who We Help</h2>
          <p className="section-subtitle">Administrative support tailored to different business types</p>
        </div>
        <div className="use-cases-grid">
          {USE_CASES.map((uc, i) => (
            <div className="use-case-card" key={uc.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="use-case-icon"><i className={`fas ${uc.icon}`}></i></div>
              <h3>{uc.title}</h3>
              <p>{uc.desc}</p>
              <div className="use-case-tags">
                {uc.tags.map(tag => <span key={tag}>{tag}</span>)}
              </div>
            </div>
          ))}
        </div>
      </section>
    </ServiceDetailLayout>
  );
}
