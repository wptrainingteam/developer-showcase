<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * @package DeveloperShowcase\DevInspector
 */

namespace DeveloperShowcase\DevInspector;

?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?> data-wp-context='{"state":{"enabled":false},"actions":{"toggleDevInspector":"toggleDevInspector"}}'>
	<button
		data-wp-interactive="dev-inspector"
		data-wp-bind--hidden="context"
		data-wp-bind--aria-pressed="state.enabled"
		data-wp-on--click="actions.toggleDevInspector"
		data-wp-on--click---otherone="actions.toggleDevInspector"
		class="toggle" type="button">
		<span class="toggle__display" hidden data-wp-on--click="actions.toggleDevInspector"></span>
	</button>
</div>
