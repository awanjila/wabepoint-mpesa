# Blog image filenames from title URL — design

## Intent

When a blog image is uploaded, its stored filename should come from the post's title URL (slug) instead of a random hash, so the file is recognisable and stable. This must apply on edit as well as create.

## Goals

- A newly uploaded image on create is saved as `<slug>.<original-extension>` under `storage/blogs/`.
- A newly uploaded image on edit is saved using the post's current slug the same way.

## Non-goals

- No renaming of an existing image when the title or slug changes later without a new upload.
- No deletion of old or superseded image files.
- No change to front-end image URL helpers, blog routes, or prerendered blog data.

## Constraints

- Slugs are unique in `blogs`, and are derived from `name` when not supplied.
- Both `store()` and `update()` currently upload with `store('blogs', 'public')`, producing hash names.
- Files live on the `public` disk; the DB stores a relative `storage/...` path.

## Approaches considered

1. Name only newly uploaded files (chosen) — use `putFileAs` with the resolved slug and the upload's original extension in both methods. Leaves existing files untouched; no filesystem moves or collision handling needed.
2. Also rename an existing image when the slug changes — rejected for now: adds disk moves and collision handling for a case the request does not require.

## Decisions

- Resolve the slug before handling the upload in both methods (`$validated['slug'] ?: Str::slug($validated['name'])` on create; existing fallback on update).
- On upload, call `putFileAs('blogs', $file, $validated['slug'] . '.' . $file->getClientOriginalExtension())` and save `'storage/' . $path`.
- Keep the existing validation and the `unset($validated['image_file'])` behaviour.

## Left to the implementer

- Add source-level checks that `store()` and `update()` use `putFileAs` with the slug, then implement the change.
- Verify with the existing check suite; no rebuild of static pages needed for this server-side-only change.
