<?php
/**
 * The template for displaying search forms in cbarnes_dev
 *
 * @package cbarnes_dev
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<?php _ex( 'Search for:', 'label', 'cbarnes_dev' ); ?>
	</label>
	<div class="input-group">
		<input type="search" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'cbarnes_dev' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'cbarnes_dev' ); ?>">
		<span class="input-group-btn">
			<button type="button" class="btn btn-default"><?php echo esc_attr_x( 'Search', 'submit button', 'cbarnes_dev' ); ?></button>
		</span>
	</div>
</form>
