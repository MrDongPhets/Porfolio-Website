import ServiceDetailLayout from './ServiceDetailLayout';

const HERO = {
  title: 'Video Editing & Multimedia',
  desc: 'Short-form social videos, long-form content editing, promotional assets, and branded video production. We transform raw footage into compelling stories that captivate audiences, drive engagement, and deliver your message with cinematic quality.',
  img: '/assets/service.jpg',
  badgeIcon: '▶',
  badgeText: '4K Quality',
  ctaText: 'See Our Work',
};

const EXCELLENCE = {
  heading: 'Stories That Move People',
  body: "In a world where attention spans are shrinking, your video content needs to hook viewers in the first 3 seconds and keep them watching until the end. We specialize in creating scroll-stopping videos that blend stunning visuals, strategic pacing, and emotional storytelling—whether it's a 15-second Instagram Reel or a 10-minute YouTube documentary.",
  img: '/assets/hero.png',
  stats: [
    { num: '500+', label: 'Videos Produced' },
    { num: '10M+', label: 'Total Views' },
  ],
};

const PROCESS = [
  {
    icon: 'fa-file-video',
    title: '1. Pre-Production',
    desc: 'Strategic planning and creative concepting to ensure your video hits the mark.',
    features: ['Scriptwriting & storyboarding', 'Shot list creation', 'Style & mood board development'],
  },
  {
    icon: 'fa-cut',
    title: '2. Editing & Post',
    desc: 'Professional editing with color grading, sound design, and motion graphics.',
    features: ['Multi-cam & multi-format editing', 'Color correction & grading', 'Audio mixing & sound design'],
  },
  {
    icon: 'fa-rocket',
    title: '3. Delivery & Optimization',
    desc: 'Platform-optimized exports ready for distribution across all channels.',
    features: ['Multiple format exports', 'Platform-specific optimization', 'Thumbnail & caption creation'],
  },
];

const VIDEO_SERVICES = [
  { icon: 'fa-mobile-alt', title: 'Short-Form Social Content', desc: 'TikToks, Reels, Shorts, and Stories that stop the scroll. Fast-paced edits with trending music, captions, and effects optimized for maximum engagement and virality.' },
  { icon: 'fa-film', title: 'Long-Form Content Editing', desc: 'YouTube videos, podcasts, webinars, and documentaries. Professional editing with B-roll, graphics, lower thirds, and chapter markers for comprehensive content.' },
  { icon: 'fa-bullhorn', title: 'Promotional & Commercial Videos', desc: 'Product demos, explainer videos, testimonials, and ads that convert viewers into customers. Polished production value with strategic messaging.' },
  { icon: 'fa-magic', title: 'Motion Graphics & Animation', desc: 'Animated logos, kinetic typography, infographic videos, and 2D/3D animations that bring concepts to life with eye-catching visual effects.' },
];

const VIDEO_TYPES = [
  {
    icon: 'fab fa-tiktok',
    title: 'Social Media Videos',
    items: ['Instagram Reels (15-90 sec)', 'TikTok videos (15-60 sec)', 'YouTube Shorts (60 sec)', 'Facebook & LinkedIn videos', 'Stories & ephemeral content'],
    badge: 'Starting at $200',
    featured: false,
  },
  {
    icon: 'fab fa-youtube',
    title: 'YouTube Content',
    items: ['Full video editing (10-60 min)', 'Podcast editing & clipping', 'Thumbnail design included', 'Intro/outro animations', 'SEO-optimized descriptions'],
    badge: 'Starting at $500',
    featured: true,
  },
  {
    icon: 'fas fa-briefcase',
    title: 'Commercial Productions',
    items: ['Product demonstrations', 'Brand videos & commercials', 'Explainer videos', 'Customer testimonials', 'Event coverage & highlights'],
    badge: 'Starting at $1,500',
    featured: false,
  },
];

const VIDEO_PORTFOLIO = [
  { img: '/assets/hero.png', duration: '0:30', category: 'Commercial', title: 'Tech Product Launch', desc: 'Sleek product reveal for consumer electronics', views: '2.4M views', likes: '89K likes' },
  { img: '/assets/about-2.png', duration: '0:15', category: 'Social', title: 'Viral Instagram Reel', desc: 'Fast-paced fashion brand content', views: '5.1M views', likes: '234K likes' },
  { img: '/assets/service.jpg', duration: '12:45', category: 'YouTube', title: 'Educational Explainer', desc: 'In-depth tutorial with motion graphics', views: '847K views', likes: '42K likes' },
  { img: '/assets/hero.png', duration: '2:30', category: 'Brand', title: 'Company Culture Video', desc: 'Authentic behind-the-scenes storytelling', views: '356K views', likes: '18K likes' },
];

const TOOLS = [
  { label: 'Video Editing', icon: 'fa-cut', badges: ['Adobe Premiere Pro', 'Final Cut Pro', 'DaVinci Resolve', 'After Effects'] },
  { label: 'Color Grading', icon: 'fa-palette', badges: ['DaVinci Resolve', 'Lumetri Color', 'FilmConvert', 'Color Finale'] },
  { label: 'Audio Production', icon: 'fa-volume-up', badges: ['Adobe Audition', 'Logic Pro', 'Izotope RX', 'Soundstripe'] },
  { label: 'Motion Graphics', icon: 'fa-magic', badges: ['After Effects', 'Cinema 4D', 'Blender', 'Element 3D'] },
];

