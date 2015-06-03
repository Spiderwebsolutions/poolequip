<?php

function one_half( $atts, $content = null ) {
    return '<div class="one-half">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('one_half', 'one_half');

function one_half_last( $atts, $content = null ) {
    return '<div class="one-half last">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('one_half_last', 'one_half_last');

function one_third( $atts, $content = null ) {
    return '<div class="one-third">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('one_third', 'one_third');

function one_third_last( $atts, $content = null ) {
    return '<div class="one-third last">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('one_third_last', 'one_third_last');

function one_fourth( $atts, $content = null ) {
    return '<div class="one-fourth">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('one_fourth', 'one_fourth');

function one_fourth_last( $atts, $content = null ) {
    return '<div class="one-fourth last">' . do_shortcode( $content ) . '</div>';
}

add_shortcode('one_fourth_last', 'one_fourth_last');

?>