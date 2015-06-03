<?php
/**
 * Show a grid of thumbnails
 */
?>
<ul class="size-thumbnails">
	
	<?php foreach ( $size as $index => $size ) : 
		
		$thumbnail = get_size_thumbnail_url( $size->term_id, apply_filters( 'woocommerce_size_thumbnail_size', 'size-thumb' ) );
		
		if ( ! $thumbnail )
			$thumbnail = woocommerce_placeholder_img_src();
		
		$class = '';
		
		if ( $index == 0 || $index % $columns == 0 )
			$class = 'first';
		elseif ( ( $index + 1 ) % $columns == 0 )
			$class = 'last';
			
		$width = floor( ( ( 100 - ( ( $columns - 1 ) * 2 ) ) / $columns ) * 100 ) / 100;
		?>
		<li class="<?php echo $class; ?>" style="width: <?php echo $width; ?>%;">
			<a href="<?php echo get_term_link( $size->slug, 'product_size' ); ?>" title="<?php echo $size->name; ?>">
				<img src="<?php echo $thumbnail; ?>" alt="<?php echo $size->name; ?>" />
			</a>
		</li>

	<?php endforeach; ?>
	
</ul>