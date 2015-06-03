<?php
/*
Plugin Name: WooCommerce Size
Plugin URI: Modified
Description: Brand Taxonomy Modified
Version: 1.0.0
Author: N/A
Author URI: N/A
Requires at least: 3.3
Tested up to: 4.1

	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '8a88c7cbd2f1e73636c331c7a86f818c', '18737' );

if ( is_woocommerce_active() ) {

	/**
	 * Localisation
	 **/
	load_plugin_textdomain( 'wc_size', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/**
	 * WC_size classes
	 **/
	require_once( 'classes/class-wc-size.php' );

	if ( is_admin() ) {
		require_once( 'classes/class-wc-size-admin.php' );
	}

	register_activation_hook( __FILE__, array( 'WC_size', 'init_taxonomy' ), 10 );
	register_activation_hook( __FILE__, 'flush_rewrite_rules', 20 );

	/**
	 * Helper function :: get_size_thumbnail_url function.
	 *
	 * @access public
	 * @return string
	 */
	function get_size_thumbnail_url( $size_id, $size = 'full' ) {
		$thumbnail_id = get_woocommerce_term_meta( $size_id, 'thumbnail_id', true );

		if ( $thumbnail_id )
			return current( wp_get_attachment_image_src( $thumbnail_id, $size ) );
	}

	/**
	 * get_size function.
	 *
	 * @access public
	 * @param int $post_id (default: 0)
	 * @param string $sep (default: ')
	 * @param mixed '
	 * @param string $before (default: '')
	 * @param string $after (default: '')
	 * @return void
	 */
	function get_sizes( $post_id = 0, $sep = ', ', $before = '', $after = '' ) {
		global $post;

		if ( $post_id )
			$post_id = $post->ID;

		return get_the_term_list( $post_id, 'product_size', $before, $sep, $after );
	}
}
