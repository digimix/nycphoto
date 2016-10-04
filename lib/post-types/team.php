<?php
/*
Plugin Name: DigiMix: Team
Plugin URI: http://digimix.us/
Description: Declares a plugin that will create a custom post type displaying Portfolio pieces.
Version: 1.0
Author: DigiMix
Author URI: http://digimix.us/
License: GPLv2
*/


function create_team() {
    register_post_type( 'team',
        array(
            'labels' => array(
                'name' => 'Photographers',
                'singular_name' => 'Photographer',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Photographer',
                'edit' => 'Edit',
                'edit_item' => 'Edit Photographer',
                'new_item' => 'New Photographer',
                'view' => 'View',
                'view_item' => 'View Photographers',
                'search_items' => 'Search Photographers',
                'not_found' => 'No Photographers found',
                'not_found_in_trash' => 'No Photographers found in Trash',
                'parent_item_colon' => '',
                'menu_name' => 'Photographers'
            ),

            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'photographers' ),
            'capability_type' => 'post',
            'menu_position' => 5,
            'supports' => array( 'title', 'editor', 'thumbnail'),
            'taxonomies' => array( '' ),
            'menu_icon'=> 'dashicons-id-alt',
            'has_archive' => false,
            'hierarchical' => false
        )
    );

        /* IMPORTIONT: Remember this line! */
    flush_rewrite_rules( false );/* Please read "Update 2" before adding this line */
}

add_action( 'init', 'create_team' );
?>