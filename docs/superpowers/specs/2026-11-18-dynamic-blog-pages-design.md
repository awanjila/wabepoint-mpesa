# Dynamic blog pages and clean SEO descriptions — design

## Intent

Blogs created in the live admin are invisible on the public site because the site serves pre-rendered static HTML built from this workspace's local DB. At the same time, several posts store HTML in `meta_description`, which Inertia puts into a `<meta content="...">` attribute unescaped, leaking visible text onto the detail page. Blog list and detail pages should be rendered by Laravel from the live DB on every request, and SEO descriptions should be plain text.

## Goals

- `/pos-systems-in-kenya-news` and `/blogs/{slug}` return full, crawler-readable HTML generated from the live DB on every normal page load.
- The new post `/blogs/pos-software-for-clothing-stores-in-kenya` renders its content.
- Blog list pagination keeps working (six posts per page via `?page=`).
- Inertia visits to these URLs still receive the existing Vue pages, so navigation from other pages is unchanged.
- Meta descriptions contain no raw HTML or broken attributes.

## Non-goals

- No changes to non-blog static pages, admin screens, image upload naming, or the blog content itself.
- No live nginx configuration is edited from this repo; the host owner applies the supplied rule.
- No production DB access or prerender-from-production workflow.
- No rewrite of the Vue blog components used by Inertia visits.

## Constraints

- The live host is nginx on shared hosting: static files are served first; no persistent Node process is available.
- Local and live DBs differ; prerendered `public/blogs/*/index.html` cannot know about live posts.
- `meta_description` may contain HTML entities and tags; Blade `{{ }}` escapes attributes, but Inertia's `<Head>` does not.
- Blog images may be absolute URLs or relative DB paths; the Vue helpers prefix relative paths with `/`.
- Tailwind scans `resources/views/**/*.blade.php`, so classes used in the new Blade views will be in the built CSS.

## Approaches considered

1. **Plain Blade pages (chosen).** Laravel renders complete HTML for blog list and detail on each request. New posts appear immediately; Google gets readable HTML; no prerender step. Trades off maintaining Blade markup alongside the Vue components.
2. Dynamic Inertia without SSR — simpler controller change, but the initial HTML is an empty `#app`; rejected because crawlers would not see post content.
3. Prerender from the production DB — rejected earlier because the production DB is not reachable from this workspace and every publish would need a manual upload step.

## Decisions

- `BlogController::index()` and `show()` branch on the `X-Inertia` header: Inertia requests keep returning `Inertia::render(...)`; all other GET requests return Blade views.
- Add `resources/views/layouts/site.blade.php` plus `resources/views/blogs/index.blade.php` and `show.blade.php`. The layout emits escaped SEO meta tags, loads only the built Vite CSS by reading `public/build/manifest.json`, and includes header/footer partials. It must not load `resources/js/app.js`: that script parses `#app` `data-page` and would mount Vue over the server-rendered content or throw without a payload.
- Header and footer partials are copied once from the currently rendered Inertia HTML so the dynamic pages keep the same links, colours and layout. They use CSS hover for dropdowns; the Vue-driven mobile menu and dropdown state are not reproduced. Keeping them in sync with `Navigation.vue`/`Footer.vue` is a manual follow-up when those components change.
- The index view paginates six posts per page with `?page=` query links; the detail view renders the trusted admin HTML body, image, author/date, previous/next links, related posts and the demo CTA.
- Add a controller helper that converts a description to plain text (`strip_tags` + `html_entity_decode` + whitespace collapse) before `Str::limit`, applied to both `meta_description` and the `content` fallback. Blog body HTML is still rendered as HTML.
- Image URLs in Blade follow the Vue rule: absolute `http` URLs pass through; relative paths get a leading `/`.
- Supplied nginx rule (host owner applies it): send normal requests for `/blogs...` and `/pos-systems-in-kenya-news` to `index.php` before the static-file fallback, while leaving `/build`, `/storage` and other static paths alone.

## Left to the implementer

- Add the controller branch/helper and the three Blade views, plus feature tests for dynamic rendering, clean descriptions and the new slug's route.
- Verify with `php artisan test` and a browser check of `/pos-systems-in-kenya-news` and `/blogs/pos-software-for-clothing-stores-in-kenya` against a local blog fixture with the same slug.
- Hand the nginx snippet to the host owner; after deployment, verify the live URLs return full HTML.
