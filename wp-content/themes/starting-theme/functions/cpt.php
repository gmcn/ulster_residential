<?php

// Register Partners Custom Post Type
function stockists_post_type() {
	$labels = array(
		'name'                  => _x( 'Stockists', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Stockist', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Stockists', 'text_domain' ),
		'name_admin_bar'        => __( 'Stockist', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Stockist', 'text_domain' ),
		'description'           => __( 'Stockist information page.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'featured', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-site',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
    'show_in_rest'          => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'stockists', $args );
}
add_action( 'init', 'stockists_post_type', 0 );
add_action( 'init', 'stockists_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function stockists_taxonomies()
{
	// partners taxonomy
    $stockists_area_labels = array(
        'name'          => 'Stockist Country',
        'singular_name' => 'Stockist Country',
        'menu_name'     => 'Stockist Country'
    );
    $stockists_area_args = array(
        'labels'                     => $stockists_area_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array('pages' => true)
    );
    register_taxonomy( 'stockists_country', array( 'stockists' ), $stockists_area_args );
}


// Register Range Custom Post Type
function ranges_post_type() {
	$labels = array(
		'name'                  => _x( 'Ranges', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Range', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Ranges', 'text_domain' ),
		'name_admin_bar'        => __( 'Range', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'range', 'text_domain' ),
		'description'           => __( 'range information page.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'featured', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-site',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
    'show_in_rest'          => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'ranges', $args );
}
add_action( 'init', 'ranges_post_type', 0 );
add_action( 'init', 'ranges_taxonomies', 0 );


//create two taxonomies, genres and tags for the post type "tag"
function ranges_taxonomies()
{
	// range type taxonomy
    $ranges_type_labels = array(
        'name'          => 'Range Type',
        'singular_name' => 'Range Type',
        'menu_name'     => 'Range Type'
    );
    $ranges_type_args = array(
        'labels'                     => $ranges_type_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
				'show_in_rest'          		 => true,
        'rewrite'                    => array('pages' => true)
    );
    register_taxonomy( 'ranges_type', array( 'ranges' ), $ranges_type_args );

  // range style taxonomy
    $ranges_style_labels = array(
        'name'          => 'Range Style',
        'singular_name' => 'Range Style',
        'menu_name'     => 'Range Style'
    );
    $ranges_style_args = array(
        'labels'                     => $ranges_style_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
				'show_in_rest'          		 => true,
        'rewrite'                    => array('pages' => true)
    );
    register_taxonomy( 'ranges_style', array( 'ranges' ), $ranges_style_args );

    // range colour taxonomy
      $ranges_colour_labels = array(
          'name'          => 'Range Colour',
          'singular_name' => 'Range Colour',
          'menu_name'     => 'Range Colour'
      );
      $ranges_colour_args = array(
          'labels'                     => $ranges_colour_labels,
          'hierarchical'               => true,
          'public'                     => true,
          'show_ui'                    => true,
          'show_admin_column'          => true,
          'show_in_nav_menus'          => true,
          'show_tagcloud'              => true,
					'show_in_rest'          		 => true,
          'rewrite'                    => array('pages' => true)
      );
      register_taxonomy( 'ranges_colour', array( 'ranges' ), $ranges_colour_args );
}
