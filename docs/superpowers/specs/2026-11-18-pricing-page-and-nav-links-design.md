# Pricing page and navigation links — design

## Intent

On `/pricing`, the plan cards read like floating modal panels and the rows do not line up. In the navigation, three items are buttons that only open hover panels instead of taking the visitor to a page. Fix both without changing any plan, feature, FAQ or SEO copy.

## Goals

- Plan cards sit cleanly below the hero, with no overlapping or scaled-up cards.
- All plan cards have the same width and equal height within a row; groups with fewer plans are centred rather than stretched.
- "Point Of Sale", "Our Services" and "Resources" navigate when clicked.

## Non-goals

- No changes to plan names, prices, features, comparison table, FAQs or metadata.
- No new routes, no removal of the hover dropdown menus.
- No change to the homepage pricing teaser.

## Constraints

- `Navigation.vue` is shared by every page, so a change there affects the whole site.
- Pages are pre-rendered to static `public/*/index.html`; after code changes, bundles and HTML must be regenerated.
- No persistent Node process on the live cPanel host.

## Approaches considered

**Pricing layout**
1. Tidy in place (chosen) — keep hero, tabs, all four groups and every plan; remove the hero overlap and card scaling; render every group with the same centred, fixed-width card row. Low risk, fixes both complaints.
2. One unified grid — drop the industry tabs and merge all plans into a single comparison grid. Rejected: loses the General/Restaurant/Hotel/Distributor grouping the page copy depends on.

**Navigation**
1. Labels become real links while hover dropdowns stay (chosen) — clicking navigates, hovering still exposes the quick links. Preserves existing shortcuts.
2. Remove the dropdowns and leave plain links. Rejected: throws away useful industry and service shortcuts.

## Decisions

- Remove `-mt-12 relative z-20` from the pricing cards section; use normal spacing.
- Remove `scale-[1.02]` from highlighted cards; keep the coloured border and badge as the emphasis.
- Replace `gridClass()` with one responsive card row so every card has identical width (`w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(33.333%-1rem)]`), centred with `justify-center` and stretched to equal height.
- Navigation labels become `Link`s: Point Of Sale → `/point-of-sale-system-kenya`, Our Services → `/point-of-sale-system-kenya`, Resources → `/pos-systems-in-kenya-news`. The surrounding divs keep their hover handlers, so dropdowns still open on hover.

## Left to the implementer

- Rebuild client and SSR bundles, regenerate Ziggy routes if needed, re-run `php artisan site:prerender`, and verify the nav links and card geometry in the browser.
