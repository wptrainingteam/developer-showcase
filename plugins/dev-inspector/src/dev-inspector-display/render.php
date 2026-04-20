<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * @package DeveloperShowcase\DevInspector
 */

namespace DeveloperShowcase\DevInspector;

?>
<section <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?> data-wp-interactive="dev-inspector">
	<div class="dev-inspector-bucket" data-wp-on-click="ac>
		<h2>Explanation</h2>
		<p>This is a block that is rendered on the server.</p>
	</div>
	<div class="dev-inspector-bucket">
		<h2>Code One</h2>
		<code><?php echo esc_html( $content ); ?></code>
	</div>
	<div class="dev-inspector-bucket">
		<h2>Code Two</h2>
		<code><?php echo esc_html( $content ); ?></code>
	</div>
	<div class="dev-inspector-bucket">
		<h2>Resources</h2>
		<p>There are many resources to learn about server side rendering blocks:</p>
	</div>
</section>
