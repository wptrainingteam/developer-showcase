# AI Album Finder

An AI-powered chatbot that helps users discover music albums based on their preferences. Built using the WordPress AI SDK and Abilities API.

## Description

AI Album Finder (featuring "DigBot" by default) is an intelligent music discovery assistant that engages users in conversation about their musical tastes and recommends albums from your WordPress site's music collection. The chatbot uses AI to understand user preferences and surface relevant albums based on genres, artists, and other criteria.

## Features

- 🤖 AI-powered conversational interface
- 🎵 Discovers albums based on user preferences
- 🎨 Customizable bot name (easily change from DigBot to your preferred name)
- 🔍 Integrates with WordPress custom post types (Artist, Album, Song)
- 📊 Uses WordPress Abilities API for data access
- 💬 Clean, modern chat interface
- ⚙️ Admin settings for easy configuration

## Requirements

- WordPress 6.8 or higher
- PHP 8.0 or higher
- Composer
- OpenAI API key (for AI functionality)

## Installation

1. Clone or download this plugin to your `wp-content/plugins/ai-album-finder` directory

2. Install PHP dependencies:
```bash
cd wp-content/plugins/ai-album-finder
composer install
```

3. Activate the plugin through the WordPress admin panel

4. Navigate to **Settings → AI Album Finder** and configure:
   - Bot Name (default: "DigBot")
   - OpenAI API Key

## Data Structure

The plugin expects the following custom post types and taxonomies to exist:

### Custom Post Types

- **Artist** - Individual musical artists
- **Album** - Albums (with Artist as parent post)
- **Song** - Individual songs (with Album as parent post)

### Taxonomies

- **Genre** - Musical genres (applied to Songs)

> Note: This plugin does not create these post types. They should be registered separately in your theme or another plugin.

## Usage

Once configured, the chatbot button will appear in the bottom-right corner of the WordPress admin area. Click it to start a conversation with your AI music assistant!

### Example Conversations

**User:** "I love rock music"
**Bot:** "Great! I love rock and metal music. Let me find some albums for you..."

**User:** "Show me some jazz albums"
**Bot:** "Excellent choice! Jazz and blues have such rich histories. I can help you discover some classic and contemporary albums..."

## WordPress Abilities

The plugin registers the following abilities for the AI to use:

### `get_albums`
Retrieves albums from the site based on search criteria.

**Arguments:**
- `genre` (string, optional) - Filter by genre
- `artist_name` (string, optional) - Filter by artist name
- `limit` (integer, optional) - Number of albums to return (default: 5)

### `get_genres`
Retrieves all available music genres from the site.

### `get_artists`
Retrieves artists from the site.

**Arguments:**
- `search` (string, optional) - Search for artists by name
- `limit` (integer, optional) - Number of artists to return (default: 10)

## Customization

### Changing the Bot Name

There are two ways to change the bot name:

1. **Via Admin Settings:** Go to Settings → AI Album Finder and change the "Bot Name" field

2. **Via Filter Hook:**
```php
add_filter( 'ai_album_finder_bot_name', function( $name ) {
    return 'Your Custom Bot Name';
} );
```

### Styling

The chatbot styles can be customized by overriding the CSS classes in your theme:

- `.ai-album-finder-chatbot-button` - Floating chat button
- `.ai-album-finder-chatbot-window` - Chat window container
- `.ai-album-finder-chatbot-header` - Chat header
- `.ai-album-finder-message` - Individual messages

## Development

### File Structure

```
ai-album-finder/
├── ai-album-finder.php          # Main plugin file
├── composer.json                 # PHP dependencies
├── scoper.inc.php               # Dependency prefixing config
├── includes/                     # PHP classes
│   ├── Plugin_Autoloader.php    # Autoloader
│   └── Plugin_Main.php          # Main plugin class
├── src/                         # Frontend assets
│   ├── chatbot.css              # Chatbot styles
│   └── chatbot.js               # Chatbot functionality
├── tools/                       # Development tools
│   └── php/
│       └── prefix/              # PHP-Scoper for dependencies
└── README.md                    # This file
```

### Building Dependencies

To build and prefix third-party dependencies:

```bash
composer install
```

This will automatically:
1. Install dependencies
2. Prefix them to avoid conflicts
3. Generate optimized autoloader

## API Endpoints

### POST `/wp-json/ai-album-finder/v1/chat`

Send a message to the chatbot.

**Request Body:**
```json
{
  "message": "I love jazz music",
  "history": []
}
```

**Response:**
```json
{
  "success": true,
  "response": "Excellent choice! Jazz and blues have such rich histories..."
}
```

## Future Enhancements

- Full WordPress AI SDK integration with proper AI service providers
- Support for multiple AI providers (OpenAI, Anthropic, etc.)
- Advanced conversation memory and context
- Album recommendations based on listening history
- Integration with music streaming services
- Voice input support
- Multi-language support

## Contributing

Contributions are welcome! Please follow WordPress coding standards and submit pull requests to the main repository.

## License

This plugin is licensed under the GPLv2 or later - the same license as WordPress itself.

## Credits

- Built by the WordPress Training Team
- Inspired by [wp-ai-sdk-chatbot-demo](https://github.com/felixarntz/wp-ai-sdk-chatbot-demo) by Felix Arntz
- Uses [WordPress AI Client](https://github.com/WordPress/wp-ai-client)
- Uses [WordPress Abilities API](https://github.com/WordPress/abilities-api)

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/wptrainingteam/developer-showcase/).
