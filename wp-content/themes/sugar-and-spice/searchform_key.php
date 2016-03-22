<?php
/**
 * The template for displaying search forms in Sugar & Spice
 *
 * @package Sugar & Spice
 */
?>
<form role="search" method="get" class="search-form" action="search.php">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'sugarspice' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'sugarspice' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="skey">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sugarspice' ); ?>">
</form>


