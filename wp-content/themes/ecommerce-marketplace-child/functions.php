<?php

function ecommerce_marketplace_child_enqueue_styles() {

    wp_enqueue_style(
        'ecommerce-marketplace-parent',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'ecommerce-marketplace-child',
        get_stylesheet_directory_uri() . '/style.css',
        array('ecommerce-marketplace-parent'),
        wp_get_theme()->get('Version')
    );
}

add_action(
    'wp_enqueue_scripts',
    'ecommerce_marketplace_child_enqueue_styles'
);