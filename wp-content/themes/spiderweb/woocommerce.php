<?php get_header(); ?>
    <?php if (is_product_category() || isset($_GET['post_type']))://Display Category Page?>
        <?php wc_get_template( 'archive-product.php' ); ?>
    <?php elseif (is_shop())://Custom main shop page?>
        <div class="container">
            <div class="container" id="home">
                <div><a href="/poolequip/shop/category/pumps"><div class="category" id="c-1"><h4>PUMPS</h4></div></a></div>
                <div><a href="/poolequip/shop/category/cleaners"><div class="category" id="c-2"><h4>CLEANERS</h4></div></a></div>
                <div><a href="/poolequip/shop/category/chlorinators"><div class="category" id="c-3"><h4>CHLORINATORS</h4></div></a></div>
                <div><a href="/poolequip/shop/category/filters"><div class="category" id="c-4"><h4>FILTERS</h4></div></a></div>
                <div><a href="/poolequip/shop/category/salt-cells"><div class="category" id="c-5"><h4>SALT CELLS</h4></div></a></div>
                <div><a href="/poolequip/shop/category/cartridges"><div class="category" id="c-6"><h4>CARTRIDGES</h4></div></a></div>
                <div><a href="/poolequip/shop/category/heating"><div class="category" id="c-7"><h4>HEATING</h4></div></a></div>
                <div><a href="/poolequip/shop/category/covers"><div class="category" id="c-8"><h4>COVERS</h4></div></a></div>
                <div><a href="/poolequip/shop/category/lighting"><div class="category" id="c-9"><h4>LIGHTING</h4></div></a></div>
                <div><a href="/poolequip/shop/category/accessories"><div class="category" id="c-10"><h4>ACCESSORIES</h4></div></a></div>
            </div>
        </div>
    <?php elseif (is_product())://Single Product Page?>
        <?php wc_get_template( 'single-product.php' ); ?>
    <?php endif ?>

<?php get_footer(); ?>
