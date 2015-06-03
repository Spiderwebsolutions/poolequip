<?php
/**
 * size A-Z listing
 *
 * @usedby [product_size_list]
 */
?>
<div id="size_a_z">
		
	<ul class="size_index">
		<?php		
		foreach ( $index as $i )
			if ( isset( $product_size[ $i ] ) )
				echo '<li><a href="#size-' . $i . '">' . $i . '</a></li>';
			elseif ( $show_empty )
				echo '<li><span>' . $i . '</span></li>';
		?>
	</ul>
					
	<?php foreach ( $index as $i ) if ( isset( $product_size[ $i ] ) ) : ?>
		
		<h3 id="size-<?php echo $i; ?>"><?php echo $i; ?></h3>
		
		<ul class="size">
			<?php
			foreach ( $product_size[ $i ] as $size )
				echo '<li><a href="' . get_term_link( $size->slug, 'product_size' ) . '">' . $size->name . '</a></li>';
			?>
		</ul>
		
		<?php if ( $show_top_links ) : ?>
			<a class="top" href="#size_a_z"><?php _e( '&uarr; Top', 'wc_size' ) ?></a>
		<?php endif; ?>

	<?php endif; ?>
		
</div>