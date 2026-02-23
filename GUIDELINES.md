# MustardDigital — Project Guidelines

> Follow these rules for every new file, feature, or fix. The goal is a consistent, maintainable codebase where any file is predictable before you open it.

---

## Architecture Overview

This project is being migrated from **PHP server-rendered pages** to a **decoupled architecture**:

| Layer | Technology | Hosted on |
|---|---|---|
| **Frontend** | React (Vite) | Hostinger — `public_html/` |
| **Backend API** | PHP Native (JSON only) | Hostinger — `public_html/api/` |
| **Database** | Supabase (PostgreSQL via REST) | Supabase cloud |
| **File Storage** | Supabase Storage | Supabase cloud |
| **Admin Panel** | PHP (stays as-is) | Hostinger — `public_html/admin/` |

Same domain, no CORS needed. React fetches from `/api/*.php`.

---

## Final Folder Structure (Target)

```
public_html/                        ← Hostinger root
│
├── index.html                      ← React build entry point
├── assets/                         ← React build output (JS/CSS chunks)
│   └── [hashed bundles]
│
├── api/                            ← PHP API layer (JSON responses only)
│   ├── portfolio.php               ← GET /api/portfolio.php
│   ├── portfolio-detail.php        ← GET /api/portfolio-detail.php?id=...
│   ├── services.php                ← GET /api/services.php
│   ├── about.php                   ← GET /api/about.php
│   └── contact.php                 ← POST /api/contact.php
│
├── admin/                          ← PHP admin panel (unchanged)
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   └── [page].php
│
├── config/                         ← Shared PHP config (used by api/ and admin/)
│   ├── config.php
│   └── database.php
│
├── includes/                       ← Shared PHP helpers (used by api/ and admin/)
│   └── functions.php
│
├── assets/sql/                     ← DB schema and seed files (reference only)
│   ├── dumpsql.txt
│   └── portfolio-schema.sql
│
├── .env                            ← Never commit
├── .htaccess                       ← React Router + API routing rules
└── GUIDELINES.md
```

### React Source (separate repo or `/src` folder during dev)

```
src/
├── api/                            ← All fetch calls in one place
│   └── index.js
├── components/                     ← Reusable components
│   ├── Navbar.jsx
│   ├── Footer.jsx
│   └── [Component].jsx
├── pages/                          ← One component per route
│   ├── Home.jsx
│   ├── Portfolio.jsx
│   ├── PortfolioDetail.jsx
│   ├── Services.jsx
│   ├── About.jsx
│   └── Contact.jsx
├── styles/                         ← CSS files (mirrors current css/ folder)
│   ├── global.css                  ← Variables, resets (from style.css)
│   └── [page].css
├── App.jsx                         ← Route definitions
└── main.jsx                        ← Entry point
```

---

## PHP API Rules

### Every API file follows this structure

```php
<?php
// api/portfolio.php
header('Content-Type: application/json');
require_once '../config/config.php';

// GET handler
$result = $db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc');
echo json_encode($result['data'] ?? []);
```

### POST (e.g. contact form)

```php
<?php
header('Content-Type: application/json');
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$name  = clean($_POST['name'] ?? '');
$email = clean($_POST['email'] ?? '');
// ... handle and respond
echo json_encode(['success' => true]);
```

### API rules

- **Never output HTML** from any `api/` file — JSON only.
- **Always wrap AJAX handlers in** `ob_start()/ob_end_clean()` to prevent PHP notices from corrupting JSON.
- **Use `$db`** (anon key) for public endpoints. **Use `getAdminDb()`** only in `admin/`.
- **Always set** `header('Content-Type: application/json')` before any output.
- **Return consistent shapes:** `{ data: [] }` for lists, `{ data: {} }` for single items, `{ error: 'message' }` on failure.

---

## React Rules

### Fetching data

All API calls go through `src/api/index.js` — never call `fetch()` directly in a component:

