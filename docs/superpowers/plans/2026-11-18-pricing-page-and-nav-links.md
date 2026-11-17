# Pricing Page And Nav Links Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Make the `/pricing` cards tidy and non-modal, and make the three dropdown nav labels navigate when clicked.

**Architecture:** Both changes are template-only edits in two shared Vue components. `Navigation.vue` is used on every page; `Pricing.vue` is used only by the `/pricing` route. After the edits, client and SSR bundles are rebuilt and all static HTML is regenerated for the cPanel host.

**Tech Stack:** Laravel 10, Vue 3, Inertia, Tailwind CSS, Vite, pre-rendered static HTML.

**Spec:** `docs/superpowers/specs/2026-11-18-pricing-page-and-nav-links-design.md`

## Global Constraints

- Do not change plan names, prices, features, comparison table, FAQs, SEO metadata or the homepage pricing teaser.
- Keep the hover dropdown panels in the navigation; only the top-level labels change from buttons to links.
- Navigation destinations: Point Of Sale → `/point-of-sale-system-kenya`, Our Services → `/point-of-sale-system-kenya`, Resources → `/pos-systems-in-kenya-news`.
- Live hosting serves pre-rendered `public/*/index.html`; bundles and HTML must be regenerated after the edits.
- Never commit `public/hot` or `bootstrap/ssr/`.
- Verification note: `php artisan serve` ignores `.htaccess` and serves pre-rendered HTML for `X-Inertia` XHRs, so nav clicks appear broken there. Verify the X-Inertia rewrite through an Apache-equivalent server or a temporary PHP router that forwards `X-Inertia` requests to `index.php`; the static `.htaccess` rule itself is checked by `output-check.mjs`.
- Deviation: `resources/js/app.js` also cancels Inertia's invalid-response iframe modal for GET visits and forces a full page load. This is required because the exact "website on top of website" report is that modal; the server rewrite alone cannot protect static hosts where the rule is not deployed. `checks/invalid-response-check.mjs` gates it.

## Review Focus

- Narrow viewport: cards must still collapse to one column without horizontal overflow — verify card width at 375px and 1000px in the browser.
- Groups with one or two plans: cards must keep the same width as three-plan groups and be centred — verify card rects for all four groups.
- Nav keyboard/click behaviour: each label must be a real anchor with the correct href — verify tag name and href in the DOM for all three.
- Hover dropdowns must still open after the labels become links — verify panel display after mouseenter.
- Static HTML must not contain stale dev-server URLs or old classes — verify generated `public/pricing/index.html`.

---

### Task 1: Tidy the pricing card layout

**Files:**
- Modify: `resources/js/Pages/Pricing.vue:193-197`, `resources/js/Pages/Pricing.vue:222`, `resources/js/Pages/Pricing.vue:241-244`

**Interfaces:**
- Consumes: `planGroups`, `activeGroup`, `visibleGroups` from the existing script block.
- Produces: no new exported names; `gridClass` is removed and must have no remaining call sites.

- [ ] **Step 1: Remove the hero overlap**

In `resources/js/Pages/Pricing.vue`, change the cards section class from `max-w-6xl mx-auto px-4 -mt-12 relative z-20 pb-16` to `max-w-6xl mx-auto px-4 pt-10 pb-16`.

- [ ] **Step 2: Remove the scaled highlighted card**

In the card `v-for`, change the highlighted branch from `border-[#2596be] shadow-md scale-[1.02]` to `border-[#2596be] shadow-md`.

- [ ] **Step 3: Replace `gridClass()` with one centred card row**

Delete the `gridClass` function and change the grid element to:

```vue
<div class="flex flex-wrap justify-center gap-6">
```

Give every card the class `w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]` in addition to its existing classes. Confirm `gridClass` appears nowhere in the file.

- [ ] **Step 4: Verify the layout in the browser**

Run `php artisan serve --port=8004`, open `http://127.0.0.1:8004/pricing` and evaluate: section `getBoundingClientRect().top` is greater than the hero's bottom; no element has `scale-[1.02]`; all card rects in a group have equal `width`; cards in the one- and two-plan groups have the same width as the three-plan group; `document.documentElement.scrollWidth <= window.innerWidth` at 375px and 1000px.

- [ ] **Step 5: Commit**

```bash
git add resources/js/Pages/Pricing.vue
git commit -m "style: align pricing cards and remove floating overlap"
```

### Task 2: Make the nav dropdown labels real links

**Files:**
- Modify: `resources/js/Components/Navigation.vue:83-88`, `resources/js/Components/Navigation.vue:114-119`, `resources/js/Components/Navigation.vue:193-198`

**Interfaces:**
- Consumes: `Link` already imported from `@inertiajs/vue3`; the three wrapper divs already own the hover handlers and refs.
- Produces: three anchors with hrefs `/point-of-sale-system-kenya`, `/point-of-sale-system-kenya`, `/pos-systems-in-kenya-news`.

- [ ] **Step 1: Convert the three buttons to links**

Replace each `<button class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 hover:text-[#2596be] transition-colors">` with a `Link` carrying the same class and the href from Global Constraints. Keep the chevron `<svg>` inside each link and keep the surrounding `div` and `transition` block unchanged.

- [ ] **Step 2: Verify tag, href and navigation**

On `http://127.0.0.1:8004/`, evaluate the three nav labels: each must be an `A` element with the expected href; click each one and confirm `location.pathname` changes to that href within five seconds.

- [ ] **Step 3: Verify hover dropdowns still open**

For each of the three wrapper divs, dispatch `mouseenter` and confirm its panel's computed `display` becomes not `none`; dispatch `mouseleave` and confirm it returns to `none`.

- [ ] **Step 4: Commit**

```bash
git add resources/js/Components/Navigation.vue
git commit -m "fix: make navigation dropdown labels navigate to pages"
```

### Task 3: Rebuild bundles and regenerate static pages

**Files:**
- Generate: `resources/js/ziggy.js`, `public/build/**`, `bootstrap/ssr/**` (build output only), `public/*/index.html`
- No hand-edits to generated files.

**Interfaces:**
- Consumes: the committed `Pricing.vue` and `Navigation.vue` from Tasks 1 and 2.
- Produces: regenerated static HTML that carries the new classes and links.

- [ ] **Step 1: Regenerate routes and bundles**

Run, in order:

```powershell
php artisan ziggy:generate resources/js/ziggy.js --url=https://wabepoint.com
npx.cmd vite build
npx.cmd vite build --ssr
```

Expected: both Vite builds report `✓ built in` with no error lines.

- [ ] **Step 2: Regenerate static HTML**

With `php artisan inertia:start-ssr` running, run:

```powershell
$env:APP_ENV='production'; $env:APP_DEBUG='false'; $env:APP_URL='https://wabepoint.com'; php artisan site:prerender
```

Expected: all 20 pages report `Saved`, including `/pricing` and `/pos-systems-in-kenya-news`.

- [ ] **Step 3: Verify generated output**

Check `public/pricing/index.html` contains no `scale-[1.02]` and no `-mt-12`, contains `flex flex-wrap justify-center gap-6`, and `public/index.html` contains all three new nav hrefs. Confirm no generated file contains `5174` or `localhost`.

- [ ] **Step 4: Stop test servers and commit**

Stop the local test servers on ports 8004 and 13714, then:

```bash
git add resources/js/ziggy.js public/build public/*/index.html
git commit -m "build: regenerate static pages with pricing and nav fixes"
```

Do not stage `public/hot` or `bootstrap/ssr/`.
