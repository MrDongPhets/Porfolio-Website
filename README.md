# MUSTARD Digitals — Portfolio Website

A full-stack portfolio website for MUSTARD Digitals, a creative design studio. Built with a React frontend and a PHP REST API backend connected to Supabase (PostgreSQL).

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Frontend** | React 18 (Vite) |
| **Routing** | React Router v6 |
| **Animations** | AOS (Animate on Scroll) |
| **Icons** | Font Awesome 6 (CDN) |
| **Backend API** | PHP 8+ (Native, JSON only) |
| **Database** | Supabase (PostgreSQL via REST) |
| **Storage** | Supabase Storage |
| **Admin Panel** | PHP (separate, unchanged) |
| **Hosting** | Hostinger (shared) |

---

## Project Structure

```
Portfolio-Website/
│
├── frontend/                   ← React app (Vite)
│   ├── src/
│   │   ├── api/
│   │   │   └── index.js        ← All fetch calls in one place
│   │   ├── components/
│   │   │   ├── Navbar.jsx
│   │   │   ├── Footer.jsx
│   │   │   └── ScrollToTop.jsx
│   │   ├── pages/
│   │   │   ├── Home.jsx
│   │   │   ├── About.jsx
│   │   │   ├── Services.jsx
│   │   │   ├── Portfolio.jsx
│   │   │   ├── PortfolioDetail.jsx
│   │   │   ├── Contact.jsx
│   │   │   ├── NotFound.jsx
│   │   │   └── services/
│   │   │       ├── ServiceDetailLayout.jsx
│   │   │       ├── WebDesign.jsx
│   │   │       ├── Branding.jsx
│   │   │       ├── VideoEditing.jsx
│   │   │       ├── ContentCreation.jsx
│   │   │       └── AdminSupport.jsx
│   │   ├── styles/             ← CSS files per page
│   │   ├── App.jsx             ← Route definitions
│   │   └── main.jsx            ← Entry point
│   ├── index.html
│   └── vite.config.js
│
├── api/                        ← PHP REST API (JSON only)
│   ├── home.php                ← GET  /api/home
│   ├── portfolio.php           ← GET  /api/portfolio
│   ├── portfolio-detail.php    ← GET  /api/portfolio-detail?id=
│   ├── services.php            ← GET  /api/services
│   ├── testimonials.php        ← GET  /api/testimonials
│   └── contact.php             ← POST /api/contact
│
├── admin/                      ← PHP admin panel (CMS)
│   ├── includes/
│   ├── index.php               ← Dashboard
│   ├── hero.php
│   ├── about.php
│   ├── portfolio.php
│   ├── services.php
│   └── login.php / logout.php
│
├── config/
│   ├── config.php              ← App config, constants
│   └── database.php            ← Supabase REST client
│
├── includes/
│   └── functions.php           ← Shared PHP helpers
│
├── assets/
│   ├── uploads/                ← Locally uploaded files
│   ├── sql/                    ← DB schema and seed files
│   └── [images]
│
├── .env                        ← Never commit
├── .htaccess                   ← React Router + API routing
└── GUIDELINES.md               ← Development guidelines
```

---

## Features

### Public Website
- Dynamic hero, about, and services sections (CMS-managed)
- Portfolio gallery with category filter and featured carousel
- Individual case study pages with gallery and related projects
- 5 service detail pages (Web Design, Branding, Video Editing, Content Creation, Admin Support)
- Contact form with database storage
- Client testimonials
- Dark/light theme toggle (no flash on load)
- AOS scroll animations
- Fully responsive

### Admin Panel
- Secure login with session management
- Manage hero, about, services, portfolio, testimonials
- Contact message inbox
- Image uploads via Supabase Storage
- Site settings

---

## Local Development

### Prerequisites
- Node.js 18+
- PHP 8+ with a local web server (e.g. XAMPP, Laragon, Herd)
- Supabase project

### 1. Clone the repo

```bash
git clone https://github.com/MrDongPhets/Porfolio-Website.git
cd Portfolio-Website
```

### 2. Set up environment

Copy `.env` and fill in your credentials:

```env
SUPABASE_URL=https://your-project.supabase.co
SUPABASE_KEY=your_anon_key
SUPABASE_SERVICE_KEY=your_service_role_key
SITE_URL=http://portfolio.localhost
ADMIN_EMAIL=admin@yourdomain.com
```

### 3. Set up the database

Run the SQL schema from `assets/sql/dumpsql.txt` in the Supabase SQL Editor.

### 4. Start the React dev server

```bash
cd frontend
npm install
npm run dev
```

The Vite proxy in `vite.config.js` forwards `/api` requests to your local PHP server automatically — no CORS issues.

### 5. Access admin

Navigate to `http://portfolio.localhost/admin` and log in.

---

## Deployment (Hostinger)

1. Build the React app:
   ```bash
   cd frontend
   npm run build
   ```

2. Upload the **contents** of `frontend/dist/` to `public_html/`

3. Upload the `api/` folder to `public_html/api/`

4. Ensure `.htaccess` in `public_html/` contains React Router rules:
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_URI} !^/api/
   RewriteCond %{REQUEST_URI} !^/admin/
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^ /index.html [L]
   ```

5. Verify all routes work (refresh on `/portfolio` should not 404)

---

## Security

- RLS policies on Supabase — public users can only read active content
- Admin panel uses service role key (bypasses RLS)
- bcrypt password hashing
- CSRF protection on admin forms
- XSS prevention via output escaping
- File upload validation (type + size)

---

## Author

**MUSTARD Digitals**
- Website: [mustarddigitals.com](https://mustarddigitals.com/)
- Email: hello@mustarddigitals.com

---

Made with ❤️ by MUSTARD Digitals
