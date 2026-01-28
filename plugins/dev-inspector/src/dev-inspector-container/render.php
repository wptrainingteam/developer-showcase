<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * @package DeveloperShowcase\DevInspector
 */

namespace DeveloperShowcase\DevInspector;

?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?> data-wp-interactive="dev-inspector">
	<?php echo wp_kses_post( $content ); ?>
	<button data-wp-bind--hidden="!state.enabled">Show info</button>
</div>
