<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $reduction, $brands, $sizes;

$brand = get_brands();
$size = get_sizes();
if($brand) {
    if(array_key_exists($brand, $brands)) {
        $brands[$brand]++;
    }
    else {
        $brands[$brand] = 1;
    }
}
if($size) {
    if(array_key_exists($size, $sizes)) {
        $sizes[$size]++;
    }
    else {
        $sizes[$size] = 1;
    }
}

/*
 * By default all checkboxes are checked. When a checkbox is unselected
 * it submits a POST request. Any product type not listed is excluded.
 */
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $terms = get_the_terms( $post->ID, 'product_cat' );
    $show = false;
    $show_size = false;
    foreach($terms as $term) {
        $slug = ucfirst($term->slug);
        //If a product contains any one type, it will be listed.
        if(isset($_POST[$slug])) {
                $show = true;
        }
    }
    if(!isset($_POST[strip_tags($brand)])) {
        $show = false;
    }
    $sizes = explode( ', ', strip_tags($size));
    foreach($sizes as $s) {
        if(isset($_POST[$s])) {
            $show_size = true;
        }
    }
    if(!$show && !$show_size) {
        $reduction++;
        return;
    }
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div class="shop-product">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <?php
            if(!get_brands()) {
                echo '<h2 style="color: red; position: absolute;">MISSING BRAND</h2>';
            }
            if(!get_sizes()) {
                echo '<h2 style="color: red; position: absolute;">MISSING SIZE</h2>';
            }
        ?>

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( $post->ID, 200 );
            } elseif ( wc_placeholder_img_src() ) {
               echo wc_placeholder_img( 200 );
            }
		?>

		<h3><?php the_title(); ?></h3>

        <?php if ($product->virtual == 'yes'): ?>
             <button class="email-price">Special Price</button>
		<?php else: ?>
            <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        <?php endif ?>
        <a href="<?php the_permalink(); ?>">
            <button class="view-item">VIEW ITEM</button>
        </a>

</div>
