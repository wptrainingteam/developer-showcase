# Implementation Guide for AI Album Finder

This guide will help you set up the required custom post types and taxonomy for the AI Album Finder plugin to work with your music collection.

## Prerequisites

Before using the AI Album Finder plugin, you need to:

1. Have WordPress 6.8+ and PHP 8.0+ installed
2. Register the required custom post types (Artist, Album, Song)
3. Register the Genre taxonomy
4. Have an OpenAI API key

## Step 1: Register Custom Post Types

Create a custom plugin or add this code to your theme's `functions.php` file:

```php
<?php
/**
 * Register Music Custom Post Types
 */

// Register Artist CPT
function register_artist_post_type() {
    $labels = array(
        'name'               => _x( 'Artists', 'post type general name', 'your-textdomain' ),
        'singular_name'      => _x( 'Artist', 'post type singular name', 'your-textdomain' ),
        'menu_name'          => _x( 'Artists', 'admin menu', 'your-textdomain' ),
        'add_new'            => _x( 'Add New', 'artist', 'your-textdomain' ),
        'add_new_item'       => __( 'Add New Artist', 'your-textdomain' ),
        'new_item'           => __( 'New Artist', 'your-textdomain' ),
        'edit_item'          => __( 'Edit Artist', 'your-textdomain' ),
        'view_item'          => __( 'View Artist', 'your-textdomain' ),
        'all_items'          => __( 'All Artists', 'your-textdomain' ),
        'search_items'       => __( 'Search Artists', 'your-textdomain' ),
        'not_found'          => __( 'No artists found.', 'your-textdomain' ),
        'not_found_in_trash' => __( 'No artists found in Trash.', 'your-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'artist' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-admin-users',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'artist', $args );
}
add_action( 'init', 'register_artist_post_type' );

// Register Album CPT
function register_album_post_type() {
    $labels = array(
        'name'               => _x( 'Albums', 'post type general name', 'your-textdomain' ),
        'singular_name'      => _x( 'Album', 'post type singular name', 'your-textdomain' ),
        'menu_name'          => _x( 'Albums', 'admin menu', 'your-textdomain' ),
        'add_new'            => _x( 'Add New', 'album', 'your-textdomain' ),
        'add_new_item'       => __( 'Add New Album', 'your-textdomain' ),
        'new_item'           => __( 'New Album', 'your-textdomain' ),
        'edit_item'          => __( 'Edit Album', 'your-textdomain' ),
        'view_item'          => __( 'View Album', 'your-textdomain' ),
        'all_items'          => __( 'All Albums', 'your-textdomain' ),
        'search_items'       => __( 'Search Albums', 'your-textdomain' ),
        'parent_item_colon'  => __( 'Parent Artist:', 'your-textdomain' ),
        'not_found'          => __( 'No albums found.', 'your-textdomain' ),
        'not_found_in_trash' => __( 'No albums found in Trash.', 'your-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'album' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true, // Allows parent posts (Artist)
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-album',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'album', $args );
}
add_action( 'init', 'register_album_post_type' );

// Register Song CPT
function register_song_post_type() {
    $labels = array(
        'name'               => _x( 'Songs', 'post type general name', 'your-textdomain' ),
        'singular_name'      => _x( 'Song', 'post type singular name', 'your-textdomain' ),
        'menu_name'          => _x( 'Songs', 'admin menu', 'your-textdomain' ),
        'add_new'            => _x( 'Add New', 'song', 'your-textdomain' ),
        'add_new_item'       => __( 'Add New Song', 'your-textdomain' ),
        'new_item'           => __( 'New Song', 'your-textdomain' ),
        'edit_item'          => __( 'Edit Song', 'your-textdomain' ),
        'view_item'          => __( 'View Song', 'your-textdomain' ),
        'all_items'          => __( 'All Songs', 'your-textdomain' ),
        'search_items'       => __( 'Search Songs', 'your-textdomain' ),
        'parent_item_colon'  => __( 'Parent Album:', 'your-textdomain' ),
        'not_found'          => __( 'No songs found.', 'your-textdomain' ),
        'not_found_in_trash' => __( 'No songs found in Trash.', 'your-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'song' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true, // Allows parent posts (Album)
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-audio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'song', $args );
}
add_action( 'init', 'register_song_post_type' );
```

