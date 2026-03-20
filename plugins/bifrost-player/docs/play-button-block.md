# Play Button Block

**Block name:** `bifrost-player/play-button`
**Path:** `src/blocks/play-button/`

A "Listen Now" button that triggers the persistent audio player. Designed to be placed in templates or patterns (e.g., on album pages).

## `block.json`

Block metadata registration:

- **`apiVersion: 3`** — latest block API.
- **`supports.interactivity: true`** — enables Interactivity API directives.
- **`supports.inserter: true`** (default) — unlike `audio-player`, this block is available in the editor for manual placement.
- **No `editorScript`** — no editor UI beyond the default block controls.
- **No `viewScriptModule`** — relies on the `audio-player` block's store (same `bifrost-player` namespace). The store is always available because the audio-player is rendered in `wp_footer` on every page.

### Attributes

| Attribute | Type | Default | Purpose |
|---|---|---|---|
| `trackUrl` | `string` | `""` | Direct audio file URL (optional — auto-resolved if empty) |
| `trackTitle` | `string` | `""` | Track name (optional — auto-resolved) |
| `trackArtist` | `string` | `""` | Artist name (optional — auto-resolved) |
| `trackImage` | `string` | `""` | Album artwork URL (optional — auto-resolved) |
| `label` | `string` | `"Listen Now"` | Button text |
| `width` | `integer` | `0` | Button width preset (maps to `wp-block-button__width-{n}`) |
| `className` | `string` | `""` | Additional CSS classes |

All track attributes are optional because the block can auto-resolve them from post context (see render.php below).

## `render.php`

Server-side render callback with two phases: track resolution and HTML output.

### Phase 1: Track resolution

If `trackUrl` is empty (no explicit track set in attributes), the block resolves track data from the current post context:

#### Audio file
Queries `get_children()` for the first audio attachment of the current post, ordered by `menu_order`. Uses `wp_get_attachment_url()` to get the file URL. Falls back to the attachment's `post_title` or the post title for the track name.

#### Artist
Walks up the post hierarchy: if the current post is a `music_album` (checked via `Bifrost\Music\Support\Definitions::POST_TYPE_ALBUM`) and has a `post_parent`, gets the parent post's title as the artist name.

#### Album artwork
Gets the current post's featured image via `get_post_thumbnail_id()` + `wp_get_attachment_image_url()` at `medium` size.

If no audio file is found after resolution, the block renders nothing (`return`).

### Phase 2: HTML output

Renders standard `wp-block-button` markup:

```html
<div class="wp-block-button [has-custom-width] [wp-block-button__width-N] [className]"
     data-wp-interactive="bifrost-player"
     data-wp-context='{"trackUrl":"...","trackTitle":"...","trackArtist":"...","trackImage":"..."}'>
    <button class="wp-block-button__link wp-element-button"
            data-wp-on--click="actions.playTrack">
        Listen Now
    </button>
</div>
```

Key design decisions:

- **Uses `wp-block-button` / `wp-element-button` classes** — inherits the theme's button styles (colors, border-radius, typography) without custom CSS.
- **Context is set on the wrapper `<div>`** — when `actions.playTrack` fires, `getContext()` reads from the nearest ancestor with `data-wp-context`, which is this wrapper.
- **Width support** — the `width` attribute maps to WordPress core's button width classes (`has-custom-width`, `wp-block-button__width-25/50/75/100`), useful in `core/buttons` containers.
