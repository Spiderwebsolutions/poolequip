<?php
/**
 * size Description Widget
 *
 * When viewing a size archive, show the current size description + image
 *
 * @package		WooCommerce
 * @category	Widgets
 * @author		WooThemes
 */

class WC_Widget_size_Description extends WP_Widget {

	/** Variables to setup the widget. */
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/** constructor */
	function __construct() {

		/* Widget variable settings. */
		$this->woo_widget_name 			= __('WooCommerce size Description', 'wc_size' );
		$this->woo_widget_description 	= __( 'When viewing a size archive, show the current size description.', 'wc_size' );
		$this->woo_widget_idbase 		= 'wc_size_size_description';
		$this->woo_widget_cssclass 		= 'widget_size_description';

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget( $this->woo_widget_idbase, $this->woo_widget_name, $widget_ops );
	}

	/** @see WP_Widget */
	function widget( $args, $instance ) {
		extract( $args );

		if ( ! is_tax( 'product_size' ) )
			return;

		if ( ! get_query_var( 'term' ) )
			return;

		$thumbnail 		= '';
		$term 			= get_term_by( 'slug', get_query_var( 'term' ), 'product_size' );
		
		$thumbnail = get_size_thumbnail_url( $term->term_id, 'large' );

		echo $before_widget . $before_title . $term->name . $after_title;

		woocommerce_get_template( 'widgets/size-description.php', array(
			'thumbnail'	=> $thumbnail
		), 'woocommerce-size', untrailingslashit( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) ) . '/templates/' );

		echo $after_widget;
	}

	/** @see WP_Widget->update */
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		return $instance;
	}

	/** @see WP_Widget->form */
	function form( $instance ) {
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wc_size') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if ( isset ( $instance['title'] ) ) echo esc_attr( $instance['title'] ); ?>" />
			</p>
		<?php
	}

}