<?php global $woocommerce; ?>
<!DOCTYPE html>
<head>

    <title>Poolequip</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Style Sheets -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

    <!-- Humanstxt -->
    <link type="text/plain" rel="author" href="//humans.txt" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="/poolequip/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/poolequip/favicon.ico" type="image/x-icon">

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav>
    <div>
        <ul>
            <?php wp_nav_menu( array( 'menu' => 'main' ) ); ?>
        </ul>
        <span class="icon-search"></span>
    </div>
</nav>
<div class="logo">
    <div class="half">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/art/logo.png" />
    </div>
    <div class="half contact-cart">
        <div class="phone">
            <a href="tel:1300160693"><span class="icon-phone"></span>1300 160 693</a>
        </div>
        <div class="cart">
            <?php $print = (WC()->cart->cart_contents_count > 9) ? '<p id="large">' : '<p>'?>
            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><span class="icon-cart"></span></a><?php echo $print; echo WC()->cart->cart_contents_count; ?></p>
        </div>
    </div>
</div>
<div class="category-headers">
    <div>
        <ul>
            <?php
            $terms = get_terms('product_cat', array('hide_empty' => 0, 'orderby'=> 'ID', 'parent' =>0));
            $count = 1;
            if (count($terms) > 0) {
                foreach ($terms as $term) {
                    if($count % 2 == 0) {
                        if (strpos($_SERVER['REQUEST_URI'], $term->slug) !== false) {
                            echo '<li class="high active" id="c-' . $count . '"><a href="' . site_url() . '/shop/category/' . $term->slug . '" title="' . $term->name . '">' . $term->name . '</a></li>';
                        }
                        else {
                            echo '<li class="high" id="c-' . $count . '"><a href="' . site_url() . '/shop/category/' . $term->slug . '" title="' . $term->name . '">' . $term->name . '</a></li>';
                        }
                    }
                    else {
                        if (strpos($_SERVER['REQUEST_URI'], $term->slug) !== false) {
                            echo '<li class="low active" id="c-' . $count . '"><a href="' . site_url() . '/shop/category/' . $term->slug . '" title="' . $term->name . '">' . $term->name . '</a></li>';
                        }
                        else {
                            echo '<li class="low" id="c-' . $count . '"><a href="' . site_url() . '/shop/category/' . $term->slug . '" title="' . $term->name . '">' . $term->name . '</a></li>';
                        }
                    }
                    $count++;
                }
            }
            ?>
        </ul>
    </div>
</div>
<div class="category-mobile">
    <p>Select what you are look for?</p>
    <select>
        <option><a href="/poolequip/category.html" >Pumps</a></option>
        <option><a href="/poolequip/category.html" >Cleaners</a></option>
        <option><a href="/poolequip/category.html" >Chlorinators</a></option>
        <option><a href="/poolequip/category.html" >Filters</a></option>
        <option><a href="/poolequip/category.html" >Salt Cells</a></option>
        <option><a href="/poolequip/category.html" >Cartridges</a></option>
        <option><a href="/poolequip/category.html" >Heating</a></option>
        <option><a href="/poolequip/category.html" >Covers</a></option>
        <option><a href="/poolequip/category.html" >Lighting</a></option>
        <option><a href="/poolequip/category.html" >Accessories</a></option>
    </select>
</div>