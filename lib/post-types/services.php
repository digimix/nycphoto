<?php
/*
DigiMix: Services
Version: 1.0
Author: DigiMix
Author URI: http://digimix.us/
License: GPLv2
*/

function create_services() {
    register_post_type( 'services',
        array(
            'labels' => array(
				'name'                => _x( 'Services', 'Post Type General Name', 'mix' ),
				'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'mix' ),
				'menu_name'           => __( 'Services', 'mix' ),
				'parent_item_colon'   => __( 'Parent Item:', 'mix' ),
				'all_items'           => __( 'All Services', 'mix' ),
				'view_item'           => __( 'View Service', 'mix' ),
				'add_new_item'        => __( 'Add New Service', 'mix' ),
				'add_new'             => __( 'Add New', 'mix' ),
				'edit_item'           => __( 'Edit Service', 'mix' ),
				'update_item'         => __( 'Update Service', 'mix' ),
				'search_items'        => __( 'Search Services', 'mix' ),
				'not_found'           => __( 'Not found', 'mix' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'mix' ),
            ),
            'label' => __( 'Services', 'mix' ),
            // 'description' => __( 'Services directory.', 'mix' ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'services' ),
            'capability_type' => 'post',
            'menu_position' => 9,
            'supports' => array('title', 'editor', 'thumbnail',  'excerpt',),
            'taxonomies' => array( '',),
            'menu_icon'=> 'dashicons-format-gallery',
            'has_archive' => false,
            'hierarchical' => true
        )
    );

        /* IMPORTIONT: Remember this line! */
    flush_rewrite_rules( false );/* Please read "Update 2" before adding this line */
}

add_action( 'init', 'create_services', 11 );
?>