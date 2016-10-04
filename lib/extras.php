<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

require_once locate_template('/lib/post-types/portfolio.php');
require_once locate_template('/lib/post-types/team.php');
require_once locate_template('/lib/post-types/faq.php');
require_once locate_template('/lib/post-types/services.php');
require_once locate_template('/lib/metabox.php');


add_image_size('slider-thumb', 9999, 349); // 300px wide (and unlimited height)

/*

function fix_nav_parent($menu){
	global $post;
	if ( 'portfolio' == get_post_type() ) {
		$menu = str_replace( 'current_page_parent', '', $menu ); // remove all current_page_parent classes
		$menu = str_replace( 'menu-item-XXX', 'current_page_parent menu-item-XXX', $menu ); // add the current_page_parent class to the page you want
	}
	if ( 'faqs' == get_post_type() ) {
		$menu = str_replace( 'current_page_parent', '', $menu ); // remove all current_page_parent classes
		$menu = str_replace( 'menu-item-XXX', 'current_page_parent menu-item-XXX', $menu ); // add the current_page_parent class to the page you want
	}

	return $menu;
}
add_filter( 'nav_menu_css_class',  __NAMESPACE__ . '\\fix_nav_parent', 0 );
*/



function gpp_jpeg_quality_callback($arg) {
	return (int)100;
}
add_filter('jpeg_quality', __NAMESPACE__ . '\\gpp_jpeg_quality_callback');


/**
 * Sample template tag function for outputting a cmb2 file_list
 *
 * @param  string  $file_list_meta_key The field meta key. ($prefix . 'file_list')
 * @param  string  $img_size           Size of image to show
 */
function cmb2_output_file_list($file_list_meta_key, $img_size = 'large' ) {

    // Get the list of files
    $files = get_post_meta( get_the_ID(), $file_list_meta_key, true );

    echo '<ul class="file-list-wrap popup-gallery">';
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
	    $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
	    $featimg = htmlspecialchars(cv_resize($attachment_id, 250, 250, true));
        echo '<li><figure class="file-list-image">';
        echo '<a class="" title="'. $alt .'" href="'.wp_get_attachment_url( $attachment_id ).'">';
        echo '<img src="'. $featimg .'">';
        //echo wp_get_attachment_image( $attachment_id, $img_size );
        echo '<figcaption>'.get_the_title($attachment_id).' <label class="hidden">NYC '. get_the_title() .'</label></figcaption>';
        echo '</a>';
        //echo $attachment_id->post_parent;
        echo '</figure></li>';
    }
    echo '</ul>';
}


function cmb2_output_file_id_list($postid, $file_list_meta_key, $img_size = 'large' ) {

    // Get the list of files
    $files = get_post_meta( $postid, $file_list_meta_key, true );

    // Loop through them and output an image
    $attachment_list = array();
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
		$prefix = ', ';
		//$attachment_list[] = $attachment_id . $prefix;
		$attachment_list[] = $attachment_id;
        //$attachment_list .= $prefix . '' . $attachment_id . '';
        //$attachment_list = trim($attachment_list,",");
        //echo $attachment_id->post_parent;
    }
    // return trim( implode('', $attachment_list ) ,",");
    return implode(', ', $attachment_list );
}



function my_custom_fonts() {
  echo '<style>
    #adminmenu div.wp-menu-image.dashicons-id-alt:before, #adminmenu div.wp-menu-image.dashicons-format-gallery:before, #adminmenu div.wp-menu-image.dashicons-info:before {
      color:#DC5924;
    }
  </style>';
}
add_action('admin_head', __NAMESPACE__ . '\\my_custom_fonts');


/*
function wptp_add_categories_to_attachments() {
    register_taxonomy_for_object_type( 'category', 'attachment' );
}
add_action( 'init' , __NAMESPACE__ . '\\wptp_add_categories_to_attachments' );
*/


function my_custom_init() {
	add_post_type_support( 'attachment', 'services' );
}
add_action('init', __NAMESPACE__ . '\\my_custom_init');


/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


