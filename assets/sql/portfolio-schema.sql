-- ============================================================
-- Portfolio Items — Add Case Study Columns
-- Run this in your Supabase SQL Editor
-- ============================================================

ALTER TABLE public.portfolio_items
  ADD COLUMN IF NOT EXISTS slug VARCHAR,
  ADD COLUMN IF NOT EXISTS client_name VARCHAR,
  ADD COLUMN IF NOT EXISTS role VARCHAR,
  ADD COLUMN IF NOT EXISTS timeline VARCHAR,
  ADD COLUMN IF NOT EXISTS tools_used TEXT,
  ADD COLUMN IF NOT EXISTS challenge TEXT,
  ADD COLUMN IF NOT EXISTS solution TEXT,
  ADD COLUMN IF NOT EXISTS results TEXT,
  ADD COLUMN IF NOT EXISTS deliverables TEXT,
  ADD COLUMN IF NOT EXISTS gallery_images TEXT;

-- Add a unique index on slug for fast lookup
CREATE UNIQUE INDEX IF NOT EXISTS portfolio_items_slug_idx ON public.portfolio_items(slug);


-- ============================================================
-- Sample Portfolio Items — INSERT Queries
-- 12 items covering: Branding, Web Design, UI/UX Design,
-- Logo Design, Social Media, Print Design
-- ============================================================

INSERT INTO public.portfolio_items (
  title, slug, category, description,
  client_name, role, timeline, tools_used, deliverables,
  challenge, solution, results,
  image_url, project_url, gallery_images,
  is_featured, is_active, display_order
) VALUES

-- 1. Branding
(
  'NexaCore Tech Startup Branding',
  'nexacore-tech-startup-branding',
  'Branding',
  'A complete brand identity system for an AI-powered SaaS platform targeting enterprise clients. The project included logo design, color system, typography, and brand guidelines.',
  'NexaCore Solutions',
  'Brand Identity Designer',
  '6 weeks',
  'Adobe Illustrator, Adobe InDesign, Figma',
  'Logo Suite, Brand Guidelines, Color Palette, Typography System, Business Cards, Letterhead',
  'NexaCore was entering a crowded AI SaaS market with no visual identity. They needed a brand that communicated trust, innovation, and enterprise credibility — while standing out from typical tech aesthetics that rely on blue and gradients.',
  'We developed a bold, geometric mark inspired by neural network nodes — communicating intelligence and connectivity. The palette of deep navy and electric gold was chosen to signal premium positioning. A custom type pairing of sharp sans-serif for headlines with a humanist face for body text balanced authority with approachability. Full brand guidelines ensured consistent application across all touchpoints.',
  'NexaCore closed their Series A funding round two months after launch, citing the professional brand as a key factor in investor confidence. Organic social engagement increased by 240% in the first quarter following the rebrand.',
  'https://images.unsplash.com/photo-1558655146-9f40138edfeb?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800","https://images.unsplash.com/photo-1634942537034-2531766767d1?w=800","https://images.unsplash.com/photo-1600320254374-ce2d293cc86f?w=800"]',
  true, true, 1
),

-- 2. Web Design
(
  'Luxe Commerce — E-Commerce Website',
  'luxe-commerce-ecommerce-website',
  'Web Design',
  'A premium e-commerce platform for a luxury fashion retailer, featuring immersive product photography, seamless checkout UX, and a mobile-first shopping experience.',
  'Luxe Commerce PH',
  'Lead UX/UI Designer',
  '8 weeks',
  'Figma, Adobe XD, Adobe Photoshop',
  'Full Website UI Design, Mobile Design, Prototype, Design Handoff Documentation',
  'The client was losing customers at the product discovery and checkout stages. Their existing site was cluttered, slow-feeling, and did not reflect the luxury positioning of their products. Mobile conversion was especially poor at under 1%.',
  'We redesigned the entire customer journey from homepage to order confirmation. The new design uses generous white space, full-bleed imagery, and micro-interactions that make browsing feel tactile and premium. Checkout was reduced from 6 steps to 3 with a persistent cart summary. Every decision was validated through user flow analysis and heatmap data from the old site.',
  'Mobile conversion improved from 0.9% to 3.4% within 60 days of launch. Average session duration increased by 2 minutes. Cart abandonment dropped by 28%. The client reported a 65% increase in monthly revenue compared to the same period the previous year.',
  'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800","https://images.unsplash.com/photo-1483985988355-763728e1935b?w=800","https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=800"]',
  true, true, 2
),

