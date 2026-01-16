# Color Reference

This is the color reference for the theme. The CSS Custom Property is listed along with the primitive colors that it'll likely be mapped to. For usage, always reference the CSS Custom Property.

Next to each color is the light and dark primitive colors that will be used. This is so that we can enable a color switcher. That's why it's important to use the named CSS Custom Property.

## Background/Surface

Use for content background and overlays.

- `var(--wp--preset--color--background-level-0)`: `white` / `neutral-950`
- `var(--wp--preset--color--background-level-1)`: `neutral-50` / `neutral-900`
- `var(--wp--preset--color--background-level-2)`: `neutral-100` / `neutral-800`
- `var(--wp--preset--color--background-accent)`: `primary-600` / `primary-700`
- `var(--wp--preset--color--background-overlay)`: `neutral-100` / `neutral-800`

## Foreground/Text/Content

Use for text and icons that sit on one of the existing background colors.

- `var(--wp--preset--color--foreground-default)`: `neutral-900` / `neutral-200`
- `var(--wp--preset--color--foreground-subtle)`: `neutral-600` / `neutral-400`
- `var(--wp--preset--color--foreground-muted)`: `neutral-400` / `neutral-600`
- `var(--wp--preset--color--foreground-accent)`: `primary-700` / `primary-300`
- `var(--wp--preset--color--foreground-on-accent)`: `white` / `white`
- `var(--wp--preset--color--foreground-on-overlay)`: `white` / `neutral-800`

## Borders

Use for borders on elements that sit on one of the existing backgrounds. `bounds` is the default.

- `var(--wp--preset--color--border-bounds)`: `neutral-200` / `neutral-800`
- `var(--wp--preset--color--border-emphasis)`: `neutral-700` / `neutral-400`
- `var(--wp--preset--color--border-accent)`: `primary-700` / `primary-300`

## Buttons

### Button: Filled (default variation)

- `var(--wp--preset--color--button-filled-background)`: `primary-600` / `primary-700`
- `var(--wp--preset--color--button-filled-background-interact)`: `primary-700` / `primary-600`
- `var(--wp--preset--color--button-filled-foreground)`: `white` / `white`

## Links

### Link: Primary

- `var(--wp--preset--color--link-primary-foreground)`: `primary-700` / `primary-300`
- `var(--wp--preset--color--link-primary-foreground-interact)`: `neutral-900` / `neutral-200`

### Link: Secondary

- `var(--wp--preset--color--link-secondary-foreground)`: `neutral-900` / `neutral-200`
- `var(--wp--preset--color--link-secondary-foreground-interact)`: `primary-700` / `primary-300`

## Black/White

Note that Black and White colors are **always** black and white and do not change when switching to light/dark mode. There are always a few theme-related use cases where this is needed, but you should generally avoid using these.

- `var(--wp--preset--color--black)`: `#000` / `#000`
- `var(--wp--preset--color--white)`: `#fff` / `#fff`
