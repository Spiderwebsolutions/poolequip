<?php

// Include shortcodes
include 'shortcodes.php';

//Removes WooCommerce Unsupported Theme error message
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function woocommerce_subcats_from_parentcat_by_NAME($parent_cat_NAME) {
    $IDbyNAME = get_term_by('name', $parent_cat_NAME, 'product_cat');
    $product_cat_ID = $IDbyNAME->term_id;
    $args = array(
        'hierarchical' => 1,
        'show_option_none' => '',
        'hide_empty' => 0,
        'parent' => $product_cat_ID,
        'taxonomy' => 'product_cat'
    );
    $subcats = get_categories($args);
    echo '<form class="type" action="'.$_SERVER['REQUEST_URI'].'" method="POST">';
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            foreach ($subcats as $sc) {
                if (isset($_POST[$sc->name])) {
                    echo '<input type="checkbox" id="' . $sc->name . '" name="' . $sc->name . '" onchange="document.getElementById(\'type\').submit()" checked>';
                } else {
                    echo '<input type="checkbox" id="' . $sc->name . '" name="' . $sc->name . '" onchange="document.getElementById(\'type\').submit()" >';
                }
                echo '<label for="' . $sc->name . '"><span></span>' . $sc->name . ' <em>(' . $sc->count . ') items</em></label>';
            }
        } else {
            foreach ($subcats as $sc) {
                echo '<input type="checkbox" id="' . $sc->name . '" name="' . $sc->name . '" onchange="document.getElementById(\'type\').submit()" checked>';
                echo '<label for="' . $sc->name . '"><span></span>' . $sc->name . ' <em>(' . $sc->count . ') items</em></label>';
            }
        }
    echo '</form>';
}

function init_theme () {

	// Theme dependencies + WooCommerce product page
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'product' ) );
	register_nav_menus( array(
		'primary-navigation' => __( 'Primary Navigation' )
	) );

	// Initialize AJAX dependencies
	wp_localize_script( 'jquery', 'AJAX', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'template_directory' => get_bloginfo( 'template_directory' )
	) );

}
add_action( 'init', 'init_theme' );

function init_scripts () {

	// Script dependencies. jQuery and jQuery UI/Effects cores by default.
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core', '', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-effects-core', '', array( 'jquery-ui-core', 'jquery' ) );

}
add_action( 'wp_enqueue_scripts', 'init_scripts', 10, 0 );

// Basic breadcrumb functionality
function the_breadcrumbs () {

	echo get_the_breadcrumbs();

}

function get_the_breadcrumbs () {

	global $post;

	// Initialize return <ul> and add homepage by default
	$output = '<ul>';
	$output = '<li><a href="' . home_url() . '">Home</a></li>';

	// Prepare array to store all posts in current tree
	$posts = array( $post->post_name => $post );

	if( !is_front_page() ) {

		do {
			$post = wp_get_single_post( $post->post_parent );
			$posts[$post->post_name] = $post;
		}
		while( $post->post_parent );

	}

	foreach( array_reverse( $posts ) as $single )
		$output .= sprintf( '<li><a href="%s">%s</a></li>', get_permalink( $single->ID ), $single->post_title );

	$output .= '</ul>';

	return $output;

}

// Helper functions
function pre ( $data ) {

	echo '<pre>' . print_r( $data, true ) . '</pre>';

}

// WordPress login form styling
function login_logo () {

	?>
    <style type="text/css">
        body.login div#login h1 a {
            	display: block;
            	width: 100%;
		background-image: url( '<?php echo get_bloginfo( 'template_directory' ) ?>/assets/art/login-logo.png' ) !important;
		background-size: auto !important;
        }
    </style>
    <?php
}
add_action( 'login_enqueue_scripts', 'login_logo' );

function login_logo_url () {

    return get_bloginfo( 'url' );

}
add_filter( 'login_headerurl', 'login_logo_url' );

function login_logo_url_title () {

    return 'BirdBrain Logic CMS';

}
add_filter( 'login_headertitle', 'login_logo_url_title' );

?>