-- 3. Social Media
(
  'Bloom Café — Instagram Growth Campaign',
  'bloom-cafe-instagram-campaign',
  'Social Media',
  'A six-month visual content strategy and social media campaign that grew Bloom Café''s Instagram following from 1,200 to 38,000 and drove a 45% increase in foot traffic.',
  'Bloom Café',
  'Social Media Designer & Strategist',
  '6 months',
  'Adobe Photoshop, Canva Pro, CapCut',
  'Monthly Content Calendar, 180 Feed Posts, 360 Stories, 24 Reels, Brand Voice Guide',
  'Bloom Café had a beautiful physical space but near-zero social media presence. Despite positive word-of-mouth, they struggled to reach new customers in a competitive food and beverage market where Instagram is the primary discovery channel.',
  'We built a cohesive visual identity for their social channels rooted in warm tones, lifestyle photography, and a consistent grid aesthetic. Content pillars were defined: product spotlights, behind-the-scenes, community features, and seasonal promotions. Each reel was scripted and edited to encourage saves and shares. Hashtag strategy was researched and refreshed monthly based on performance data.',
  'Instagram following grew by 3,067% over 6 months. Average reel views hit 85,000. Three posts went locally viral, each driving sold-out days at the café. Foot traffic increased 45% on weekends. The café was featured in a local lifestyle magazine after a journalist discovered them through a trending post.',
  'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1579762715118-a6f1d4b934f1?w=800","https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800","https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800"]',
  false, true, 3
),

-- 4. UI/UX Design
(
  'FitPulse — Mobile App UI Design',
  'fitpulse-mobile-app-ui-design',
  'UI/UX Design',
  'A complete UI/UX design for a fitness tracking mobile app, covering onboarding, workout logging, progress dashboards, and social features for iOS and Android.',
  'FitPulse Inc.',
  'UI/UX Designer',
  '10 weeks',
  'Figma, Principle, Lottie',
  'User Research Report, Wireframes, UI Kit, Prototype (iOS & Android), Design System',
  'FitPulse had a working MVP but user retention dropped sharply after day 7. Exit surveys pointed to a confusing onboarding flow and a dashboard that overwhelmed new users with data. They needed a ground-up redesign before their public launch.',
  'We started with user interviews and journey mapping to identify exactly where users got lost. The redesigned onboarding was shortened to 3 screens with progressive disclosure of features. The dashboard was restructured around a single "Today" view, with deeper analytics available on demand. A custom component library was built in Figma to ensure consistency and speed up developer handoff. Micro-animations were added to make progress feel rewarding.',
  'Beta testing showed day-7 retention improved from 18% to 61%. App Store rating climbed from 2.8 to 4.6 stars after launch. The redesigned onboarding reduced drop-off by 73%. FitPulse was featured as an "App of the Day" by a major tech publication two weeks after launch.',
  'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1576633587382-13ddf37b1fc1?w=800","https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=800","https://images.unsplash.com/photo-1434494878577-86c23bcb06b9?w=800"]',
  true, true, 4
),

