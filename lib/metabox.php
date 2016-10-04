<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * Be sure to replace all instances of 'mix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function mix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function mix_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => 10,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}


/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function mix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}



add_action( 'cmb2_init', 'mix_register_team_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function mix_register_team_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mix_team_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_team = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Contact Info', 'cmb2' ),
		'object_types' => array( 'team', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb_team->add_field( array(
	    'name' => 'Email',
	    'id'   => $prefix . 'email',
	    'type' => 'text_email',
	) );

}





add_action( 'cmb2_init', 'mix_register_x_service_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function mix_register_x_service_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mix_x_service_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_x_service = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Connected Service', 'cmb2' ),
		'object_types' => array( 'post', ), // Post type
		'context'      => 'side', //  'normal', 'advanced', or 'side'
		'priority'     => 'high', //  'high', 'core', 'default' or 'low'
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb_x_service->add_field( array(
	    'name'             => 'Service',
	    'desc'             => 'Select an option',
	    'id'               => $prefix . 'service',
	    'type'             => 'select',
	    'show_option_none' => true,
	    //'default'          => 'custom',
	    'options' => mix_get_post_options( array( 'post_type' => 'services', 'numberposts' => -1 ) ),
	) );

}




add_action( 'cmb2_init', 'mix_register_gallery_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function mix_register_gallery_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mix_gallery_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_gallery = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Gallery Images', 'cmb2' ),
		'object_types' => array( 'services', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb_gallery->add_field( array(
		'name'         => __( 'Multiple Files', 'cmb2' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'           => $prefix . 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100, true ), // Default: array( 50, 50 )
	) );

}


add_action( 'cmb2_init', 'mix_register_frontpage_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function mix_register_frontpage_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mix_front_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_front = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Frontpage Metabox', 'cmb2' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'show_on'      => array( 'id' => array( 4, ) ), // Specific post IDs to display this metabox
	) );
	$cmb_front->add_field( array(
		'name'         => __( 'Multiple Files', 'cmb2' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'           => $prefix . 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100, true ), // Default: array( 50, 50 )
	) );

/*
	$cmb_front->add_field( array(
		'name'         => __( 'Multiple Files', 'cmb2' ),
		'desc'         => __( 'Upload or add multiple images/attachments.', 'cmb2' ),
		'id'           => $prefix . 'file_list',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );
*/

}


add_action( 'cmb2_init', 'mix_register_slider_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function mix_register_slider_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mix_slider_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_slider = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Slider', 'cmb2' ),
		'object_types' => array( 'page', ),
		'show_on'      => array( 'id' => array( 4, ) ), // Specific post IDs to display this metabox
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$slider_field_id = $cmb_slider->add_field( array(
		'id'          => $prefix . 'item',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Slide {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Slide', 'cmb2' ),
			'remove_button' => __( 'Remove Slide', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_slider->add_group_field( $slider_field_id, array(
		'name'       => __( 'Entry Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_slider->add_group_field( $slider_field_id, array(
		'name'        => __( 'Description', 'cmb2' ),
		'description' => __( 'Write a short description for this entry', 'cmb2' ),
		'id'          => 'description',
		'type'        => 'textarea_small',
	) );

	$cmb_slider->add_group_field( $slider_field_id, array(
		'name' => __( 'Entry Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$cmb_slider->add_group_field( $slider_field_id, array(
		'name' => __( 'Link', 'cmb2' ),
		'id'   => 'url',
		'type' => 'text_url',
	) );

}



add_action( 'cmb2_init', 'mix_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function mix_register_user_profile_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mix_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'cmb2' ),
		'object_types'     => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => __( 'Extra Info', 'cmb2' ),
		'desc'     => __( 'field description (optional)', 'cmb2' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => __( 'Avatar', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => $prefix . 'avatar',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Facebook URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'facebookurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Twitter URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Google+ URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'Linkedin URL', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
	) );

	$cmb_user->add_field( array(
		'name' => __( 'User Field', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'user_text_field',
		'type' => 'text',
	) );

}

add_action( 'cmb2_init', 'mix_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page
 */
function mix_register_theme_options_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$option_key = '_mix_theme_options';

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb2_metabox_form` helper function. See wiki for more info.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'      => $option_key . 'page',
		'title'   => __( 'Theme Options Metabox', 'cmb2' ),
		'hookup'  => false, // Do not need the normal user/post hookup
		'show_on' => array(
			// These are important, don't remove
			'key'   => 'options-page',
			'value' => array( $option_key )
		),
	) );

	/**
	 * Options fields ids only need
	 * to be unique within this option group.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field( array(
		'name'    => __( 'Site Background Color', 'cmb2' ),
		'desc'    => __( 'field description (optional)', 'cmb2' ),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	) );

}