const FAQS = [
  { q: 'How much does video editing cost?', a: 'Pricing varies by project complexity: Social media clips start at $200, YouTube videos start at $500, and commercial productions start at $1,500. We offer package deals for ongoing content needs (10+ videos/month) with 20-30% discounts.' },
  { q: "What's the typical turnaround time?", a: 'Social clips: 2-3 days. YouTube videos: 5-7 days. Commercial productions: 10-14 days. Rush delivery (24-48 hours) is available for an additional 50% fee. Timelines depend on video length and complexity.' },
  { q: 'Do you provide videography or just editing?', a: "We specialize in editing but can coordinate full production services through our network of videographers and production crews. For local projects, we offer complete shoot-to-edit packages. We also excel at editing existing footage you've already captured." },
  { q: 'What file formats do you accept and deliver?', a: 'We accept all major formats (MP4, MOV, AVI, MXF, ProRes, etc.). We deliver optimized files for each platform: MP4 for YouTube/web, vertical formats for TikTok/Reels, and high-res masters for broadcasting. Source files and project files available upon request.' },
  { q: 'Can you add subtitles and captions?', a: 'Absolutely! We include auto-captions for all videos, manually reviewed for accuracy. We offer multiple caption styles: minimalist, bold social media style, or custom branded captions matching your visual identity. Available in multiple languages.' },
  { q: 'Do you provide music and sound effects?', a: 'Yes! We have subscriptions to premium royalty-free music libraries (Artlist, Epidemic Sound, Soundstripe). All music is licensed for commercial use. We also offer custom sound design, mixing, and audio enhancement to ensure professional quality.' },
];

const TESTIMONIALS = [
  { initials: 'SM', text: '"They turned my raw footage into viral gold! My engagement increased 300% after they started editing my Reels. They just GET what works on social media."', name: 'Sarah Mitchell', role: 'Content Creator | 500K followers' },
  { initials: 'JC', text: "Professional, fast, and creative. They handle all our YouTube content and we've seen a 45% increase in watch time. Best investment we've made.", name: 'James Chen', role: 'Tech Channel | 2M subscribers' },
  { initials: 'ER', text: 'Our product launch video exceeded all expectations. The motion graphics and color grading were stunning. Generated over $100K in sales in the first week.', name: 'Emily Rodriguez', role: 'Marketing Director | E-commerce' },
];

export default function VideoEditing() {
  return (
    <ServiceDetailLayout
      hero={HERO}
      excellence={EXCELLENCE}
      process={PROCESS}
      tools={TOOLS}
      faqs={FAQS}
      testimonials={TESTIMONIALS}
    >
      {/* Our Video Services */}
      <section className="superpowers-section">
        <div className="superpowers-container">
          <div className="superpowers-image" data-aos="fade-right">
            <img src="/assets/about-2.png" alt="Video editing services" />
          </div>
          <div className="superpowers-content" data-aos="fade-left">
            <h2 className="section-title-modern">Our Video Services</h2>
            {VIDEO_SERVICES.map(item => (
              <div className="superpower-item" key={item.title}>
                <h3><i className={`fas ${item.icon}`}></i> {item.title}</h3>
                <p>{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Video Formats */}
      <section className="video-types-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Video Formats We Master</h2>
          <p className="section-subtitle">From quick social clips to cinematic productions</p>
        </div>
        <div className="video-types-grid">
          {VIDEO_TYPES.map((vt, i) => (
            <div className={`video-type-card${vt.featured ? ' featured' : ''}`} key={vt.title} data-aos="fade-up" data-aos-delay={`${(i + 1) * 100}`}>
              {vt.featured && <div className="featured-badge">Most Popular</div>}
              <div className="video-type-header">
                <i className={vt.icon}></i>
                <h3>{vt.title}</h3>
              </div>
              <ul className="video-type-list">
                {vt.items.map(item => <li key={item}>{item}</li>)}
              </ul>
              <div className="video-type-badge">{vt.badge}</div>
            </div>
          ))}
        </div>
      </section>

      {/* Video Portfolio */}
      <section className="video-portfolio-section">
        <div className="section-header" data-aos="fade-up">
          <h2 className="section-title-modern">Recent Video Projects</h2>
          <p className="section-subtitle">See our work in action</p>
        </div>
        <div className="video-portfolio-grid">
          {VIDEO_PORTFOLIO.map((video, i) => (
            <div className="video-portfolio-item" key={i} data-aos="zoom-in" data-aos-delay={`${(i + 1) * 100}`}>
              <div className="video-thumbnail">
                <img src={video.img} alt={video.title} />
                <div className="video-play-button"><i className="fas fa-play"></i></div>
                <div className="video-duration">{video.duration}</div>
                <div className="video-category">{video.category}</div>
              </div>
              <div className="video-portfolio-info">
                <h3>{video.title}</h3>
                <p>{video.desc}</p>
                <div className="video-stats">
                  <span><i className="fas fa-eye"></i> {video.views}</span>
                  <span><i className="fas fa-heart"></i> {video.likes}</span>
                </div>
              </div>
            </div>
          ))}
        </div>
      </section>
    </ServiceDetailLayout>
  );
}