-- 5. Logo Design
(
  'Verdant Law Group — Logo Design',
  'verdant-law-group-logo-design',
  'Logo Design',
  'A sophisticated logo and visual identity for a boutique environmental law firm that needed to signal both legal authority and ecological commitment.',
  'Verdant Law Group',
  'Logo & Brand Designer',
  '3 weeks',
  'Adobe Illustrator, Adobe InDesign',
  'Primary Logo, Logo Variations, Color Palette, Typography Pairing, Business Card Design, Email Signature',
  'Environmental law firms often default to generic "leaf + gavel" visual clichés that fail to convey the firm''s intellectual rigor. Verdant needed a mark that spoke to both their environmental focus and their position as serious legal professionals without falling into tired green-movement stereotypes.',
  'We designed an abstract monogram that interweaves the letters "V" and "L" into a form that subtly suggests both the scales of justice and a growing plant. The mark works at all sizes, from a favicon to a building sign. The color palette of forest green, charcoal, and warm cream communicates authority and natural integrity. The refined serif wordmark reinforces credibility.',
  'The firm''s managing partner described the new identity as "exactly what we didn''t know we needed." New client inquiries increased by 30% in the quarter after the rebrand, which they attributed in part to improved brand perception. The logo won a regional design award in the Professional Services category.',
  'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800","https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800","https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800"]',
  false, true, 5
),

-- 6. Branding
(
  'Harvest & Co. — Restaurant Rebrand',
  'harvest-co-restaurant-rebrand',
  'Branding',
  'A comprehensive rebrand for a farm-to-table restaurant, creating a warm, artisanal visual identity across all physical and digital touchpoints.',
  'Harvest & Co. Restaurant',
  'Brand Designer',
  '5 weeks',
  'Adobe Illustrator, Adobe InDesign, Figma',
  'Logo, Menu Design, Signage Package, Social Media Templates, Packaging Design, Staff Uniforms Concept',
  'After 5 years of operation, Harvest & Co. had accumulated a patchwork of visual decisions that no longer reflected their farm-to-table philosophy. Their branding felt generic despite their genuinely exceptional food sourcing and story. A new chef-owner acquisition was the catalyst for a complete identity overhaul.',
  'The new identity was rooted in the textures and rhythms of the agricultural seasons. A hand-drawn botanical illustration style was paired with a warm, earthy palette of terracotta, sage, and oat. The logotype used a custom-adjusted serif that felt crafted, not corporate. Every element — from the menu paper stock to the stamp-style secondary marks — was designed to feel tactile and genuine.',
  'The rebranded restaurant received a 4.9-star rating on Google within 3 months of reopening under the new identity. Reservation bookings increased by 85%. The brand was featured in a national food magazine, driving reservations from out-of-town visitors. Merchandise featuring the brand illustrations sold out within the first week of availability.',
  'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800","https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800","https://images.unsplash.com/photo-1551218808-94e220e084d2?w=800"]',
  false, true, 6
),

-- 7. Web Design
(
  'Stellara Fashion — Brand Website',
  'stellara-fashion-brand-website',
  'Web Design',
  'An elegant, immersive website for a luxury fashion label, designed to showcase editorial photography and tell the brand story through scroll-driven storytelling.',
  'Stellara Fashion House',
  'Web & UI Designer',
  '7 weeks',
  'Figma, Adobe Photoshop, Adobe After Effects',
  'Website UI Design (Desktop & Mobile), Animation Specs, Style Guide, CMS Content Structure',
  'Stellara had a strong editorial aesthetic in their print campaigns but a website that felt generic and off-brand. The existing site used a standard e-commerce template that buried the brand story under product grids. They needed a digital experience as intentional as their physical collections.',
  'We designed a narrative-first website that uses full-viewport photography and horizontal scroll sections to tell the story of each collection before presenting products. The navigation was reduced to its essential elements to keep attention on the visuals. A soft, gesture-inspired animation language was developed to make movement feel like turning a magazine page. The design was built for CMS integration so the team could update content independently.',
  'Bounce rate dropped from 71% to 34%. Average session duration doubled to 4 minutes 22 seconds. Press inquiry volume increased by 120%. The site was featured in an industry design showcase as an example of fashion-forward web design, generating significant inbound attention from other luxury brands.',
  'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=800","https://images.unsplash.com/photo-1509631179647-0177331693ae?w=800","https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800"]',
  true, true, 7
),

