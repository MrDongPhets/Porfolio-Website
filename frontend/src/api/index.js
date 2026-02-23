/**
 * src/api/index.js
 * All API calls go through here — never call fetch() directly in a component.
 */

const BASE = '/api';

async function request(url) {
  const res = await fetch(url);
  if (!res.ok) {
    const err = await res.json().catch(() => ({ error: res.statusText }));
    throw new Error(err.error || `Request failed: ${res.status}`);
  }
  return res.json();
}

/** GET /api/home.php — all homepage data in one request */
export function getHomeData() {
  return request(`${BASE}/home.php`);
}

/** GET /api/portfolio.php — all portfolio items + categories
 *  @param {string} category — optional category filter ('all' or a category name)
 */
export function getPortfolio(category = 'all') {
  const params = category && category !== 'all'
    ? `?category=${encodeURIComponent(category)}`
    : '';
  return request(`${BASE}/portfolio.php${params}`);
}

/** GET /api/portfolio-detail.php?id= — single item + related */
export function getPortfolioDetail(id) {
  return request(`${BASE}/portfolio-detail.php?id=${encodeURIComponent(id)}`);
}

/** GET /api/services.php — all active services */
export function getServices() {
  return request(`${BASE}/services.php`);
}

/** GET /api/testimonials.php — active testimonials
 *  @param {number} limit — optional limit
 */
export function getTestimonials(limit = null) {
  const params = limit ? `?limit=${limit}` : '';
  return request(`${BASE}/testimonials.php${params}`);
}

/** POST /api/contact.php — submit contact form
 *  @param {{ name, email, phone, service, message, newsletter }} data
 */
export async function submitContact(data) {
  const res = await fetch(`${BASE}/contact.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams(data).toString(),
  });
  if (!res.ok) {
    const err = await res.json().catch(() => ({}));
    throw new Error(err.errors?.join(', ') || err.error || 'Failed to send message');
  }
  return res.json();
}
