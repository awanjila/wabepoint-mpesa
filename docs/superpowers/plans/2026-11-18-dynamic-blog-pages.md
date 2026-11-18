# Dynamic Blog Pages Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Serve the blog list and blog details as full, live-DB-rendered HTML for normal requests while keeping Inertia visits on the existing Vue pages, and stop raw HTML from leaking into SEO descriptions.

**Architecture:** Keep the existing Vue/Inertia site for non-blog pages and for `X-Inertia` visits. For ordinary GETs to the two blog routes, `BlogController` returns plain Blade views rendered from the live database. A small support class cleans description text once, both response paths consume it. The Blade layout loads only the already-built CSS from `public/build/manifest.json`, never `app.js`, so Vue cannot mount over the server HTML.

**Tech Stack:** Laravel 10/11 Blade, Vite-built Tailwind CSS, Inertia + Vue 3 (unchanged), PHPUnit feature/unit tests, nginx (host-applied).

**Spec:** `docs/superpowers/specs/2026-11-18-dynamic-blog-pages-design.md`

## Global Constraints

- Live host is cPanel/shared nginx with no persistent Node SSR; non-blog pages keep their pre-rendered static HTML.
- `/pos-systems-in-kenya-news` and `/blogs/{slug}` must return full HTML from the live DB on normal requests.
- Inertia visits (`X-Inertia` header) keep returning the existing `Blogs/Index` and `Blogs/Show` Vue pages.
- Six posts per page via `?page=` on the Blade list.
- Blade layout loads only built CSS from `public/build/manifest.json`; it must NOT load `resources/js/app.js`, use `@vite`, or render `#app`/`@inertia`.
- SEO descriptions are plain text; `blog.description` is trusted admin HTML and stays HTML in the body.
- Support phone markup: `tel:+254781312070` and `+254 781 312 070`; canonical host `https://wabepoint.com` (recommended, still unconfirmed — do not add a www redirect).
- Header/footer follow current rendered markup and links; dropdowns are CSS hover only, with no Vue state or click handlers.
- Tests run with `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` because the local MySQL `blogs` table lacks the `status` column.
- Do not edit live nginx from this repo; only supply a snippet for the host owner.
- Leave the pre-existing untracked `_verify_seo.php` untouched.
- Push only after the full suite passes.

## Review Focus

- `meta_description` containing tags and entities (`<p data-start="...">`, `&ndash;`, `&amp;`) → must become one plain, single-escaped description; pinned in Task 1 (unit) and Task 3 (feature).
- `X-Inertia` visits, including an absent/stale version header → must get Vue JSON, never Blade HTML or a 409; pinned in Task 2 and Task 3.
- Blog body containing Quill HTML → must render as HTML in the body but never appear in meta attributes; pinned in Task 3.
- `?page=2`, out-of-range and non-numeric pages → must not 500 or duplicate posts; pinned in Task 3.
- A newly published slug and an unknown slug → new slug renders from DB, unknown slug 404s; pinned in Task 3.
- Blade page must not ship the Inertia entry script (it would parse `data-page` and throw); pinned in Task 3 by asserting the built CSS link is present and `assets/app-` is absent.

---

### Task 1: Plain-text SEO description helper

**Files:**
- Create: `app/Support/SeoDescription.php`
- Test: `tests/Unit/SeoDescriptionTest.php`

**Interfaces:**
- Consumes: `Illuminate\Support\Str`.
- Produces: `App\Support\SeoDescription::plain(?string $value, int $limit = 160): string`. This implements the spec's "controller helper"; it lives in a small support class so it can be unit-tested without rendering views, and the controller is its only caller.

- [ ] **Step 1: Write the failing tests**

