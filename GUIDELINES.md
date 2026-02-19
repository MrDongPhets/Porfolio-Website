# MustardDigital — Project Guidelines

> Follow these rules for every new file, feature, or fix. The goal is a consistent, maintainable codebase where any file is predictable before you open it.

---

## 1. Project Structure

```
Portfolio-Website/
├── config/
│   ├── config.php          ← App bootstrap (session, env, helpers)
│   └── database.php        ← SupabaseClient class (DB abstraction)
│
├── includes/
│   ├── functions.php       ← All shared helper functions
│   ├── site-header.php     ← Public page <head> + nav
│   └── site-footer.php     ← Public page footer + scripts
│
├── admin/
│   ├── includes/
│   │   ├── header.php      ← Admin sidebar + head
│   │   └── footer.php      ← Admin closing scripts
│   └── [page].php          ← One file per admin section
│
├── css/                    ← ONE file per page/section (see Rule #2)
├── js/                     ← Shared JS only (see Rule #3)
├── assets/
│   ├── uploads/            ← Legacy local uploads (prefer Supabase)
│   └── [static images]
│
├── assets/
│   ├── sql/
│   │   ├── dumpsql.txt         ← Full DB schema dump (reference only)
│   │   └── portfolio-schema.sql← Portfolio ALTER TABLE + seed INSERT queries
│   ├── uploads/            ← Legacy local uploads (prefer Supabase)
│   └── [static images]
│
├── [page].php              ← One public page per file (root level)
├── .env                    ← Never commit. Copy from .env.example
└── GUIDELINES.md           ← This file
```

---

## 2. CSS Rules — Most Important

### One CSS file per page. No inline `<style>` blocks in PHP files.

Every public page has a dedicated CSS file in `css/`. The filename matches the PHP file.

| PHP file | CSS file |
|---|---|
| `index.php` | `css/style.css` + `css/style-modern.css` |
| `portfolio.php` | `css/portfolio.css` |
| `portfolio-detail.php` | `css/portfolio-detail.css` ← **must be created** |
| `about.php` | `css/about.css` |
| `contact.php` | `css/contact.css` |
| `services.php` | `css/services.css` |
| `web-design.php` etc. | `css/service-detail.css` (shared) |
| admin pages | `css/admin.css` (shared) |

### How to load CSS

All CSS is loaded in `includes/site-header.php` using `asset_version()` for cache-busting:

```php
<link rel="stylesheet" href="<?php echo asset_version('css/portfolio-detail.css'); ?>">
```

Do **not** hardcode the version number. Do **not** use a `<style>` tag in the page file.

### What goes in each CSS file

- `css/style.css` — CSS variables, typography, base resets, utility classes. **Do not touch unless adding a global variable.**
- `css/style-modern.css` — Shared modern components: buttons, badges, section titles, CTA blocks. **Add reusable components here.**
- `css/[page].css` — Page-specific layout and components only. Nothing here should be reused elsewhere.

### CSS variable reference

Always use variables instead of raw values:

```css
/* Colors */
var(--primary)          /* #184d37  — dark green */
var(--accent)           /* #c9a84c  — gold */
var(--text)             /* page text */
var(--text-muted)       /* secondary text */
var(--bg-card)          /* card backgrounds */
var(--border)           /* borders and dividers */

/* Dark mode auto-handled */
[data-theme="dark"] .my-class { color: #f0ede8; }
```

---

## 3. JavaScript Rules

### Shared JS lives in `js/index.js`. Page-specific JS goes at the bottom of the PHP file.

- `js/index.js` — loaded on every page via `site-footer.php`. Only put code here that is truly global (testimonial carousel, contact form AJAX, scroll effects).
- Page-specific interactions (e.g., a carousel only on one page, a modal only on one page) go in a `<script>` block at the **bottom of that PHP file**, just before `include 'includes/site-footer.php'`.
- Never put JavaScript inside `<head>`.
- Never use `onclick=""` attributes in HTML. Use `addEventListener` in your script block instead.

```php
<!-- Bottom of page.php, before footer include -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // page-specific JS here
});
</script>

<?php include 'includes/site-footer.php'; ?>
```

---

## 4. PHP Page Structure

Every public PHP page follows this exact order:

```php
<?php
// 1. Bootstrap
require_once 'config/config.php';

// 2. Page meta
$pageTitle = 'Page Title';

// 3. Data fetching — use $db (anon key, public reads)
$result = $db->select('table', '*', ['is_active' => true], 'display_order.asc');
$items = ($result['success'] && !empty($result['data'])) ? $result['data'] : [];

// 4. Header (outputs <html>, <head>, <nav>)
include 'includes/site-header.php';
?>

<!-- 5. Page HTML -->
<section>...</section>

<!-- 6. Page-specific JS (if needed) -->
<script>
// ...
</script>

<!-- 7. Footer (outputs footer, AOS init, global scripts) -->
<?php include 'includes/site-footer.php'; ?>
```