-- 8. Print Design
(
  'Meridian Capital — Annual Report',
  'meridian-capital-annual-report',
  'Print Design',
  'A data-rich 64-page annual report for a private equity firm, transforming complex financial data into clear, visually engaging infographics and editorial spreads.',
  'Meridian Capital Partners',
  'Editorial & Infographic Designer',
  '4 weeks',
  'Adobe InDesign, Adobe Illustrator, Microsoft Excel (data processing)',
  '64-Page Annual Report PDF, Print-Ready Files, Digital Interactive Version',
  'Annual reports in the financial sector are frequently dense, text-heavy documents that stakeholders avoid reading. Meridian''s previous reports had critical performance data buried in tables and charts that were difficult to parse. With a major investor summit approaching, they needed a report that communicated results clearly and reflected their premium brand positioning.',
  'We restructured the report around a narrative arc: context, performance, portfolio highlights, and outlook. Each section opens with a full-page visual anchor and a key takeaway stat. Complex portfolio performance data was transformed into clean, color-coded infographics that allow at-a-glance comprehension. A consistent grid system and refined typographic hierarchy guided readers through 64 pages without fatigue. The document was produced in both print-ready and interactive PDF formats.',
  'Stakeholder feedback at the investor summit was overwhelmingly positive, with multiple LPs noting the report as the most readable they''d received from any fund. The managing partner reported the report "changed the conversation in the room." Two competing firms approached us for their own annual report projects after seeing Meridian''s.',
  'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1434626881859-194d67b2b86f?w=800","https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=800","https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800"]',
  false, true, 8
),

-- 9. Logo Design
(
  'Zephyr Coffee — Logo & Packaging',
  'zephyr-coffee-logo-packaging',
  'Logo Design',
  'A bold, distinctive logo and full packaging suite for an artisan specialty coffee brand launching into retail, designed to stand out on shelf while appealing to coffee enthusiasts.',
  'Zephyr Coffee Roasters',
  'Brand & Packaging Designer',
  '4 weeks',
  'Adobe Illustrator, Adobe Photoshop, Adobe Dimension',
  'Primary Logo, Secondary Marks, Bag Packaging Design (3 variants), Label System, Brand Standards Guide',
  'The specialty coffee market is crowded with minimalist, Scandinavian-influenced packaging. Zephyr needed to differentiate their product on retail shelves where 30+ similar brands compete. They also needed a brand that would appeal to coffee enthusiasts who value craft and story without feeling pretentious or overly academic.',
  'The logo centers on a stylized wind mark — referencing "Zephyr" the west wind — abstracted into a dynamic, sweeping form that suggests both movement and the rising steam of a fresh cup. The wordmark is set in a strong, condensed sans-serif for shelf impact. Three packaging variants were designed for their flagship roasts, each using a distinct color paired with the same illustration system to create brand unity while enabling product differentiation.',
  'The product launched in 12 retail locations and sold through 80% of initial stock in the first month. A specialty coffee buyer described the packaging as "the reason I gave it shelf space." Within 6 months, distribution expanded to 47 locations. The brand was featured in a specialty coffee publication''s "New Brands to Watch" issue.',
  'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800","https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800","https://images.unsplash.com/photo-1506619216599-9d16d0903dfd?w=800"]',
  true, true, 9
),

-- 10. Social Media
(
  'PeakMove Real Estate — Content Strategy',
  'peakmove-real-estate-content',
  'Social Media',
  'A full content strategy and visual template system for a luxury real estate agency, creating a premium social presence that attracts high-net-worth buyers and sellers.',
  'PeakMove Real Estate',
  'Social Media Designer',
  '3 months',
  'Adobe Photoshop, Canva Pro, Adobe Premiere',
  'Brand Template Pack (Canva), 90-Day Content Calendar, 90 Feed Posts, Property Video Templates, Story Highlight Covers',
  'PeakMove was posting inconsistently and without a coherent visual language. Their listings were photographed to a high standard, but the social presentation undercut the luxury positioning. Competitors with inferior listings but stronger social presence were winning clients.',
  'We created a complete social media design system with locked templates for four content types: property listings, market insights, team spotlights, and lifestyle content. The visual language used a sophisticated dark palette with gold accents that immediately signaled premium positioning. Property listing posts were designed to function as standalone ads, with clean typography and strategic use of the photography. All templates were built in Canva for easy in-house use.',
  'Follower count grew 180% in 3 months. Inbound inquiry rate from social media increased by 220%. Three of their highest-value property sales in company history came from leads that originated on Instagram. The agency''s principal was approached to speak at a regional real estate conference about their social media transformation.',
  'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800","https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800","https://images.unsplash.com/photo-1558981852-426c349e74b3?w=800"]',
  false, true, 10
),