```php
<?php

namespace Tests\Unit;

use App\Support\SeoDescription;
use Tests\TestCase;

class SeoDescriptionTest extends TestCase
{
    public function test_it_strips_tags_and_decodes_entities(): void
    {
        $this->assertSame(
            'Discover why most retail shops lose 5–15% of profit',
            SeoDescription::plain('<p data-start="506">Discover why most retail shops lose 5&ndash;15% of profit</p>')
        );
    }

    public function test_it_collapses_whitespace_and_trims(): void
    {
        $this->assertSame('Alpha beta', SeoDescription::plain("  <p>Alpha\n\n   beta </p>  "));
    }

    public function test_it_limits_length_and_handles_null(): void
    {
        $long = str_repeat('word ', 100);
        $this->assertSame(\Illuminate\Support\Str::limit($long, 20), SeoDescription::plain($long, 20));
        $this->assertSame('', SeoDescription::plain(null));
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test tests/Unit/SeoDescriptionTest.php`
Expected: FAIL — `Class "App\Support\SeoDescription" not found`.

- [ ] **Step 3: Implement `SeoDescription::plain()`**

In `app/Support/SeoDescription.php`, define `public static function plain(?string $value, int $limit = 160): string`. Apply, in order: `strip_tags`, `html_entity_decode($text, ENT_QUOTES, 'UTF-8')`, `preg_replace('/\s+/u', ' ', $text)`, `trim`, `Str::limit($text, $limit)`.

- [ ] **Step 4: Run the tests to verify they pass**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test tests/Unit/SeoDescriptionTest.php`
Expected: PASS (3 tests).

- [ ] **Step 5: Commit**

```bash
git add app/Support/SeoDescription.php tests/Unit/SeoDescriptionTest.php
git commit -m "feat: add plain-text SEO description helper"
```

---

### Task 2: Use the cleaned description on the Inertia path

**Files:**
- Modify: `app/Http/Controllers/BlogController.php:64-91`
- Test: `tests/Feature/BlogSeoInertiaTest.php`

**Interfaces:**
- Consumes: `App\Support\SeoDescription::plain()`.
- Produces: no new public interface; `show()`'s `seo.description` prop becomes plain text. Route signature stays `show($slug)` in this task.

- [ ] **Step 1: Write the failing tests**

```php
<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class BlogSeoInertiaTest extends TestCase
{
    use RefreshDatabase;

    public function test_inertia_detail_description_is_plain_text(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Retail Profits',
            'slug' => 'retail-profits',
            'user_id' => $user->id,
            'meta_description' => '<p data-start="506">Discover why most retail shops lose 5&ndash;15% of profit.</p>',
        ]);

        $this->get('/blogs/'.$blog->slug, ['X-Inertia' => 'true'])
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blogs/Show')
                ->where('seo.description', 'Discover why most retail shops lose 5–15% of profit.'));
    }

    public function test_inertia_detail_description_falls_back_to_plain_content(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Fallback Post',
            'slug' => 'fallback-post',
            'user_id' => $user->id,
            'content' => '<p>  Plain   fallback <strong>text</strong>. </p>',
        ]);

        $this->get('/blogs/'.$blog->slug, ['X-Inertia' => 'true'])
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Blogs/Show')
                ->where('seo.description', 'Plain fallback text.'));
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test tests/Feature/BlogSeoInertiaTest.php`
Expected: FAIL — `seo.description` still contains `<p data-start...>` / uncollapsed whitespace.

- [ ] **Step 3: Change the description build in `BlogController::show()`**

Import `App\Support\SeoDescription`. Replace the `'description'` value with `SeoDescription::plain($blog->meta_description ?: $blog->content)`. Leave every other key and the `Inertia::render('Blogs/Show', ...)` call unchanged.

- [ ] **Step 4: Run the tests to verify they pass**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test tests/Feature/BlogSeoInertiaTest.php`
Expected: PASS (2 tests).

