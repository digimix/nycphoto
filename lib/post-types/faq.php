<?php
/*
Plugin Name: DigiMix: FAQs
Plugin URI: http://digimix.us/
Description: Declares a plugin that will create a custom post type displaying Portfolio pieces.
Version: 1.0
Author: DigiMix
Author URI: http://digimix.us/
License: GPLv2
*/


function create_faqs() {
    register_post_type( 'faqs',
        array(
            'labels' => array(
                'name' => 'FAQs',
                'singular_name' => 'FAQ',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New FAQ',
                'edit' => 'Edit',
                'edit_item' => 'Edit FAQ',
                'new_item' => 'New FAQ',
                'view' => 'View',
                'view_item' => 'View FAQ',
                'search_items' => 'Search FAQs',
                'not_found' => 'No FAQs found',
                'not_found_in_trash' => 'No FAQs found in Trash',
                'parent_item_colon' => '',
                'menu_name' => 'FAQs'
            ),

            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'faq' ),
            'capability_type' => 'post',
            'menu_position' => 5,
            'supports' => array( 'title', 'editor',  'excerpt'),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-info',
            'has_archive' => true,
            'hierarchical' => false
        )
    );

        /* IMPORTIONT: Remember this line! */
    flush_rewrite_rules( false );/* Please read "Update 2" before adding this line */
}

add_action( 'init', 'create_faqs' );
?>