# nginx routing for dynamic blog pages

Blog pages are rendered by Laravel from the live database, so their URLs must reach
`index.php` instead of being served from a static `public/blogs/*/index.html` file.

The host owner applies this rule on the live cPanel/nginx host. It is not edited
from this repository.

```nginx
# Place before the static-file fallback for /, and after the /build and /storage rules.
# Blog URLs must reach Laravel so they render from the live database.
location ~ ^/(blogs(?:/|$)|news(?:/|$)|pos-systems-in-kenya-news(?:/|$)) {
    rewrite ^ /index.php last;
}
```

`rewrite ... last` sends every matching request straight to Laravel without first
checking for a matching static file or directory. This is deliberate: `try_files
$uri $uri/ ...` would let an existing `public/blogs/{slug}/index.html` prerendered
snapshot win, which is exactly the stale content this change removes. The original
query string (including `?page=`) is preserved by nginx when the replacement URI
has no query string of its own.

Notes for the host owner:

- Do **not** add a rule that serves `public/blogs/*/index.html` for these paths;
  those files are stale snapshots built from a local database and would hide new posts.
- Keep `/build` and `/storage` served statically. The Blade layout loads only the
  built CSS files listed in `public/build/manifest.json`.
- Inertia navigation requests carry the `X-Inertia` header and must still reach
  `index.php`. The controller returns the Vue page JSON for those requests and full
  HTML for normal requests.
- The rule covers `/blogs`, `/blogs/{slug}`, `/news` and the legacy
  `/pos-systems-in-kenya-news` redirect, including their `?page=` variants.

## Manual verification checklist (after deployment)

Run these against the live host once the PHP/Blade/build files and the nginx rule
are in place:

- `curl -sI https://wabepoint.com/news` → `200`, and the body contains six post
  titles and `Our Blog`.
- `curl -sI https://wabepoint.com/pos-systems-in-kenya-news` → `301` to `/news`.
- `curl -s https://wabepoint.com/blogs/pos-software-for-clothing-stores-in-kenya`
  → contains "POS Software for Clothing Stores in Kenya" and the article body, not
  an empty `#app` shell.
- No page contains the literal `Discover why most retail shops lose` followed by
  `" inertia>`, and no `<meta ... content="<p ...>` attribute. SEO descriptions
  must be plain text with escaped entities.
- `curl -sI https://wabepoint.com/blogs/this-slug-does-not-exist-test-12345`
  → `404`.
- Non-blog pages (`/`, `/pricing`) still return their static HTML for crawlers.
