<?php

/**
 * WC_size class.
 */
class WC_size {

	var $template_url;
	var $plugin_path;

	/**
	 * __construct function.
	 */
	public function __construct() {
		$this->template_url = apply_filters( 'woocommerce_template_url', 'woocommerce/' );

		add_action( 'woocommerce_register_taxonomy', array( __CLASS__, 'init_taxonomy' ) );
		add_action( 'widgets_init', array( $this, 'init_widgets' ) );
		add_filter( 'template_include', array( $this, 'template_loader' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp', array( $this, 'body_class' ) );

		add_action( 'woocommerce_product_meta_end', array( $this, 'show_size' ) );

		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'size-thumb', 300, 9999 );
		}

		if ( get_option( 'wc_size_show_description' ) == 'yes' )
			add_action( 'woocommerce_archive_description', array( $this, 'size_description' ) );

		$this->register_shortcodes();
    }

    function body_class() {
	    if ( is_tax( 'product_size' ) ) {
			add_filter( 'body_class', array( $this, 'add_body_class' ) );
		}
    }

    function add_body_class( $classes ) {
    	$classes[] = 'woocommerce';
    	$classes[] = 'woocommerce-page';
    	return $classes;
    }

    function styles() {
	    wp_enqueue_style( 'size-styles', plugins_url( '/assets/css/style.css', dirname( __FILE__ ) ) );
    }

	/**
	 * init_taxonomy function.
	 *
	 * @access public
	 */
	public static function init_taxonomy() {
		global $woocommerce;

		$shop_page_id = woocommerce_get_page_id( 'shop' );

		$base_slug = $shop_page_id > 0 && get_page( $shop_page_id ) ? get_page_uri( $shop_page_id ) : 'shop';

		$category_base = get_option('woocommerce_prepend_shop_page_to_urls') == "yes" ? trailingslashit( $base_slug ) : '';

		$cap = version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ? 'manage_woocommerce_products' : 'edit_products';

		register_taxonomy( 'product_size',
	        array('product'),
	        apply_filters( 'register_taxonomy_product_size', array(
	            'hierarchical' 			=> true,
	            'update_count_callback' => '_update_post_term_count',
	            'label' 				=> __( 'Size', 'wc_size'),
	            'labels' => array(
	                    'name' 				=> __( 'Size', 'wc_size' ),
	                    'singular_name' 	=> __( 'Size', 'wc_size' ),
	                    'search_items' 		=> __( 'Search Sizes', 'wc_size' ),
	                    'all_items' 		=> __( 'All Sizes', 'wc_size' ),
	                    'parent_item' 		=> __( 'Parent Size', 'wc_size' ),
	                    'parent_item_colon' => __( 'Parent Size:', 'wc_size' ),
	                    'edit_item' 		=> __( 'Edit Size', 'wc_size' ),
	                    'update_item' 		=> __( 'Update Size', 'wc_size' ),
	                    'add_new_item' 		=> __( 'Add New Size', 'wc_size' ),
	                    'new_item_name' 	=> __( 'New Size Name', 'wc_size' )
	            	),
	            'show_ui' 				=> true,
	            'show_in_nav_menus' 	=> true,
				'capabilities'			=> array(
					'manage_terms' 		=> $cap,
					'edit_terms' 		=> $cap,
					'delete_terms' 		=> $cap,
					'assign_terms' 		=> $cap
				),
	            'rewrite' 				=> array( 'slug' => $category_base . __( 'size', 'wc_size' ), 'with_front' => false, 'hierarchical' => true )
	        ) )
	    );
	}

	/**
	 * init_widgets function.
	 *
	 * @access public
	 */
	function init_widgets() {

		// Inc
		require_once( 'widgets/class-wc-widget-size-description.php' );
		require_once( 'widgets/class-wc-widget-size-nav.php' );
		require_once( 'widgets/class-wc-widget-size-thumbnails.php' );

		// Register
		register_widget( 'WC_Widget_size_Description' );
		register_widget( 'WC_Widget_size_Nav' );
		register_widget( 'WC_Widget_size_Thumbnails' );
	}

	/**
	 * Get the plugin path
	 */
	function plugin_path() {
		if ( $this->plugin_path ) return $this->plugin_path;

		return $this->plugin_path = untrailingslashit( plugin_dir_path( dirname( __FILE__ ) ) );
	}

