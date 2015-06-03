<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

    echo '<div class="breadcrumbs"><ul>';

	foreach ( $breadcrumb as $key => $crumb ) {
		if (  $key != 0 ) {
            echo '<li><a href="' . esc_url( $crumb[1] ) . '" >' . esc_html( $crumb[0] ) . '</a></li>';
		}
	}

	echo '</ul></div>';

}