<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <div class="container cart">
        <h1>Items in Your Cart</h1>
        <?php the_content(); ?>
    </div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
