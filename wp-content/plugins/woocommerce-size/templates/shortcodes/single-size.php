<?php
/**
 * Single size
 *
 * @usedby [product_size]
 */
?>
<a href="<?php echo get_term_link( $term,  'product_size' ); ?>">
	<img src="<?php echo $thumbnail; ?>" alt="<?php echo $term->name; ?>" class="<?php echo $class; ?>" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>;" />
</a>