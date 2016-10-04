<?php
/*
Plugin Name: DigiMix: Portfolio
Plugin URI: http://digimix.us/
Description: Declares a plugin that will create a custom post type displaying Portfolio pieces.
Version: 1.0
Author: DigiMix
Author URI: http://digimix.us/
License: GPLv2
*/


function create_portfolio() {
    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name' => 'Portfolio',
                'singular_name' => 'Portfolio',
                'add_new' => 'Add New Photo',
                'add_new_item' => 'Add New Portfolio',
                'edit' => 'Edit',
                'edit_item' => 'Edit Portfolio',
                'new_item' => 'New Portfolio',
                'view' => 'View',
                'view_item' => 'View Portfolio',
                'search_items' => 'Search Photos',
                'not_found' => 'No Photos found',
                'not_found_in_trash' => 'No Photos found in Trash',
                'parent_item_colon' => '',
                'menu_name' => 'Portfolio'
            ),

            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio' ),
            'capability_type' => 'post',
            'menu_position' => 5,
            'supports' => array( 'title', 'thumbnail', 'custom-fields',  'excerpt', 'page-attributes'),
            'taxonomies' => array( '' ),
            'menu_icon' => get_stylesheet_directory_uri() . '/lib/post-types/images/portfolio.png',
            'has_archive' => true,
            'hierarchical' => false
        )
    );

        /* IMPORTIONT: Remember this line! */
    flush_rewrite_rules( false );/* Please read "Update 2" before adding this line */
}

add_action( 'init', 'create_portfolio' );
?>