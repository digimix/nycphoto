<?php
/*
Plugin Name: DigiMix: Reviews
Plugin URI: http://digimix.us/
Description: Declares a plugin that will create a custom post type displaying customer reviews.
Version: 1.0
Author: DigiMix
Author URI: http://digimix.us/
License: GPLv2
*/


function create_reviews() {
    register_post_type( 'reviews',
        array(
            'labels' => array(
                'name' => 'Reviews',
                'singular_name' => 'Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Review',
                'edit' => 'Edit',
                'edit_item' => 'Edit Review',
                'new_item' => 'New Review',
                'view' => 'View',
                'view_item' => 'View Review',
                'search_items' => 'Search Reviews',
                'not_found' => 'No Reviews found',
                'not_found_in_trash' => 'No Reviews found in Trash',
                'parent_item_colon' => '',
                'menu_name' => 'Reviews'
            ),

            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'customer-reviews' ),
            'capability_type' => 'post',
            'menu_position' => 5,
            'supports' => array( 'title', 'editor',  'excerpt', 'thumbnail'),
            'taxonomies' => array( '' ),
            'menu_icon' => get_stylesheet_directory_uri() . '/lib/post-types/images/reviews.png',
            'has_archive' => true,
            'hierarchical' => false
        )
    );

        /* IMPORTIONT: Remember this line! */
    flush_rewrite_rules( false );/* Please read "Update 2" before adding this line */
}

add_action( 'init', 'create_reviews' );
?>