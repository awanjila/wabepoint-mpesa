# SEO: LPG/Gas Keywords + Site-wide Keyword Strengthening + Dynamic Sitemap

**Date**: 2026-09-23
**Status**: Draft
**Type**: Feature (SEO)

## Overview

Improve organic visibility of the WabePoint marketing site (`wabepoint.com`) by:

1. Adding a new **Gas/LPG landing page** targeting LPG retailers and cooking-gas shops in Kenya.
2. **Strengthening keywords** on every existing page (fill missing `seo` fields, refresh industry keyword targeting).
3. Replacing the **static `public/sitemap.xml`** with a **dynamic sitemap** that auto-includes all public routes plus blog posts.

Reference: the Redline site's SEO approach (shared meta via route-level `seo` arrays + dynamic `SitemapController`).

## Current State (as-is)

- Root view `resources/views/app.blade.php` already renders server-side meta (title, description, keywords, canonical, OG, Twitter, JSON-LD) from `$page['props']['seo']`. Good foundation — per-page `seo` arrays in `routes/web.php` drive it.
- Vue pages additionally render `<Head>` blocks (duplicate meta tags exist); **out of scope** to remove this round.
- `public/sitemap.xml` is hand-maintained and missing pages and blog posts.
- No gas/LPG landing page exists; nav + homepage industries cover cosmetics/hardware/paint/restaurants/offices only.
- About, Partners, Resources, Support, SuccessStories lack `keywords`/`canonical`; cosmetics/hardware/restaurants/offices lack `keywords`.

## 1. New Gas/LPG Landing Page

**Route**: `GET /gas` → `Inertia::render('Landing/GasPOS', [...])`

New Vue page `resources/js/Pages/Landing/GasPOS.vue` modeled on `PaintShopPOS.vue` (same visual language: hero, industries features, pricing teaser, how-it-works, FAQ, final CTA, `<Footer/>`). Reuses `Navigation.vue` + `Footer.vue`.

**SEO array**:
```php
'seo' => [
    'title' => 'Gas Shop POS System Kenya - WabePoint | LPG Cylinder & Refill Management',
    'description' => 'POS system built for gas companies and LPG retailers in Kenya. Track cylinder stock and deposits, manage refills, take M-Pesa and cash, record credit sales, and see daily profits. Works offline. Setup in 1 hour.',
    'keywords' => 'gas shop pos, gas company pos kenya, lpg management system, cooking gas pos, lpg cylinder tracking, gas refill software, gas outlet management, mpesa gas payments, gas shop stock management nairobi, wabepoint gas, pos for gas companies, lpg distributor software',
    'canonical' => 'https://wabepoint.com/gas',
    'type' => 'website',
],
```

**Page content themes** (copy written around these, with gas terms used naturally):
- Cylinder stock and deposit tracking (customer cylinder deposits on swaps/refills)
- Refill sales (weight/size variants — 13kg, 6kg, 3kg)
- M-Pesa + cash, split payments
- Credit sales & outstanding-credit collection (ties to the GASPOS credit-repayment feature)
- Offline-first sales, auto-sync
- Daily sales/profit reports, stock alerts (cylinder returns/expiry)
- KRA eTIMS compliance
- FAQ: "Can it track cylinder deposits?", "Does it work offline?", "Can customers pay by M-Pesa?", "How fast is setup?"

**Navigation & homepage integration**:
- `resources/js/Components/Navigation.vue`: add "Gas" link to desktop POS dropdown + mobile menu.
- `resources/js/Pages/Landing.vue`: add gas entry to the `industries` array (icon: flame) so the homepage highlights it; update nav + hero sub-copy copy to mention gas companies.
- Homepage default `keywords` (route `/`) updated to include gas terms (see section 2).

## 2. Strengthen Keywords on All Pages

Rewrite the `seo` arrays in `routes/web.php`. New targets per route:

| Route | Change |
|-------|--------|
| `/` | Add gas + all-industry keywords; refresh description to mention gas companies |
| `/pricing` | Keep existing (strong); add gas retailer mention |
| `/about` | Add `keywords` + `canonical` |
| `/partners` | Add `keywords` + `canonical` |
| `/resources` | Add `keywords` + `canonical` |
| `/success-stories` | Add `keywords` + `canonical` |
| `/support` | Add `keywords` + `canonical` |
| `/cosmetics` | Add `keywords` (cosmetics/salon/beauty terms) |
| `/hardware` | Add `keywords` (hardware/building-materials terms) |
| `/restaurants` | Add `keywords` (restaurant/café/kitchen terms) |
| `/offices` | Add `keywords` (invoicing/expense/PO terms) |
| `/paintshops` | Keep (already strong), minor keyword refresh ok |
| `/point-of-sale-system-kenya` | Keep (already strong) |
| `/gas` | New (section 1) |

Also update fallback defaults to include gas terms so any page without an override still targets the industry:
- `config/seo.php` `defaults.title/description/keywords`
- `resources/views/app.blade.php` `$defaultTitle/$defaultDesc/$defaultKeywords`

Exact keyword strings finalized during implementation (drafted per page, one keyword set per page, no stuffing).

## 3. Dynamic Sitemap

**Controller**: `app/Http/Controllers/SitemapController.php`

`index()` builds an explicit **whitelist** (not route enumeration — the site mixes public marketing routes with auth/admin/blog-admin routes that must not leak):
- Static public paths with priorities/changefreq (mirror of current `public/sitemap.xml` + `/point-of-sale-system-kenya`, `/success-stories`, `/support`, `/news`, and new `/gas`).
- Dynamic blog posts: `Blog::latest()->get()` → `/blogs/{slug}` with `priority 0.6`, `changefreq monthly`, `lastmod` from `updated_at`.
- Success stories live in the blog category `customer-stories` and are already covered by `/blogs/{slug}`; keep `/success-stories` static entry as before.

**View**: `resources/views/sitemap.blade.php` (mirror Redline's simple XML template).

**Route**: `Route::get('sitemap.xml', [SitemapController::class, 'index'])` → `response()->view(...)->header('Content-Type', 'text/xml')`.

**IMPORTANT**: Delete `public/sitemap.xml` — with `try_files $uri $uri/ /index.php?$query_string` the static file wins over the route, so the dynamic route would never be served while it exists.

`public/robots.txt` already points to `https://wabepoint.com/sitemap.xml`; no change needed.

## Out of Scope (this round)

- Removing duplicated `<Head>` meta from Vue pages (noted as follow-up).
- Publishing the gas blog article to the marketing site blog (content already drafted in the KRA repo; can seed later).
- Google Search Console verification / GA4 changes.

## Verification

1. `php artisan route:list | grep sitemap` — route registered.
2. `php artisan serve` + curl:
   - `curl -s localhost:8000/sitemap.xml` returns XML, includes `/gas` and at least one `/blogs/...`, `Content-Type: text/xml`.
   - `curl -s localhost:8000/gas` returns 200 and contains gas keywords in `<meta name="keywords">`.
3. `npm run build` passes (no Vue errors).
4. Manual: `/gas` renders correctly; nav (desktop + mobile) links to it; homepage industries card links to it; canonical/OG tags correct per page via `view-source`.
5. No `public/sitemap.xml` remains (confirm 404 is NOT returned for `/sitemap.xml`).