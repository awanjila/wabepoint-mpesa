# Blog Image Slug Filenames Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Save uploaded blog images under a filename derived from the post's slug on both create and edit.

**Architecture:** Server-side-only change in the admin blog controller. The slug is resolved before the upload block in each method, and Laravel's `putFileAs` writes the file to the `public` disk with the slug plus the original extension. No client, route, or prerender changes are involved.

**Tech Stack:** Laravel 10, PHP 8, Inertia admin pages, source-level Node checks.

**Spec:** `docs/superpowers/specs/2026-11-18-blog-image-slug-filenames-design.md`

## Global Constraints

- Existing images are not renamed when the title or slug changes without a new upload.
- Old image files are not deleted.
- The stored DB value stays a relative path beginning with `storage/`.
- No front-end image URL helpers, blog routes, or prerendered blog data are changed.
- Do not commit `public/hot` or `bootstrap/ssr/`.

## Review Focus

- Missing slug input: the slug must be derived from `name` before it is used as the filename — pinned by the check's "slug resolved before upload" assertions.
- Uppercase or mixed-case extensions: the original extension must be preserved verbatim — pinned by the check's `getClientOriginalExtension()` assertion.
- Edit with a new slug: the current post slug, not the old one, must be used — pinned by checking the update method's upload block uses `$validated['slug']`.
- Old random-hash upload code must be gone from both methods — pinned by the check's absence assertion.
- Unrelated generated HTML and bundles must stay valid — pinned by running the existing output check after the change.

---

### Task 1: Use slug-based filenames on create and edit

**Files:**
- Create: `.superpowers/sdd/2026-11-18-blog-image-slug-filenames/checks/slug-filename-check.mjs`
- Modify: `app/Http/Controllers/Admin/BlogController.php:33-60`, `app/Http/Controllers/Admin/BlogController.php:80-108`

**Interfaces:**
- Consumes: `$validated['slug']`, `$validated['name']`, `Str::slug()`, `$request->file('image_file')` already available in both controller methods.
- Produces: stored images at `storage/blogs/<slug>.<original-extension>`; no new PHP functions or routes.

- [ ] **Step 1: Write the failing source check**

Create `.superpowers/sdd/2026-11-18-blog-image-slug-filenames/checks/slug-filename-check.mjs` with exactly this content:

```js
import { readFileSync } from 'node:fs';

const source = readFileSync('app/Http/Controllers/Admin/BlogController.php', 'utf8');
const body = (name, next) => {
  const start = source.indexOf(`public function ${name}(`);
  const end = source.indexOf(`public function ${next}(`, start);
  return source.slice(start, end);
};
const store = body('store', 'edit');
const update = body('update', 'destroy');
const usesSlugFilename = (text) =>
  /putFileAs\(\s*'blogs'\s*,/.test(text)
  && text.includes("$validated['slug']")
  && text.includes('getClientOriginalExtension()')
  && !text.includes("store('blogs', 'public')");
const slugResolvedBeforeUpload = (text) =>
  text.indexOf("Str::slug($validated['name'])") < text.indexOf("hasFile('image_file')");

const expected = [
  ['store uses slug-based filename', usesSlugFilename(store)],
  ['store resolves slug before upload', slugResolvedBeforeUpload(store)],
  ['update uses slug-based filename', usesSlugFilename(update)],
  ['update resolves slug before upload', slugResolvedBeforeUpload(update)],
  ['no hash-name uploads remain', !source.includes("store('blogs', 'public')")],
];

let failed = false;
for (const [name, ok] of expected) {
  console.log(`${ok ? 'PASS' : 'FAIL'} ${name}`);
  if (!ok) failed = true;
}
process.exit(failed ? 1 : 0);
```

- [ ] **Step 2: Run the check to verify it fails**

Run: `node .superpowers/sdd/2026-11-18-blog-image-slug-filenames/checks/slug-filename-check.mjs`
Expected: FAIL on all five assertions (old code uses `store('blogs', 'public')` and resolves the slug after the upload).

- [ ] **Step 3: Resolve the slug before the upload block in both methods**

In `store()`, move this line from below `unset($validated['image_file']);` to immediately above `if ($request->hasFile('image_file')) {`:

```php
$validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
```

In `update()`, move this block from after `unset($validated['image_file']);` to immediately above `if ($request->hasFile('image_file')) {`:

```php
if (!$validated['slug']) {
    $validated['slug'] = Str::slug($validated['name']);
}
```

- [ ] **Step 4: Replace the upload code in both methods**

Add `use Illuminate\Support\Facades\Storage;` to the imports in `app/Http/Controllers/Admin/BlogController.php`, then replace the upload block in both `store()` and `update()` with:

```php
if ($request->hasFile('image_file')) {
    $path = Storage::disk('public')->putFileAs(
        'blogs',
        $request->file('image_file'),
        $validated['slug'] . '.' . $request->file('image_file')->getClientOriginalExtension()
    );
    $validated['image'] = 'storage/' . $path;
}
```

Keep the existing validation rules and the `unset($validated['image_file']);` call in place.

- [ ] **Step 5: Run the check to verify it passes**

Run: `node .superpowers/sdd/2026-11-18-blog-image-slug-filenames/checks/slug-filename-check.mjs`
Expected: all five lines PASS.

- [ ] **Step 6: Check for regressions**

Run the existing source checks:

```bash
node .superpowers/sdd/2026-11-18-pricing-page-and-nav-links/checks/pricing-check.mjs
node .superpowers/sdd/2026-11-18-pricing-page-and-nav-links/checks/nav-check.mjs
node .superpowers/sdd/2026-11-18-pricing-page-and-nav-links/checks/invalid-response-check.mjs
node .superpowers/sdd/2026-11-18-pricing-page-and-nav-links/checks/output-check.mjs
```

Expected: all lines PASS. No rebuild is needed because no client or SSR source changed.

- [ ] **Step 7: Commit**

```bash
git add app/Http/Controllers/Admin/BlogController.php .superpowers/sdd/2026-11-18-blog-image-slug-filenames/checks/slug-filename-check.mjs docs/superpowers/specs/2026-11-18-blog-image-slug-filenames-design.md docs/superpowers/plans/2026-11-18-blog-image-slug-filenames.md
git commit -m "feat: name uploaded blog images from post slug"
```