```js
// src/api/index.js
const BASE = '/api';

export async function getPortfolio() {
  const res = await fetch(`${BASE}/portfolio.php`);
  if (!res.ok) throw new Error('Failed to fetch portfolio');
  return res.json();
}

export async function getPortfolioDetail(id) {
  const res = await fetch(`${BASE}/portfolio-detail.php?id=${encodeURIComponent(id)}`);
  if (!res.ok) throw new Error('Not found');
  return res.json();
}
```

### CSS

- Keep the same CSS variable names from the PHP project (`--primary`, `--accent`, etc.).
- Import the global CSS in `main.jsx`.
- Each page component imports its own CSS file: `import './styles/portfolio.css'`.
- No inline `style={{}}` for layout — use CSS classes.

### Routing

```jsx
// App.jsx
import { BrowserRouter, Routes, Route } from 'react-router-dom';

<BrowserRouter>
  <Routes>
    <Route path="/"                  element={<Home />} />
    <Route path="/portfolio"         element={<Portfolio />} />
    <Route path="/portfolio/:id"     element={<PortfolioDetail />} />
    <Route path="/services"          element={<Services />} />
    <Route path="/about"             element={<About />} />
    <Route path="/contact"           element={<Contact />} />
  </Routes>
</BrowserRouter>
```

### .htaccess (required for React Router on Hostinger)

```apache
RewriteEngine On

# Let /api/ requests go to PHP
RewriteCond %{REQUEST_URI} !^/api/

# Let /admin/ requests go to PHP
RewriteCond %{REQUEST_URI} !^/admin/

# Pass real files and folders through
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Everything else → React index.html
RewriteRule ^ /index.html [L]
```

---

## Database Conventions (unchanged)

```php
// Public API — anon key, respects RLS
$db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc');

// Admin — service key, bypasses RLS
$adminDb->select('portfolio_items', '*', [], 'created_at.desc');

// Filter operators: gt, lt, gte, lte, neq, like, ilike
['display_order' => ['gt', 0]]

// Order: 'column.asc' or 'col1.desc,col2.asc'
```

---

## Image & File Uploads (unchanged)

- All uploads via `uploadFileToSupabase($file, 'MUSTARD', 'folder')` in PHP admin.
- Store only the public URL in the database.
- In React, render the URL directly — no helper needed.

---

## Things to Never Do

| ❌ Don't | ✅ Do instead |
|---|---|
| Output HTML from `api/` files | JSON only — `echo json_encode(...)` |
| Call `fetch()` directly in a component | Use `src/api/index.js` functions |
| Use inline `style={{}}` for layout in React | Add a CSS class |
| Use `onclick=""` in JSX | `onClick={handler}` prop |
| Commit `.env` | It is in `.gitignore` |
| `echo $_GET['id']` unescaped | `echo e($_GET['id'])` |
| `$db->select()` in admin | `$adminDb->select()` |
| Output before `header()` calls | `ob_start()/ob_end_clean()` around all AJAX |

---

## Known Technical Debt

- `index.php` — testimonials section uses hardcoded data in `js/index.js` instead of fetching from the `testimonials` DB table. *(Will be resolved in React migration — Phase 3)*
- `admin/` debug files (`debug.php`, `debug-hero.php`, `create-user-debug.php`, `check-db.php`) — delete before any public deployment.
- Several service detail pages (`branding.php`, `web-design.php`, etc.) use fully static content — not connected to the `services` DB table. *(Will be resolved in React migration — Phase 3)*

---

---

# Migration Roadmap — PHP → React + PHP API

> Work through each phase in order. Do not start Phase N+1 until Phase N is complete and tested.

---

## Phase 1 — Build the PHP API Layer
**Goal:** Create all `/api/*.php` files that return JSON. The old PHP pages stay untouched.