	/**
	 * template_loader
	 *
	 * Handles template usage so that we can use our own templates instead of the themes.
	 *
	 * Templates are in the 'templates' folder. woocommerce looks for theme
	 * overides in /theme/woocommerce/ by default
	 *
	 * For beginners, it also looks for a woocommerce.php template first. If the user adds
	 * this to the theme (containing a woocommerce() inside) this will be used for all
	 * woocommerce templates.
	 */
	function template_loader( $template ) {

		$find = array( 'woocommerce.php' );
		$file = '';

		if ( is_tax( 'product_size' ) ) {

			$term = get_queried_object();

			$file 		= 'taxonomy-' . $term->taxonomy . '.php';
			$find[] 	= 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] 	= $this->template_url . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] 	= $file;
			$find[] 	= $this->template_url . $file;

		}

		if ( $file ) {
			$template = locate_template( $find );
			if ( ! $template ) $template = $this->plugin_path() . '/templates/' . $file;
		}

		return $template;
	}

	/**
	 * size_image function.
	 *
	 * @access public
	 */
	function size_description() {

		if ( ! is_tax( 'product_size' ) )
			return;

		if ( ! get_query_var( 'term' ) )
			return;

		$thumbnail = '';

		$term = get_term_by( 'slug', get_query_var( 'term' ), 'product_size' );
		$thumbnail = get_size_thumbnail_url( $term->term_id, 'full' );

		woocommerce_get_template( 'size-description.php', array(
			'thumbnail'	=> $thumbnail
		), 'woocommerce-size', $this->plugin_path() . '/templates/' );
	}

	/**
	 * show_size function.
	 *
	 * @access public
	 * @return void
	 */
	function show_size() {
		global $post;

		if ( is_singular( 'product' ) ) {

			$taxonomy = get_taxonomy( 'product_size' ); 
			$labels   = $taxonomy->labels;

			echo get_sizes( $post->ID, ', ', ' <span class="posted_in">' . $labels->name . ': ', '.</span>' );
		}
	}

	/**
	 * register_shortcodes function.
	 *
	 * @access public
	 */
	function register_shortcodes() {

		add_shortcode( 'product_size', array( $this, 'output_product_size' ) );
		add_shortcode( 'product_size_thumbnails', array( $this, 'output_product_size_thumbnails' ) );
		add_shortcode( 'product_size_list', array( $this, 'output_product_size_list' ) );

	}

	/**
	 * output_product_size function.
	 *
	 * @access public
	 */
	function output_product_size( $atts ) {
		global $post;

		extract( shortcode_atts( array(
		      'width'   => '',
		      'height'  => '',
		      'class'   => 'aligncenter',
		      'post_id' => ''
	    ), $atts ) );

	    if ( ! $post_id && ! $post )
	    	return;

		if ( ! $post_id )
			$post_id = $post->ID;

		$size = wp_get_post_terms( $post_id, 'product_size', array( "fields" => "ids" ) );

		if ( $size )
			$size = $size[0];

		if ( ! empty( $size ) ) {

			$thumbnail = get_size_thumbnail_url( $size );

			if ( $thumbnail ) {

				$term = get_term_by( 'id', $size, 'product_size' );

				if ( $width || $height ) {
					$width = $width ? $width : 'auto';
					$height = $height ? $height : 'auto';
				}

				ob_start();

				woocommerce_get_template( 'shortcodes/single-size.php', array(
					'term'		=> $term,
					'width'		=> $width,
					'height'	=> $height,
					'thumbnail'	=> $thumbnail,
					'class'		=> $class
				), 'woocommerce-size', untrailingslashit( plugin_dir_path( dirname( __FILE__ ) ) ) . '/templates/' );

				return ob_get_clean();

			}
		}

	}

	/**
	 * output_product_size_list function.
	 *
	 * @access public
	 * @return void
	 */
	function output_product_size_list( $atts ) {

		extract( shortcode_atts( array(
			'show_top_links'    => true,
			'show_empty'        => true,
			'show_empty_size' => false
		), $atts ) );

		if ( $show_top_links === "false" )
			$show_top_links = false;

		if ( $show_empty === "false" )
			$show_empty = false;

		if ( $show_empty_size === "false" )
			$show_empty_size = false;

		$product_size = array();
		$terms          = get_terms( 'product_size', array( 'hide_empty' => ( $show_empty_size ? 0 : 1 ) ) );

		foreach ( $terms as $term ) {

			$term_letter = substr( $term->slug, 0, 1 );

			if ( ctype_alpha( $term_letter ) ) {

				foreach ( range( 'a', 'z' ) as $i )
					if ( $i == $term_letter ) {
						$product_size[ $i ][] = $term;
						break;
					}

			} else {
				$product_size[ '0-9' ][] = $term;
			}

		}

		ob_start();

		woocommerce_get_template( 'shortcodes/size-a-z.php', array(
			'terms'				=> $terms,
			'index'				=> array_merge( range( 'a', 'z' ), array( '0-9' ) ),
			'product_size'	=> $product_size,
			'show_empty'		=> $show_empty,
			'show_top_links'	=> $show_top_links
		), 'woocommerce-size', untrailingslashit( plugin_dir_path( dirname( __FILE__ ) ) ) . '/templates/' );

		return ob_get_clean();
	}

	/**
	 * output_product_size_thumbnails function.
	 *
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	function output_product_size_thumbnails( $atts ) {

		extract( shortcode_atts( array(
		      'show_empty' 		=> true,
		      'columns'			=> 4,
		      'hide_empty'		=> 0,
		      'orderby'			=> 'name',
		      'exclude'			=> '',
		      'number'			=> ''
	     ), $atts ) );

	    $exclude = array_map( 'intval', explode(',', $exclude) );
	    $order = $orderby == 'name' ? 'asc' : 'desc';

		$size = get_terms( 'product_size', array( 'hide_empty' => $hide_empty, 'orderby' => $orderby, 'exclude' => $exclude, 'number' => $number, 'order' => $order ) );

		if ( ! $size )
			return;

		ob_start();

		woocommerce_get_template( 'widgets/size-thumbnails.php', array(
			'size'	=> $size,
			'columns'	=> $columns
		), 'woocommerce-size', untrailingslashit( plugin_dir_path( dirname( __FILE__ ) ) ) . '/templates/' );

		return ob_get_clean();
	}
}

$GLOBALS['WC_size'] = new WC_size();