<?php

function yuri_shop_setup() {

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary' => 'Menu Utama',
    ));
}

add_action('after_setup_theme', 'yuri_shop_setup');


function yuri_shop_assets() {

    wp_enqueue_style(
        'yuri-shop-style',
        get_stylesheet_uri()
    );
}

add_action('wp_enqueue_scripts', 'yuri_shop_assets');