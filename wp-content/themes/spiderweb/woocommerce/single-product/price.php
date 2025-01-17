<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <h3>Price</h3>
	<span class="price"><?php echo $product->get_price_html(); ?></span>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>

<div class="shipping">
    <h3>Shipping</h3>
    <h4>Free Express Delivery</h4>
</div>