**Rules:**
- Public pages use `$db` (anon key). Admin pages use `getAdminDb()` (service key).
- Always check `$result['success']` before using `$result['data']`.
- Always escape output with `e()`. Never echo raw DB values.
- Always sanitize POST input with `clean()` before using or storing it.

---

## 5. Admin Page Structure

```php
<?php
require_once '../config/config.php';
requireLogin();                     // ← always first after bootstrap

$pageTitle = 'Section Name';
$adminDb = getAdminDb();            // ← service key for all writes

// Handle POST actions at the top, before any HTML output
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // AJAX responses: wrap in ob_start()/ob_end_clean() then exit
    // Regular form actions: use redirect() after setFlash()
}

// Fetch data for display
$result = $adminDb->select('table', '*', [], 'created_at.desc');

include 'includes/header.php';
?>

<!-- HTML + inline <style> is acceptable in admin pages (no separate CSS file needed) -->

<?php include 'includes/footer.php'; ?>
```

---

## 6. Database Conventions

### Reading data

```php
// Public page — anon key, respects RLS (only sees is_active = true rows)
$result = $db->select('portfolio_items', '*', ['is_active' => true], 'display_order.asc');

// Admin page — service key, bypasses RLS, sees everything
$result = $adminDb->select('portfolio_items', '*', [], 'created_at.desc');
```

### Writing data

```php
// Always check result
$result = $adminDb->insert('portfolio_items', $data);
if ($result['success']) {
    setFlash('success', 'Saved!');
} else {
    setFlash('error', 'Failed to save');
}
redirect('/admin/portfolio.php');
```

### Filter syntax

```php
// Equality
['is_active' => true, 'category' => 'Branding']

// Operators (gt, lt, gte, lte, neq, like, ilike)
['display_order' => ['gt', 0]]
```

### Order syntax

```php
'display_order.asc'              // single column
'is_featured.desc,created_at.desc'  // multiple columns
```

---

## 7. Image & File Uploads

- **All uploads go to Supabase Storage** via `uploadFileToSupabase($file, 'MUSTARD', 'folder')`.
- **Folder naming:** use the section name — `portfolio`, `portfolio/gallery`, `hero`, `about`, `services`.
- **Store only the public URL** in the database (the full `https://...` URL).
- **Always display with** `getImageUrl($path)` — this handles both Supabase URLs and legacy local paths.
- **Max size:** 5MB. Allowed types: jpeg, png, gif, webp.

```php
// Upload pattern
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload = uploadFileToSupabase($_FILES['image'], 'MUSTARD', 'portfolio');
    if ($upload['success']) {
        $image_url = $upload['url'];
    } else {
        setFlash('error', 'Upload failed: ' . $upload['error']);
        redirect('/admin/portfolio.php');
    }
}
```

---

## 8. Adding a New Page — Checklist

- [ ] Create `[page].php` in the project root (public) or `admin/[page].php` (admin)
- [ ] Create `css/[page].css` with page-specific styles
- [ ] Add `<link rel="stylesheet" href="<?php echo asset_version('css/[page].css'); ?>">` to `includes/site-header.php`
- [ ] Follow the PHP page structure from Rule #4
- [ ] Add the page link to the navigation in `includes/site-header.php` if it needs a nav entry
- [ ] If the page has an admin counterpart, add it to the admin sidebar in `admin/includes/header.php`

---

## 9. Things to Never Do

| ❌ Don't | ✅ Do instead |
|---|---|
| `<style>` block inside a PHP page | Separate `css/[page].css` file |
| `echo $_GET['id']` | `echo e($_GET['id'])` |
| `$db->select(...)` in admin | `$adminDb->select(...)` |
| `header('Location: ...')` without `exit` | Always `exit` after redirect |
| Hardcode Supabase URLs in PHP | Use `getenv('SUPABASE_URL')` |
| Commit `.env` | It is in `.gitignore` — keep it there |
| `style="..."` inline for layout | Add a CSS class in `css/[page].css` |
| `onclick="fn()"` in HTML | `el.addEventListener('click', fn)` |
| `var_dump()` or `dd()` in production | Remove before deploy |

---

## 10. Known Technical Debt

These are things that exist but should be fixed when there is time:

- ~~`portfolio-detail.php` — page CSS is inline (`<style>` block). Should be extracted to `css/portfolio-detail.css` and loaded via `site-header.php`.~~ ✓ Done — extracted to `css/portfolio-detail.css`.
- `index.php` — testimonials section uses hardcoded data in `js/index.js` instead of fetching from the `testimonials` DB table.
- `admin/` debug files (`debug.php`, `debug-hero.php`, `create-user-debug.php`, `check-db.php`) — should be deleted before any public deployment.
- Several service detail pages (`branding.php`, `web-design.php`, etc.) use fully static content — not connected to the `services` DB table.
