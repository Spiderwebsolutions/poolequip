<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $brands, $sizes;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

    $terms = get_terms( 'product_brand', array( 'hide_empty' => '1' ) );
    foreach($terms as $term) {
        $brands[$term->name] = $term->count;
    }
    $terms = get_terms( 'product_size', array( 'hide_empty' => '1' ) );
    foreach($terms as $term) {
        $sizes[$term->name] = $term->count;
    }

?>
<aside>
    <div>
        <h3>SEARCH PRODUCTS</h3>
        <div>
            <?php wc_get_template( 'product-searchform.php' ); ?>
        </div>
    </div>
    <div>
        <h3>TYPE</h3>
        <div>
            <?php
                $IDbyNAME = get_term_by('name', 'Cleaners', 'product_cat');
                $product_cat_ID = $IDbyNAME->term_id;
                $args = array(
                'hierarchical' => 1,
                'show_option_none' => '',
                'hide_empty' => 0,
                'parent' => $product_cat_ID,
                'taxonomy' => 'product_cat'
                );
                $subcats = get_categories($args);
                echo '<form id="sideForm" action="'.$_SERVER['REQUEST_URI'].'" method="POST">';
                    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                        foreach ($subcats as $sc) {
                            if (isset($_POST[$sc->name])) {
                                echo '<input type="checkbox" form="sideForm" id="' . $sc->name . '" name="' . $sc->name . '" checked>';
                            }
                            else {
                                echo '<input type="checkbox" form="sideForm" id="' . $sc->name . '" name="' . $sc->name . '" >';
                            }
                            echo '<label for="' . $sc->name . '"><span></span>' . $sc->name . ' <em>(' . $sc->count . ') items</em></label>';
                        }
                    } else {
                        $tick = NULL;
                        foreach ($subcats as $sc) {
                            if(strpos($_SERVER['REQUEST_URI'], strtolower($sc->name)) !== false) {
                                $tick = $sc->name;
                            }
                        }
                        if(!is_null($tick)) {
                            echo $tick;
                            foreach ($subcats as $sc) {
                                if(strcmp($sc->name,$tick) == 0) {
                                    echo '<input type="checkbox" form="sideForm" id="' . $sc->name . '" name="' . $sc->name . '" checked>';
                                }
                                else {
                                    echo '<input type="checkbox" form="sideForm" id="' . $sc->name . '" name="' . $sc->name . '">';
                                }
                                echo '<label for="' . $sc->name . '"><span></span>' . $sc->name . ' <em>(' . $sc->count . ') items</em></label>';
                            }
                        }
                        else {
                            foreach ($subcats as $sc) {
                                echo '<input type="checkbox" form="sideForm" id="' . $sc->name . '" name="' . $sc->name . '" checked>';
                                echo '<label for="' . $sc->name . '"><span></span>' . $sc->name . ' <em>(' . $sc->count . ') items</em></label>';
                            }
                        }
                    }
                echo '</form>';
            ?>
        </div>
    </div>
    <div>
        <h3>BRANDS</h3>
        <div>
            <form>
                <input type="hidden" name="brands" />
                <?php
                    $keys = array_keys($brands);
                    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                        foreach ($keys as $key) {
                            if (isset($_POST[$key])) {
                                echo '<input type="checkbox" form="sideForm" id="'.$key.'" name="'.$key.'" checked>';
                            } else {
                                echo '<input type="checkbox" form="sideForm" id="'.$key.'" name="'.$key.'">';
                            }
                            echo '<label for='.$key.'><span></span>'.ucfirst($key).' <em>('.$brands[$key].') items</em></label>';
                        }
                    } else {
                        foreach($keys as $key) {
                            echo '<input type="checkbox" form="sideForm" id="'.$key.'" name="'.$key.'" checked>';
                            echo '<label for='.$key.'><span></span>'.ucfirst($key).' <em>('.$brands[$key].') items</em></label>';
                        }
                    }
                ?>
            </form>
        </div>
    </div>
    <div>
        <h3>POOL SIZE</h3>
        <div>
            <form>
                <?php
                $keys = array_keys($sizes);
                if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                    foreach ($keys as $key) {
                        if (isset($_POST[$key])) {
                            echo '<input type="checkbox" form="sideForm" id="'.$key.'" name="'.$key.'" checked>';
                        } else {
                            echo '<input type="checkbox" form="sideForm" id="'.$key.'" name="'.$key.'">';
                        }
                        echo '<label for='.$key.'><span></span>'.ucfirst($key).' <em>('.$sizes[$key].') items</em></label>';
                    }
                } else {
                    foreach($keys as $key) {
                        echo '<input type="checkbox" form="sideForm" id="'.$key.'" name="'.$key.'" checked>';
                        echo '<label for='.$key.'><span></span>'.ucfirst($key).' <em>('.$sizes[$key].') items</em></label>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <div id="abId0.5873965846840292">
        <h3>PRICE RANGE</h3>
        <div class="price-range" id="abId0.1927789559122175">
            <p id="abId0.17221641005016863" abineguid="10CCE7A5396541B8837AA941CACB1E3B">
                <input type="text" id="amount" readonly="" style="border:0; color:#f6931f; font-weight:bold;"><button>Update</button>
            </p>
            <div id="slider-range"></div>
        </div>
    </div>
    <div class="rating">
        <h3>RATING</h3>
        <div>
            <form>
                <input type="checkbox" id="5-star" name="cc" checked="">
                <label for="5-star"><span></span><p>5 Stars <em>(32)</em></p></label>
                <input type="checkbox" id="4-star" name="cc" checked="">
                <label for="4-star"><span></span><p>4 Stars <em>(32)</em></p></label>
                <input type="checkbox" id="3-star" name="cc">
                <label for="3-star"><span></span><p>3 Stars <em>(32)</em></p></label>
                <input type="checkbox" id="2-star" name="cc">
                <label for="2-star"><span></span><p>2 Stars <em>(32)</em></p></label>
                <input type="checkbox" id="1-star" name="cc">
                <label for="1-star"><span></span><p>1 Stars <em>(32)</em></p></label>
            </form>
        </div>
    </div>
</aside>