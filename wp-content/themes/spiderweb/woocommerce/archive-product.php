<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php //do_action( 'woocommerce_archive_description' ); ?>

        <div class="container" id="shop">

            <?php wc_get_template( 'global/sidebar.php' ); ?>

            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                <?php $args = array( 'post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1 );

                $products = new WP_Query( $args ); ?>

                <div class="shop-title">
                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                </div>

            <?php endif; ?>

            <?php if ( have_posts() ) : ?>

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php  ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif; ?>
           <?php  wc_get_template( 'loop/result-count.php' ); ?>
        </div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="overlay"></div>
<div id="dialog" title="Call or Email">
    <p>The following item that you have selected is only available by order. Please give us a <b>call on (08) 9248 7946</b> or we can <b>email</b> you the information:</p>
    <form>
        <input type="text" placeholder="Email*" />
        <button type="submit">Email Price</button>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
