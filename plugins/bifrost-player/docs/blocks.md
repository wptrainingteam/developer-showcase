# Blocks (Server-Side)

The PHP layer that registers blocks, renders the persistent player, and integrates with `core/playlist`.

## `inc/Block/BlockServiceProvider.php`

**Path:** `inc/Block/BlockServiceProvider.php`
**Class:** `Bifrost\Player\Block\BlockServiceProvider`
**Extends:** `ServiceProvider` **Implements:** `Bootable`

The main block orchestrator. On `boot()`:

1. **Registers blocks** — hooks into `init` to call `register_block_type()` for both `audio-player` and `play-button` from their `build/blocks/` directories.
2. **Renders the persistent player** — hooks into `wp_footer` to output `<!-- wp:bifrost-player/audio-player /-->` via `do_blocks()`. This is why the audio-player block has `"inserter": false` in its `block.json` — it's never placed by the editor, only rendered programmatically in the footer.
3. **Boots the playlist bridge** — resolves `RenderPlaylist` from the container and calls its `boot()` method.

### Why `wp_footer`?

Rendering the audio player in `wp_footer` places it outside all router regions. During client-side navigation, the router swaps content inside `<main>`, `<header>`, and `<footer>` regions, but the player (which sits after the footer closing tag) remains untouched. This is what makes it persistent.

## `inc/Block/RenderPlaylist.php`

**Path:** `inc/Block/RenderPlaylist.php`
**Class:** `Bifrost\Player\Block\RenderPlaylist`
**Implements:** `Bootable`

Filters the rendered output of `core/playlist` blocks to inject the playlist-to-player bridge.

### What it does

Hooks into the `render_block` filter. When the block is `core/playlist`:

1. Uses `WP_HTML_Tag_Processor` to find the `<figure>` element (the playlist wrapper).
2. Adds `data-wp-init="bifrost-player::callbacks.initPlaylistBridge"` to it.

This causes the Interactivity API to call `initPlaylistBridge()` when the playlist is initialized on the client. That callback sets up an event listener for `waveformplayer:play` events, bridging the core playlist's locked store to the persistent player.

### Why the `bifrost-player::` prefix?

The `core/playlist` block sets `data-wp-interactive="core/playlist"` on its elements, establishing the `core/playlist` namespace. Without the `bifrost-player::` prefix, the directive would look for `callbacks.initPlaylistBridge` in the `core/playlist` store, which doesn't have it. The prefix explicitly targets the `bifrost-player` store.

## `inc/Block/RenderPlaylistTrack.php`

**Path:** `inc/Block/RenderPlaylistTrack.php`
**Class:** `Bifrost\Player\Block\RenderPlaylistTrack`
**Implements:** `Bootable`

Filters the rendered output of `core/playlist-track` blocks to make individual tracks clickable via the persistent player.

### What it does

Hooks into the `render_block` filter. When the block is `core/playlist-track`:

1. Extracts the attachment ID from block attributes.
2. Calls `resolveTrackData()` to build the track context.
3. Uses `WP_HTML_Tag_Processor` to inject on the wrapper element:
   - `data-wp-interactive="bifrost-player"` — sets the Interactivity API namespace.
   - `data-wp-context` — JSON-encoded track data (`trackUrl`, `trackTitle`, `trackArtist`, `trackImage`).
   - `data-wp-on--click="actions.playTrack"` — click handler.
   - `style="cursor: pointer;"` — visual affordance.

### `resolveTrackData(attachmentId)`

Resolves all track metadata from a WordPress audio attachment:

1. Gets the attachment post and its URL.
2. Walks up the post hierarchy: attachment → album (`music_album` CPT) → artist (parent post).
3. Gets album artwork from the album's featured image.

Returns `null` if the attachment doesn't exist or has no URL, which causes the filter to skip injection.

### Dependency on `bifrost-music`

Uses `Bifrost\Music\Support\Definitions::POST_TYPE_ALBUM` to check the parent post type. This couples the track resolution to the `bifrost-music` plugin's data model (artist → album → track attachment hierarchy).