- [ ] **Step 5: Run the full suite and commit**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test`
Expected: PASS with no regressions.

```bash
git add app/Http/Controllers/BlogController.php tests/Feature/BlogSeoInertiaTest.php
git commit -m "fix: strip HTML from blog SEO descriptions"
```

---

### Task 3: Dynamic Blade blog pages with Inertia fallback

**Files:**
- Modify: `app/Http/Controllers/BlogController.php:49-91`
- Create: `resources/views/layouts/site.blade.php`
- Create: `resources/views/partials/site-header.blade.php`
- Create: `resources/views/partials/site-footer.blade.php`
- Create: `resources/views/blogs/index.blade.php`
- Create: `resources/views/blogs/show.blade.php`
- Rebuild (commit): `public/build/manifest.json` and `public/build/assets/*`
- Test: `tests/Feature/DynamicBlogPagesTest.php`

**Interfaces:**
- Consumes: `BlogController::index()`/`show()` Blade data — `blogs` (`LengthAwarePaginator`, 6 per page), `blog`, `previous`, `next`, `blogPosts`, `seo` (array with plain `description`), `url`.
- Produces: views `blogs.index`, `blogs.show`, layout `layouts.site`, partials `partials.site-header`, `partials.site-footer`.

- [ ] **Step 1: Write the failing feature tests**

```php
<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DynamicBlogPagesTest extends TestCase
{
    use RefreshDatabase;

    private function makeBlogs(User $user, int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            Blog::create([
                'name' => "Post $i",
                'slug' => "post-$i",
                'user_id' => $user->id,
                'description' => "<p>Body for Post $i</p>",
                'created_at' => now()->subDays($count - $i),
            ]);
        }
    }

    public function test_normal_index_renders_six_newest_posts_as_html(): void
    {
        $this->makeBlogs(User::factory()->create(), 7);
        $this->get('/pos-systems-in-kenya-news')
            ->assertOk()
            ->assertViewIs('blogs.index')
            ->assertSee('Post 7')
            ->assertSee('Post 2')
            ->assertDontSee('Post 1');
    }

    public function test_index_pagination_uses_page_query(): void
    {
        $this->makeBlogs(User::factory()->create(), 7);
        $this->get('/pos-systems-in-kenya-news?page=2')
            ->assertOk()
            ->assertSee('Post 1')
            ->assertDontSee('Post 7');
        $this->get('/pos-systems-in-kenya-news?page=999')->assertOk();
        $this->get('/pos-systems-in-kenya-news?page=abc')->assertOk();
    }

    public function test_normal_detail_renders_trusted_body_html_and_plain_meta(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Retail Profits',
            'slug' => 'retail-profits',
            'user_id' => $user->id,
            'description' => '<p>Unique body sentence with <strong>markup</strong>.</p>',
            'meta_description' => '<p data-start="506">Discover 5&ndash;15% &amp; more.</p>',
        ]);

        $this->get('/blogs/'.$blog->slug)
            ->assertOk()
            ->assertViewIs('blogs.show')
            ->assertSee('<p>Unique body sentence with <strong>markup</strong>.</p>', false)
            ->assertSee('content="Discover 5–15% &amp; more."', false)
            ->assertDontSee('<p data-start', false);
    }

    public function test_new_clothing_store_slug_renders_and_unknown_slug_404s(): void
    {
        $user = User::factory()->create();
        Blog::create([
            'name' => 'POS Software for Clothing Stores in Kenya',
            'slug' => 'pos-software-for-clothing-stores-in-kenya',
            'user_id' => $user->id,
            'description' => '<p>Clothing store content.</p>',
        ]);

        $this->get('/blogs/pos-software-for-clothing-stores-in-kenya')
            ->assertOk()
            ->assertSee('POS Software for Clothing Stores in Kenya');
        $this->get('/blogs/this-slug-does-not-exist-test-12345')->assertNotFound();
    }

    public function test_blade_pages_keep_header_footer_links_and_load_only_built_css(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Header Check',
            'slug' => 'header-check',
            'user_id' => $user->id,
        ]);
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $css = '/build/'.$manifest['resources/js/app.js']['css'][0];

        $this->get('/blogs/'.$blog->slug)
            ->assertOk()
            ->assertSee('tel:+254781312070')
            ->assertSee('+254 781 312 070')
            ->assertSee('/pos-systems-in-kenya-news')
            ->assertSee($css, false)
            ->assertDontSee('assets/app-', false);
    }

    public function test_inertia_visits_still_return_vue_pages(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Inertia Post',
            'slug' => 'inertia-post',
            'user_id' => $user->id,
        ]);

        $this->get('/pos-systems-in-kenya-news', ['X-Inertia' => 'true'])
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Blogs/Index'));
        $this->get('/blogs/'.$blog->slug, ['X-Inertia' => 'true'])
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Blogs/Show'));
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test tests/Feature/DynamicBlogPagesTest.php`
Expected: FAIL — normal requests return Inertia responses; `assertViewIs('blogs.index')` cannot match.

- [ ] **Step 3: Branch `BlogController` on `X-Inertia`**

In `app/Http/Controllers/BlogController.php`, import `Illuminate\Http\Request`. Change signatures to `index(Request $request)` and `show(Request $request, $slug)`. Keep the existing `Inertia::render(...)` calls inside `if ($request->header('X-Inertia')) { ... }`. For the normal branch return:
  - `index`: `view('blogs.index', ['blogs' => Blog::with('category')->latest()->paginate(6), 'seo' => $seo])` — reuse the existing static `$seo` array.
  - `show`: `view('blogs.show', ['blog' => $blog, 'previous' => $previous, 'next' => $next, 'blogPosts' => Blog::with('category')->latest()->take(6)->get(), 'seo' => $seo, 'url' => url()->current()])`. Keep the existing queries and `SeoDescription::plain()` usage from Task 2.

- [ ] **Step 4: Create the CSS-only layout**

Create `resources/views/layouts/site.blade.php`. It must:
  - Read `public_path('build/manifest.json')` with `json_decode(file_get_contents(...), true)`; collect `css` entries for manifest keys `resources/js/app.js` and `resources/js/Pages/Blogs/Show.vue` (de-duplicate, prefix with `/build/`, skip files that do not exist on disk).
  - Emit `<link rel="stylesheet">` for each collected file. Emit no `<script>` for the app entry, no `@vite`, no `@inertia`, and no `id="app"`.
  - Emit `<title>{{ $seo['title'] ?? ... }}</title>`, `<meta name="description" content="{{ $seo['description'] ?? '' }}">`, keywords, canonical (`https://wabepoint.com/...` from `$seo['canonical']`), robots, and basic OG/twitter tags — all with Blade `{{ }}` escaping.
  - Include the same Google Fonts, favicon and gtag blocks as `resources/views/app.blade.php`.
  - `@include('partials.site-header')`, `@yield('content')`, `@include('partials.site-footer')` inside `<body>`.

- [ ] **Step 5: Create the header and footer partials**

Create `resources/views/partials/site-header.blade.php` by copying the rendered header from `public/index.html` (the wrapper `<div class="font-['Inter',sans-serif]">` containing the top bar `<div class="bg-gradient-to-r from-[#2596be] ...">`, the sticky `<nav class="bg-white shadow-sm ...">`, and the floating WhatsApp `<a href="https://wa.me/254781312070?...">`). Convert Vue syntax to static HTML: `:href`/`:class` → `href`/`class`, `v-for="item in $page.props.industries"` → `@foreach (config('industries') as $industry)` using `$industry['path']` and `$industry['label']`, drop every `@click`/`v-if`/`v-else` and dropdown ref. For the three desktop dropdowns, wrap each trigger and its panel in a `group` container and replace `v-show="posDropdownOpen"` / `servicesDropdownOpen` / `resourcesDropdownOpen` with `hidden group-hover:block`; the existing mouseenter/mouseleave behavior becomes pure CSS hover. For the mobile menu, replace the `@click="toggleMenu"` button and `v-show="isOpen"` panel with a native `<details class="md:hidden">` / `<summary>` pair so it opens without JS; keep its existing links. Keep the exact visible links and the phone/email text from `Navigation.vue:54-80`, `Navigation.vue:94-230`, `Navigation.vue:267-305` and `Navigation.vue:320-330`.

Create `resources/views/partials/site-footer.blade.php` from `resources/js/Components/Footer.vue` / the `public/index.html` footer, converting the same Vue syntax. Keep `/point-of-sale-system-kenya#...` service links, social links and the industries list from `config('industries')`.

- [ ] **Step 6: Create the blog list view**

Create `resources/views/blogs/index.blade.php` with `@extends('layouts.site')`. Mirror `resources/js/Components/Blog.vue`: gradient hero with Home / Blog crumb, "Our Blog" heading and subtitle; a three-column responsive grid of cards (`category_name` or "Uncategorized", `name`, image via the rule below, `created_at` formatted `d M Y`); an empty state; and `$blogs->links()` pagination so `?page=` works. Image helper rule: `image` empty → `/images/default-placeholder.jpg`; starts with `http://`/`https://` → pass through; otherwise prefix a single `/`. Implement as an inline `@php` closure at the top of the view.

- [ ] **Step 7: Create the blog detail view**

Create `resources/views/blogs/show.blade.php` with `@extends('layouts.site')`. Mirror `resources/js/Pages/Blogs/Show.vue`: breadcrumb Home / Blog / title; article with image, author (`$blog->user?->name ?: 'Admin'`), formatted date, category badge, `<h1>{{ $blog->name }}</h1>`, and `{!! $blog->description !!}` inside `class="prose prose-slate prose-lg max-w-none blog-content"`; previous/next links via `route('blogs.show', $slug)`; sidebar "Related Posts" from `$blogPosts` excluding the current id with the last element moved to the front (matching `reorderedRelatedPosts`); the WhatsApp "Book a Demo" CTA. Use the same image helper rule as Step 6.

- [ ] **Step 8: Rebuild the CSS bundle**

Run `npm run build`. Verify the manifest still exposes both CSS entries:
Run: `node -e "const m=require('./public/build/manifest.json'); console.log(m['resources/js/app.js'].css[0], m['resources/js/Pages/Blogs/Show.vue'].css[0])"`
Expected: two `assets/*.css` paths. Commit regenerated `public/build/manifest.json` and `public/build/assets/*` so any Tailwind classes newly used in the Blade views are present.

- [ ] **Step 9: Run the tests to verify they pass**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test tests/Feature/DynamicBlogPagesTest.php`
Expected: PASS (6 tests). If `assertDontSee('assets/app-', false)` fails, check the layout does not use `@vite` and no partial emits an app script.

- [ ] **Step 10: Run the full suite and commit**

Run: `$env:DB_CONNECTION='sqlite'; $env:DB_DATABASE=':memory:'; php artisan test`
Expected: PASS with no regressions.

```bash
git add app/Http/Controllers/BlogController.php resources/views/layouts/site.blade.php resources/views/partials resources/views/blogs tests/Feature/DynamicBlogPagesTest.php public/build
git commit -m "feat: render blog pages dynamically from the live database"
```

---

### Task 4: nginx routing snippet and deployment handoff

**Files:**
- Create: `docs/deployment/nginx-blog-routing.md`

**Interfaces:**
- Consumes: the two routes already declared in `routes/web.php:183-185` (`blogs.show`, `blogs.index`).
- Produces: no code interface; an operator-facing snippet and verification checklist.

- [ ] **Step 1: Write the deployment note**

Create `docs/deployment/nginx-blog-routing.md` containing:

```nginx
# Place before the static-file fallback for /, and after the /build and /storage rules.
# Blog URLs must reach Laravel so they render from the live database.
location ~ ^/(blogs(?:/|$)|pos-systems-in-kenya-news(?:/|$)) {
    try_files $uri $uri/ /index.php?$query_string;
}
```

Also state: do not add a rule that serves `public/blogs/*/index.html` for these paths; keep `/build` and `/storage` served statically; Inertia requests carry `X-Inertia` and must still reach `index.php`; the host owner applies this on the live host (it is not edited from this repo).

- [ ] **Step 2: Add the manual verification checklist**

In the same doc, list the post-deployment checks:
  - `curl -sI https://wabepoint.com/pos-systems-in-kenya-news` → `200`, body contains six post titles and `Our Blog`.
  - `curl -s https://wabepoint.com/blogs/pos-software-for-clothing-stores-in-kenya` → contains "POS Software for Clothing Stores in Kenya" and the article body, not an empty `#app`.
  - No page contains the literal `Discover why most retail shops lose` followed by `" inertia>`, and no `<meta ... content="<p ...>` attribute.
  - `curl -sI https://wabepoint.com/blogs/this-slug-does-not-exist-test-12345` → `404`.
  - Non-blog pages (`/`, `/pricing`) still return their static HTML.

- [ ] **Step 3: Commit and push**

```bash
git add docs/deployment/nginx-blog-routing.md
git commit -m "docs: add nginx routing snippet for dynamic blog pages"
git push origin master
```
