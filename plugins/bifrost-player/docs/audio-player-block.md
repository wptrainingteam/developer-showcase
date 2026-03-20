# Audio Player Block

**Block name:** `bifrost-player/audio-player`
**Path:** `src/blocks/audio-player/`

The persistent audio player bar that stays visible and playing across page navigations.

## `block.json`

Block metadata registration:

- **`apiVersion: 3`** — latest block API.
- **`supports.interactivity: true`** — enables Interactivity API directives.
- **`supports.inserter: false`** — hidden from the block inserter. The player is rendered programmatically in `wp_footer` by `BlockServiceProvider`, not placed by users in the editor.
- **`editorScript: "file:./index.js"`** — required for `wp-scripts` to create a webpack entry point and extract `style-index.css`. The editor script itself is minimal.
- **`viewScriptModule: "file:./view.js"`** — the Interactivity API store, built as a script module (ESM) via `--experimental-modules`.
- **`style: "file:./style-index.css"`** — player bar styles, extracted from `style.css` by webpack.

## `index.js`

```js
import './style.css';
```

A minimal editor script whose only purpose is to create a webpack entry point so that `style.css` gets processed into `style-index.css`. Without an `editorScript` entry, `wp-scripts` doesn't create the scripts webpack entry and CSS is never extracted.

## `render.php`

Server-side render callback. Two responsibilities:

### 1. Initialize Interactivity API state

Calls `wp_interactivity_state('bifrost-player', ...)` to set the initial global state:

| State key | Initial value | Purpose |
|---|---|---|
| `currentTrackUrl` | `''` | URL of the audio file |
| `currentTrackTitle` | `''` | Track name |
| `currentTrackArtist` | `''` | Artist name |
| `currentTrackImage` | `''` | Album artwork URL |
| `isAudioPlaying` | `false` | Playback state |

This state is shared across all blocks in the `bifrost-player` namespace.

### 2. Render the player HTML

Outputs a hidden `<div>` with Interactivity API directives:

- **`data-wp-bind--hidden="!state.isPlayerVisible"`** — shows/hides the player based on whether a track URL is set.
- **`data-wp-watch="callbacks.syncPlayback"`** — triggers the `syncPlayback` callback whenever reactive state changes.
- **Artwork** — `<img>` with `data-wp-bind--src="state.currentTrackImage"`.
- **Track info** — `<span>` elements with `data-wp-text` for title and artist.
- **Play/pause button** — `data-wp-on--click="actions.togglePlay"` with `data-wp-text="state.playPauseLabel"`.
- **Close button** — `data-wp-on--click="actions.closePlayer"`.
- **`<audio>` element** — `data-wp-bind--src="state.currentTrackUrl"` and `data-wp-on--ended="actions.onTrackEnded"`.

## `style.css`

Styles for the persistent player bar:

- Fixed to the bottom of the viewport.
- Flexbox layout: artwork (48x48) | track info (title + artist) | controls (play/pause + close).
- `z-index: 1000` to stay above page content.
- Imported by `index.js` and extracted by webpack into `style-index.css`.

## `view.js`

The Interactivity API store for the `bifrost-player` namespace. This is the client-side brain of the plugin.

### Imports

```js
import { store, getContext, getElement, withSyncEvent } from '@wordpress/interactivity';
```

### Derived state

| Getter | Logic |
|---|---|
| `isPlayerVisible` | `currentTrackUrl !== ''` — player shows when a track is loaded |
| `playPauseLabel` | Returns `⏸` or `▶` based on `isAudioPlaying` |

### Actions

#### `playTrack()`
Reads context from the element that triggered the action (set by `play-button`'s `data-wp-context` or `RenderPlaylistTrack`'s injected context). Copies `trackUrl`, `trackTitle`, `trackArtist`, `trackImage` into global state and sets `isAudioPlaying = true`.

#### `togglePlay()`
Flips `isAudioPlaying`. The `syncPlayback` callback reacts to this and calls `audio.play()` or `audio.pause()`.

#### `closePlayer()`
Sets `isAudioPlaying = false` and clears `currentTrackUrl`, which hides the player via `isPlayerVisible`.

#### `onTrackEnded()`
Fires when the `<audio>` element's `ended` event triggers. Resets `isAudioPlaying` to `false`.

#### `navigate(e)` — wrapped with `withSyncEvent`
Intercepts link clicks for client-side navigation:

1. `e.preventDefault()` runs synchronously (guaranteed by `withSyncEvent`).
2. Gets the href from `getElement().ref.href` (not `e.target.href`, which breaks with nested elements).
3. Dynamically imports `@wordpress/interactivity-router`.
4. Calls `actions.navigate(href)` to swap router regions without a full page reload.

`withSyncEvent` is critical here — without it, `e.preventDefault()` would run after the first `yield`, by which time the browser has already started the default navigation.

#### `prefetch()`
Fires on `mouseenter` of links. Dynamically imports the router and calls `actions.prefetch()` to preload the target page for faster navigation.

### Callbacks

#### `syncPlayback()`
A `data-wp-watch` callback that bridges reactive state to the imperative `<audio>` API:

- If `isAudioPlaying` is `true` and audio is paused → calls `audio.play()` (with `.catch(() => {})` to handle autoplay restrictions silently).
- If `isAudioPlaying` is `false` and audio is playing → calls `audio.pause()`.

Gets the `<audio>` element by querying the player's DOM via `getElement().ref.querySelector('audio')`.

#### `initPlaylistBridge()`
Injected on `core/playlist` `<figure>` elements by `RenderPlaylist.php` via `data-wp-init`. Sets up the event bridge:

1. Listens for `waveformplayer:play` events on the playlist figure.
2. When fired, extracts the waveform player instance from `event.detail.player`.
3. Pauses the waveform's own audio to prevent two simultaneous audio streams.
4. Transfers track metadata (`url`, `title`, `subtitle`, `artwork`) from the waveform player to the persistent player's state.
5. Sets `isAudioPlaying = true` to start playback in the persistent player.
