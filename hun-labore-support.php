<?php
/**
 * Plugin Name: Hun Labore Support
 * Plugin URI: hunthemes.com
 * Description: Hun Labore Support supports creating new custom post type and meta box for Labore Theme
 * Version: 1.0
 * Author: HunThemes
 * Author URI: https://themeforest.net/user/hunthemes/portfolio
 * License: GPLv2 or later
 */
?>

<?php 

require_once dirname( __FILE__ ) . '/inc/meta-box/meta-box.php';


/**
 * Add Metabox For Post
 */
function post_meta_box( $meta_boxes ) {
	$prefix = 'hun-';

	$meta_boxes[] = array(
		'id' => 'hun_metabox_post',
		'title' => esc_html__( 'Gallery', 'labore' ),
		'post_types' => array('post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'labore_images_post',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Select or Upload Image', 'labore' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'post_meta_box' );


/**
 * Create Service Post Type
 */
function create_service_post_type() {
    $label = array(
        'name' 					=> _x('Services', 'Post Type General Name' , 'labore'),
        'singular_name' 		=> _x('Service', 'Post Type Singular Name' , 'labore'),
        'all_items' 			=> __('All Services', 'labore'),
        'add_new_item' 			=> __('Add New Service', 'labore'),
		'edit_item' 			=> __('Edit Service', 'labore'),
		'new_item' 				=> __('New Service', 'labore'),
		'view_item' 			=> __('View Service', 'labore'),
		'view_items' 			=> __('View Services', 'labore'),
		'search_items' 			=> __('Search Services', 'labore'),
		'not_found' 			=> __('No services found', 'labore'),
		'not_found_in_trash' 	=> __('No services found in Trash', 'labore'),
		'archives' 				=> __('Service Archives', 'labore'),
		'attributes' 			=> __('Service Attributes', 'labore'),
		'insert_into_item' 		=> __('Insert into service', 'labore'),
		'uploaded_to_this_item' => __('Uploaded to this service', 'labore'),
    );
 
    $args = array(
        'labels' 				=> $label,
        'description' 			=> 'Service Post Type',
        'show_in_rest' 			=> true,
        'supports' 				=> array(
						            'title',
						            'editor',
						            'excerpt',
						            'thumbnail',
						            'comments',
						            'revisions', 
						        ),
        'hierarchical' 			=> false, 
        'public' 				=> true, 
        'show_ui' 				=> true, 
        'show_in_menu' 			=> true, 
        'show_in_nav_menus' 	=> true,
        'show_in_admin_bar' 	=> true, 
        'menu_position' 		=> 5,
        'can_export' 			=> true, 
        'has_archive' 			=> true, 
        'exclude_from_search' 	=> false, 
        'publicly_queryable' 	=> true, 
        'rewrite' 				=> array('slug' => 'service'),
        'capability_type' 		=> 'post',
    );
 
    register_post_type('hun_labore_service', $args);
    flush_rewrite_rules();
}
add_action('init', 'create_service_post_type');

function service_meta_box( $meta_boxes ) {
	$prefix = 'hun-';

	$meta_boxes[] = array(
		'id' => 'hun_metabox_service',
		'title' => esc_html__( 'Meta Info', 'labore' ),
		'post_types' => array('hun_labore_service' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'labore_price_service',
				'type' => 'text',
				'name' => esc_html__( 'Service Price', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_duration_service',
				'type' => 'text',
				'name' => esc_html__( 'Service Duration', 'labore' ),
			),
			array(
				'id' => $prefix . 'divider_3',
				'type' => 'divider',
				'name' => esc_html__( 'Divider', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_staff_avatar',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Staff Avatar', 'labore' ),
				'max_file_uploads' => '1',
			),
			array(
				'id' => $prefix . 'labore_staff_name',
				'type' => 'text',
				'name' => esc_html__( 'Staff Name', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_staff_info',
				'type' => 'text',
				'name' => esc_html__( 'Staff Info', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_staff_link',
				'type' => 'text',
				'name' => esc_html__( 'Staff Link', 'labore' ),
				'placeholder' => esc_html__( 'http://', 'labore' ),
			),
			array(
				'id' => $prefix . 'divider_8',
				'type' => 'divider',
				'name' => esc_html__( 'Divider', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_link_book',
				'type' => 'text',
				'name' => esc_html__( 'Service Book Link', 'labore' ),
				'placeholder' => esc_html__( 'http://', 'labore' ),
			),
			array(
				'id' => $prefix . 'divider_11',
				'type' => 'divider',
				'name' => esc_html__( 'Divider', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_images_post',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Service Images', 'labore' ),
				'desc' => esc_html__( 'All images will be displayed at the beginning of service details as slider', 'labore' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'service_meta_box' );


/**
 * Create Event Post Type
 */
function create_event_post_type() {
    $label = array(
        'name' 					=> _x('Events', 'Post Type General Name' , 'labore' ),
        'singular_name' 		=> _x('Event', 'Post Type General Name' , 'labore' ),
        'all_items' 			=> __('All Events', 'labore' ),
        'add_new_item' 			=> __('Add New Event', 'labore' ),
		'edit_item' 			=> __('Edit Event', 'labore' ),
		'new_item' 				=> __('New Event', 'labore' ),
		'view_item' 			=> __('View Event', 'labore' ),
		'view_items' 			=> __('View Events', 'labore' ),
		'search_items' 			=> __('Search Events', 'labore' ),
		'not_found' 			=> __('No services found', 'labore' ),
		'not_found_in_trash' 	=> __('No services found in Trash', 'labore' ),
		'archives' 				=> __('Event Archives', 'labore' ),
		'attributes' 			=> __('Event Attributes', 'labore' ),
		'insert_into_item' 		=> __('Insert into event', 'labore' ),
		'uploaded_to_this_item'	=> __('Uploaded to this event', 'labore' ),
    );
 
    $args = array(
        'labels' 				=> $label,
        'description' 			=> 'Event Post Type',
        'show_in_rest' 			=> true,
        'supports' 				=> array(
						            'title',
						            'editor',
						            'excerpt',
						            'author',
						            'thumbnail',
						            'comments',
						            'trackbacks',
						            'revisions',
						        ),
        'hierarchical' 			=> false, 
        'public' 				=> true, 
        'show_ui' 				=> true, 
        'show_in_menu' 			=> true, 
        'show_in_nav_menus' 	=> true,
        'show_in_admin_bar' 	=> true, 
        'menu_position' 		=> 5,
        'can_export' 			=> true, 
        'has_archive' 			=> true, 
        'exclude_from_search' 	=> false, 
        'publicly_queryable' 	=> true, 
        'rewrite' 				=> array('slug' => 'event'),
        'capability_type' 		=> 'post' 
    );
 
    register_post_type('hun_labore_event', $args);
    flush_rewrite_rules();
}
add_action('init', 'create_event_post_type');

function event_meta_box( $meta_boxes ) {
	$prefix = 'hun-';

	$meta_boxes[] = array(
		'id' => 'hun_metabox_event',
		'title' => esc_html__( 'Meta Info', 'labore' ),
		'post_types' => array('hun_labore_event' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'labore_date_time_event',
				'type' => 'datetime',
				'name' => esc_html__( 'Date & Time', 'labore' ),
				'js_options' => array(
					'dateFormat'      => 'dd-mm-yy',
				),
			),
			array(
				'id' => $prefix . 'labore_location_event',
				'type' => 'text',
				'name' => esc_html__( 'Location', 'labore' ),
			),
			array(
				'id' => $prefix . 'labore_images_post',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Select or Upload Image', 'labore' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'event_meta_box' );