- [ ] Create `api/` folder
- [ ] `api/portfolio.php` — returns all active portfolio items as JSON array
- [ ] `api/portfolio-detail.php` — returns single item by `?id=`, includes related items
- [ ] `api/services.php` — returns all active services
- [ ] `api/about.php` — returns team members, values (if stored in DB)
- [ ] `api/contact.php` — accepts POST, saves to DB or sends email, returns `{success: true}`
- [ ] `api/testimonials.php` — returns active testimonials
- [ ] Test every endpoint in browser / Postman before moving on

---

## Phase 2 — Set Up the React Project
**Goal:** Scaffold a working React app with routing, CSS variables, and API utilities.

- [ ] Initialise project: `npm create vite@latest mustard-frontend -- --template react`
- [ ] Install dependencies: `npm install react-router-dom`
- [ ] Create `src/api/index.js` with all fetch functions (one per API endpoint)
- [ ] Copy `css/style.css` CSS variables into `src/styles/global.css`
- [ ] Import `global.css` in `main.jsx`
- [ ] Set up `App.jsx` with `BrowserRouter` and all routes (empty page stubs)
- [ ] Build `Navbar.jsx` and `Footer.jsx` components (port from `site-header.php` / `site-footer.php`)
- [ ] Confirm dev server runs and routes resolve: `npm run dev`

---

## Phase 3 — Migrate Pages One by One
**Goal:** Replace each page stub with real content. Port HTML + CSS from PHP to JSX + CSS.

Migrate in this order (simplest → most complex):

- [ ] **Contact page** — form + `api/contact.php` POST
- [ ] **Services page** — fetch from `api/services.php`, render service cards
- [ ] **About page** — static content + Mission/Vision/Values sections (mostly HTML port)
- [ ] **Portfolio list** — fetch from `api/portfolio.php`, category filter, grid + carousel
- [ ] **Portfolio detail** — fetch by ID from `api/portfolio-detail.php`, case study layout
- [ ] **Home page** — hero, stats, portfolio showcase (fetch 6 featured items), testimonials, CTA

For each page:
1. Port the HTML structure from PHP → JSX
2. Move the CSS file to `src/styles/[page].css` and import it in the component
3. Replace PHP data variables with `useState` + `useEffect` fetching from the API
4. Test the page fully before moving to the next

---

## Phase 4 — Polish & QA
**Goal:** Make sure the React app matches the current PHP site in quality and behaviour.

- [ ] AOS (Animate on Scroll) — install `aos` npm package and initialise in `App.jsx`
- [ ] FontAwesome — add CDN link to `index.html` or install `@fortawesome/react-fontawesome`
- [ ] Page titles — use `document.title` or install `react-helmet-async` per page
- [ ] 404 page — add a `<Route path="*">` catch-all
- [ ] Loading states — show skeleton/spinner while API data loads
- [ ] Error states — show user-friendly message if API call fails
- [ ] Mobile responsive — verify every page at 375px, 768px, 1280px
- [ ] Dark mode — port `[data-theme="dark"]` toggle logic to React state

---

## Phase 5 — Deploy to Hostinger
**Goal:** Ship the React build alongside the PHP API on the same domain.

- [ ] Run `npm run build` — output goes to `dist/`
- [ ] Upload contents of `dist/` to Hostinger `public_html/`
- [ ] Upload `api/` folder to `public_html/api/`
- [ ] Upload `config/`, `includes/`, `admin/`, `.env` to their respective locations
- [ ] Create / update `.htaccess` in `public_html/` (see React Router rules above)
- [ ] Verify all routes work (refresh on `/portfolio` should not 404)
- [ ] Verify all API endpoints respond correctly in production
- [ ] Delete `admin/debug*.php` and `admin/check-db.php` before going live
- [ ] Smoke test: Home → Portfolio → Detail → Contact form submit → About

---

## Current Status

| Phase | Status |
|---|---|
| Phase 1 — PHP API Layer | ✅ Done |
| Phase 2 — React Scaffold | ✅ Done |
| Phase 3 — Page Migration | ✅ Done |
| Phase 4 — Polish & QA | ⬜ Not started |
| Phase 5 — Deploy | ⬜ Not started |