-- 11. UI/UX Design
(
  'Schoolr — EdTech Platform UI',
  'schoolr-edtech-platform-ui',
  'UI/UX Design',
  'End-to-end UX/UI design for a K–12 online learning platform, covering student, teacher, and parent dashboards with an emphasis on clarity and engagement for young learners.',
  'Schoolr Education Technologies',
  'Senior UI/UX Designer',
  '12 weeks',
  'Figma, FigJam, Maze (user testing)',
  'UX Research Report, Information Architecture, Wireframes, Full UI Design (3 user roles), Interactive Prototype, Design System',
  'Schoolr''s existing platform had been built feature-first, resulting in a cluttered interface that overwhelmed students and confused parents. Teacher adoption was low because lesson creation tools were buried and unintuitive. Engagement metrics for students dropped sharply after the first week of use.',
  'We ran discovery workshops with students, teachers, and parents to map actual workflows versus assumed ones. The information architecture was completely restructured around three role-specific experiences: a gamified, task-focused view for students; a streamlined lesson and grade management hub for teachers; and a simple progress monitoring dashboard for parents. A child-friendly illustration system and warm color palette made the student interface feel welcoming rather than institutional. All interactions were tested with real users at the wireframe stage before any visual design work began.',
  'Student weekly active usage increased by 92% after launch. Teacher satisfaction score rose from 2.9 to 4.7 out of 5. Parent app downloads increased 340% in the first month. The platform was shortlisted for an EdTech innovation award. Schoolr secured a $2M seed round six weeks after the redesigned platform launched, with the new UX cited in their pitch deck.',
  'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800","https://images.unsplash.com/photo-1558021212-51b6ecfa0db9?w=800","https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=800"]',
  true, true, 11
),

-- 12. Print Design
(
  'Norde Studio — Brand Brochure',
  'norde-studio-brand-brochure',
  'Print Design',
  'A 24-page capabilities brochure for an architecture and interior design studio, designed as a tactile, high-quality print piece that doubles as a portfolio showcase.',
  'Norde Studio',
  'Print & Editorial Designer',
  '3 weeks',
  'Adobe InDesign, Adobe Illustrator, Adobe Photoshop',
  '24-Page Brochure (Print-Ready), Digital PDF Version, Custom Grid System, Cover Variants (2)',
  'Norde Studio was pitching for high-value residential and commercial projects where first impressions are decisive. Their previous collateral consisted of emailed PDF portfolios that failed to communicate the tactile quality of their actual work. They needed something clients would keep on their desk.',
  'The brochure was designed around the studio''s own principles: precision, restraint, and material quality. A tight grid system with generous margins created an editorial rhythm that let the photography breathe. The cover was designed for a special print finish — soft-touch laminate with a spot UV treatment on the logo mark. Project spreads paired full-bleed photography with carefully considered caption typography that gave context without over-explaining. Paper specification recommendations were provided to the printer to ensure the finished product matched the design intent.',
  'The first print run of 200 copies was distributed at an industry event where Norde secured 3 project inquiries on the same day. Two of those converted to signed contracts. The studio''s principal said it was "the first piece of collateral we''ve been proud to hand to a client." A second print run of 500 was ordered within 6 weeks.',
  'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1200',
  NULL,
  '["https://images.unsplash.com/photo-1497366216548-37526070297c?w=800","https://images.unsplash.com/photo-1524758631624-e2822e304c36?w=800","https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=800"]',
  false, true, 12
);
