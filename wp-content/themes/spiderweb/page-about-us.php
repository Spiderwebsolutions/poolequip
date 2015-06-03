<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="container" id="about">
        <div class="content">
            <div class="content-half">
                <h2>About Us</h2>
                <?php the_content(); ?>
            </div>
            <div class="content-half">
                <ul>
                    <li id="title">WHY CHOOSE POOLEQUIP?</li>
                    <li>Customised <b>Solutions</b></li>
                    <li><b>Lowest</b> price guaranteed</li>
                    <li><b>30</b> Years Experience</li>
                    <li>Free <b>Express</b> Shipping</li>
                    <li>30-Day Money Back <b>Guarantee</b></li>
                    <li><b>Latest</b> Products</li>
                </ul>
            </div>
        </div>
    </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