// Changing the number of posts per page, by post type
function digimix_home_pagesize( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_home() ) {
        // Display only 1 post for the original blog archive
        return;
    }

    if ( is_search() ) {
        // Display only 1 post for the original blog archive
        $query->set( 'posts_per_page', 21 );
        return;
    }

    if ( is_post_type_archive( 'portfolio' ) || is_category() || is_author() ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', -1 );
        $query->set( 'post_type', array('attachment','portfolio') );
        return;
    }

    if ( $query->is_tax( 'services' ) && $query->is_main_query() ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', -1 );
        $query->set( 'post_type', array('attachment','portfolio') );
        $query->set( 'post_status', array('null',) );


        return;
    }

}
add_action( 'pre_get_posts',  __NAMESPACE__ . '\\digimix_home_pagesize' );


/**
 * Returns the URL to an image resized and cropped to the given dimensions.
 *
 * You can use this image URL directly -- it's cached and such by our servers.
 * Please use this function to generate the URL rather than doing it yourself as
 * this function uses staticize_subdomain() makes it serve off our CDN network.
 *
 * Somewhat contrary to the function's name, it can be used for ANY image URL, hosted by us or not.
 * So even though it says "remote", you can use it for attachments hosted by us, etc.
 *
 * @link http://vip.wordpress.com/documentation/image-resizing-and-cropping/ Image Resizing And Cropping
 * @param string $url The raw URL to the image (URLs that redirect are currently not supported with the exception of http://foobar.wordpress.com/files/ type URLs)
 * @param int $width The desired width of the final image
 * @param int $height The desired height of the final image
 * @param bool $escape Optional. If true (the default), the URL will be run through esc_url(). Set this to false if you need the raw URL.
 * @return string
 */
function wpcom_vip_get_resized_remote_image_url( $url, $width, $height, $escape = true ) {
	$width = (int) $width;
	$height = (int) $height;
	// Photon doesn't support redirects, so help it out by doing http://foobar.wordpress.com/files/ to http://foobar.files.wordpress.com/
	if ( function_exists( 'new_file_urls' ) )
		$url = new_file_urls( $url );
		$thumburl = jetpack_photon_url( $url, array( 'resize' => array( $width, $height ) ) );
	return ( $escape ) ? esc_url( $thumburl ) : $thumburl;
}


/**
 * Returns a URL for a given attachment with the appropriate resizing querystring.
 *
 * Typically, you should be using image sizes for handling this.
 *
 * However, this function can come in handy if you want a specific artibitrary or varying image size.
 *
 * @link http://vip.wordpress.com/documentation/image-resizing-and-cropping/
 *
 * @param int $attachment_id ID of the attachment
 * @param int $width Width of our resized image
 * @param int $height Height of our resized image
 * @param bool $crop (optional) whether or not to crop the image
 * @return string URL of the resized attachmen
 */
function wpcom_vip_get_resized_attachment_url( $attachment_id, $width, $height, $crop = true ) {
	$url = wp_get_attachment_url( $attachment_id );

	if ( ! $url ) {
		return false;
	}

	$url = add_query_arg( array(
		'w' => intval( $width ),
		'h' => intval( $height ),
	), $url );

	if ( $crop ) {
		$url = htmlspecialchars(add_query_arg( 'crop', 1, $url ));
	}

	return $url;
}


/**
 * Retrieves the attachment ID from the file URL
 */

function pippin_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
	if ($attachment) {
		return $attachment[0];
	}
}


/**
 * Add SVG to media uploads
 */

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', __NAMESPACE__ . '\\cc_mime_types');




/**
 * Remove “Category:”, “Tag:”, “Author:” from the_archive_title
 */

function get_the_archive_title($title) {
    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;
}
add_filter('get_the_archive_title', __NAMESPACE__ . '\\get_the_archive_title');





/**
 * On the fly image cropping based on WP 3.5 image editor
 *
 * @since 1.0
 *
 * @param    int     $id
 * @param    int     $width
 * @param    int     $height
 * @param    boolean $crop
 * @return   string
 */
