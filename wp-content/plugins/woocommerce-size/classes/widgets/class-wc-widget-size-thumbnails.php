<?php
/**
 * size Thumbnails Widget
 *
 * Show size images as thumbnails
 *
 * @package		WooCommerce
 * @category	Widgets
 * @author		WooThemes
 */

class WC_Widget_size_Thumbnails extends WP_Widget {

	/** Variables to setup the widget. */
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/** constructor */
	function __construct() {

		/* Widget variable settings. */
		$this->woo_widget_name 			= __('WooCommerce size Thumbnails', 'wc_size' );
		$this->woo_widget_description 	= __( 'Show a grid of size thumbnails.', 'wc_size' );
		$this->woo_widget_idbase 		= 'wc_size_size_thumbnails';
		$this->woo_widget_cssclass 		= 'widget_size_thumbnails';

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget( $this->woo_widget_idbase, $this->woo_widget_name, $widget_ops );
	}

	/** @see WP_Widget */
	function widget( $args, $instance ) {
		extract( $args );
		
		$exclude = array_map( 'intval', explode( ',', $instance['exclude'] ) );
		$order = $instance['orderby'] == 'name' ? 'asc' : 'desc';

		$size = get_terms( 'product_size', array( 'hide_empty' => $instance['hide_empty'], 'orderby' => $instance['orderby'], 'exclude' => $exclude, 'number' => $instance['number'], 'order' => $order ) );

		if ( ! $size ) 
			return;

	        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->woo_widget_idbase );
	
	        echo $args['before_widget'];
	        if ( $title !== '' ) {
	        	echo $args['before_title'] . $title . $args['after_title'];
	        }

		woocommerce_get_template( 'widgets/size-thumbnails.php', array(
			'size'	=> $size,
			'columns'	=> $instance['columns']
		), 'woocommerce-size', untrailingslashit( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) ) . '/templates/' );

		echo $after_widget;
	}

	/** @see WP_Widget->update */
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['columns'] = strip_tags( stripslashes( $new_instance['columns'] ) );
		$instance['orderby'] = strip_tags( stripslashes( $new_instance['orderby'] ) );
		$instance['exclude'] = strip_tags( stripslashes( $new_instance['exclude'] ) );
		$instance['hide_empty'] = strip_tags( stripslashes( $new_instance['hide_empty'] ) );
		$instance['number'] = strip_tags( stripslashes( $new_instance['number'] ) );
		
		if ( ! $instance['columns'] )
			$instance['columns'] = 1;
			
		if ( ! $instance['orderby'] )
			$instance['orderby'] = 'name';
			
		if ( ! $instance['exclude'] )
			$instance['exclude'] = '';
			
		if ( ! $instance['hide_empty'] )
			$instance['hide_empty'] = 0;
			
		if ( ! $instance['number'] )
			$instance['number'] = '';
		
		return $instance;
	}

	/** @see WP_Widget->form */
	function form( $instance ) {
		if ( ! isset( $instance['hide_empty'] ) ) 
			$instance['hide_empty'] = 0;
		if ( ! isset( $instance['orderby'] ) ) 
			$instance['orderby'] = 'name';
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wc_size') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php if ( isset ( $instance['title'] ) ) echo esc_attr( $instance['title'] ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e('Columns:', 'wc_size') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" value="<?php if ( isset ( $instance['columns'] ) ) echo esc_attr( $instance['columns'] ); else echo '1'; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number:', 'wc_size') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php if ( isset ( $instance['number'] ) ) echo esc_attr( $instance['number'] ); ?>" placeholder="<?php _e('All', 'wc_size'); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php _e('Exclude:', 'wc_size') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" value="<?php if ( isset ( $instance['exclude'] ) ) echo esc_attr( $instance['exclude'] ); ?>" placeholder="<?php _e('None', 'wc_size'); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'hide_empty' ); ?>"><?php _e('Hide empty size:', 'wc_size') ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>">
					<option value="1" <?php selected( $instance['hide_empty'], 1 ) ?>><?php _e('Yes', 'wc_size') ?></option>
					<option value="0" <?php selected( $instance['hide_empty'], 0 ) ?>><?php _e('No', 'wc_size') ?></option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('Order by:', 'wc_size') ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
					<option value="name" <?php selected( $instance['orderby'], 'name' ) ?>><?php _e('Name', 'wc_size') ?></option>
					<option value="count" <?php selected( $instance['orderby'], 'count' ) ?>><?php _e('Count', 'wc_size') ?></option>
				</select>
			</p>
		<?php
	}

}