## Step 2: Register Genre Taxonomy

Add this code to register the Genre taxonomy for Songs:

```php
<?php
/**
 * Register Genre Taxonomy
 */
function register_genre_taxonomy() {
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name', 'your-textdomain' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'your-textdomain' ),
        'search_items'      => __( 'Search Genres', 'your-textdomain' ),
        'all_items'         => __( 'All Genres', 'your-textdomain' ),
        'parent_item'       => __( 'Parent Genre', 'your-textdomain' ),
        'parent_item_colon' => __( 'Parent Genre:', 'your-textdomain' ),
        'edit_item'         => __( 'Edit Genre', 'your-textdomain' ),
        'update_item'       => __( 'Update Genre', 'your-textdomain' ),
        'add_new_item'      => __( 'Add New Genre', 'your-textdomain' ),
        'new_item_name'     => __( 'New Genre Name', 'your-textdomain' ),
        'menu_name'         => __( 'Genres', 'your-textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'genre', array( 'song', 'album' ), $args );
}
add_action( 'init', 'register_genre_taxonomy' );
```

## Step 3: Configure AI Album Finder

1. Install and activate the AI Album Finder plugin
2. Run `composer install` in the plugin directory
3. Go to **Settings → AI Album Finder**
4. Set your bot name (default is "DigBot")
5. Add your OpenAI API key
6. Click **Save Changes**

## Step 4: Add Sample Data

To test the plugin, create some sample content:

### Example Artist
- **Title:** The Beatles
- **Content:** Legendary British rock band from the 1960s

### Example Album (with Artist as parent)
- **Title:** Abbey Road
- **Parent:** The Beatles
- **Content:** Iconic album featuring "Come Together" and "Here Comes the Sun"

### Example Songs (with Album as parent)
- **Title:** Come Together
- **Parent:** Abbey Road
- **Genre:** Rock

- **Title:** Here Comes the Sun
- **Parent:** Abbey Road
- **Genre:** Rock

## Step 5: Use the Chatbot

1. Go to any admin page in WordPress
2. Click the purple chat button in the bottom-right corner
3. Start chatting about music preferences
4. The bot will recommend albums from your collection

### Example Conversations

**User:** "I'm looking for rock music"
**Bot:** "Great! I love rock and metal music. Let me find some albums for you..."

**User:** "Show me albums by The Beatles"
**Bot:** *(Will use the get_albums ability to search for Beatles albums)*

## Troubleshooting

### Chatbot button not appearing
- Verify OpenAI API key is configured
- Check browser console for JavaScript errors
- Ensure you're logged in to WordPress admin

### No albums returned
- Verify custom post types are registered
- Check that you have published albums
- Ensure albums have the correct parent relationships

### Autoloader error
- Run `composer install` in the plugin directory
- Check PHP version is 8.0 or higher

## Data Structure Example

```
Artist: Pink Floyd (post_type: artist)
├── Album: The Dark Side of the Moon (post_type: album, parent: Pink Floyd)
│   ├── Song: Time (post_type: song, parent: The Dark Side..., genre: Progressive Rock)
│   ├── Song: Money (post_type: song, parent: The Dark Side..., genre: Progressive Rock)
│   └── Song: Us and Them (post_type: song, parent: The Dark Side..., genre: Progressive Rock)
└── Album: Wish You Were Here (post_type: album, parent: Pink Floyd)
    ├── Song: Shine On You Crazy Diamond (post_type: song, parent: Wish You..., genre: Progressive Rock)
    └── Song: Wish You Were Here (post_type: song, parent: Wish You..., genre: Progressive Rock)
```

## Next Steps

- Customize the bot name to match your site's personality
- Add more sample data to provide better recommendations
- Extend the WordPress Abilities to add more query capabilities
- Integrate with the full WordPress AI SDK for enhanced AI responses

## Support

For issues or questions, please visit the [GitHub repository](https://github.com/wptrainingteam/developer-showcase/).