function cv_resize( $id = 0, $width = 50, $height = 50, $crop = true ){

  // Check if attachment is an image
  if ( !$id || !wp_attachment_is_image($id) )
    return false;

  $upload_dir = wp_upload_dir();
  $img_meta = wp_get_attachment_metadata( $id );

  if( empty($img_meta) )
    return false;

  // attachment url converted to image path
  $file = $upload_dir['basedir'] . '/' . $img_meta['file'];

  $image = wp_get_image_editor( $file );

  // legacy error explanation.
  if ( is_wp_error( $image ) )
    return false;

  // generate intended file name and check if the image exists.
  $new_file_path = $image->generate_filename($suffix = $width.'x'.$height);

  // If this file already exists, return the image url.
  if(file_exists($new_file_path))
    return str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $new_file_path);

  // resize image and save
  $image->resize( $width, $height, $crop );
  $new_image_info = $image->save();

  // legacy error explanation.
  if ( is_wp_error( $new_image_info ) )
    return false;

  // convert path to url
  $url = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $new_image_info['path']);

  return $url;
}

function cv_resize_cached( $id = 0, $width = 50, $height = 50, $crop = true, $timeout = HOUR_IN_SECONDS ){
  $transient = 'cv_gallery_'.$id.'_'.$width.'_'.$height.'_'.$crop;

  if ( false === ( $result = get_transient( $transient ) ) ) {
    $result = cv_resize( $id, $width, $height, $crop );
    if( !empty( $result ) )
      set_transient( $transient, $result, $timeout );
  }
  return $result;
}

function cv_resize_thumbnail( $id = 0, $width = 50, $height = 50, $crop = true, $attr = '' ){

    $src = cv_resize_cached( $id, $width, $height, $crop );
    $hwstring = image_hwstring($width, $height);
    $size = $width . 'x' . $height;
    $attachment = get_post($id);

    $default_attr = array(
      'src' => $src,
      'class' => "attachment-$size",
      'alt' => trim(strip_tags( get_post_meta($id, '_wp_attachment_image_alt', true) )), // Use Alt field first
    );

    if ( empty($default_attr['alt']) )
      $default_attr['alt'] = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
    if ( empty($default_attr['alt']) )
      $default_attr['alt'] = trim(strip_tags( $attachment->post_title )); // Finally, use the title


    $attr = wp_parse_args($attr, $default_attr);
    $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment );
    $attr = array_map( 'esc_attr', $attr );
    $html = rtrim("<img $hwstring");
    foreach ( $attr as $name => $value ) {
      $html .= " $name=" . '"' . $value . '"';
    }
    $html .= ' />';

  return $html;
}

function cv_resize_gallery( $ids = array(), $width = 50, $height = 50, $crop = true, $timeout = DAY_IN_SECONDS ){
  $list = implode('_', $ids);
  $transient = 'cv_gallery_'.$list.'_'.$width.'_'.$height.'_'.$crop;

  if ( false === ( $result = get_transient( $transient ) ) ) {
    $result = array();
    foreach ($ids as $id) {
      $result[] = cv_resize( $id, $width, $height, $crop );
    }

    set_transient( $transient, $result, $timeout );

  }
  return $result;
}

function cv_resize_sizes( $id = 0, $sizes = array(), $crop = true, $timeout = DAY_IN_SECONDS ){

  $dimensions = array_map(function($item) { return $item['width'].'x'.$item['height']; }, $sizes);

  $output = implode('_', $dimensions);

  $transient = 'cv_sizes_'.$id.'_'.md5($output).'_'.$crop;



  if ( false === ( $result = get_transient( $transient ) ) ) {
    $result = array();
    foreach ($sizes as $size) {
      $width = $size['width'];
      $height = $size['height'];
      $result[] = cv_resize( $id, $width, $height, $crop );
    }

    set_transient( $transient, $result, $timeout );

  }
  return $result;
}

function tt_get_resized_attachment_url( $id = 0, $width = 50, $height = 50, $crop = true ) {
  return ( defined('WPCOM_IS_VIP_ENV') && true === WPCOM_IS_VIP_ENV ) ? wpcom_vip_get_resized_attachment_url( $id, $width, $height, $crop ) : cv_resize_cached( $id, $width, $height, $crop );
}