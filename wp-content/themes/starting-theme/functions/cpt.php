<?php

// Register Stockists Custom Post Type
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
				'show_in_rest'          		 => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array('pages' => true)
    );
    register_taxonomy( 'stockists_country', array( 'stockists' ), $stockists_area_args );
}


// Register Range Custom Post Type
function ranges_post_type()
{
	$labels = array(
		'name'                  => _x('Ranges', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('Range', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('Ranges', 'text_domain'),
		'name_admin_bar'        => __('Range', 'text_domain'),
		'archives'              => __('Item Archives', 'text_domain'),
		'attributes'            => __('Item Attributes', 'text_domain'),
		'parent_item_colon'     => __('Parent Item:', 'text_domain'),
		'all_items'             => __('All Items', 'text_domain'),
		'add_new_item'          => __('Add New Item', 'text_domain'),
		'add_new'               => __('Add New', 'text_domain'),
		'new_item'              => __('New Item', 'text_domain'),
		'edit_item'             => __('Edit Item', 'text_domain'),
		'update_item'           => __('Update Item', 'text_domain'),
		'view_item'             => __('View Item', 'text_domain'),
		'view_items'            => __('View Items', 'text_domain'),
		'search_items'          => __('Search Item', 'text_domain'),
		'not_found'             => __('Not found', 'text_domain'),
		'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
		'featured_image'        => __('Featured Image', 'text_domain'),
		'set_featured_image'    => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image'    => __('Use as featured image', 'text_domain'),
		'insert_into_item'      => __('Insert into item', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
		'items_list'            => __('Items list', 'text_domain'),
		'items_list_navigation' => __('Items list navigation', 'text_domain'),
		'filter_items_list'     => __('Filter items list', 'text_domain'),
	);
	$args = array(
		'label'                 => __('range', 'text_domain'),
		'description'           => __('range information page.', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'featured', 'page-attributes'),
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
	register_post_type('ranges', $args);
}
add_action('init', 'ranges_post_type', 0);
add_action('init', 'ranges_taxonomies', 0);


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
		'show_in_rest'          	 => true,
		'query_var' 				 => true,
		'rewrite'                    => array('pages' => true)
		// 'rewrite' 					 => array('slug' => 'range', 'with_front' => true, 'hierarchical' => false),
	);
	register_taxonomy('ranges_type', array('ranges'), $ranges_type_args);

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
		'show_in_rest'          	=> true,
		// 'rewrite'                    => array('pages' => true)
		'rewrite' 					 => array('slug' => 'style', 'with_front' => true, 'hierarchical' => false),

	);
	register_taxonomy('ranges_style', array('ranges'), $ranges_style_args);

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
		'show_in_rest'          	 => true,
		'rewrite'                    => array('pages' => true)
	);
	register_taxonomy('ranges_colour', array('ranges'), $ranges_colour_args);
}



function color_query_vars($qvars)
{
	$qvars[] = 'colour';
	return $qvars;
}
add_filter('query_vars', 'color_query_vars');

function style_query_vars($qvars)
{
	$qvars[] = 'style';
	return $qvars;
}

add_filter('query_vars', 'style_query_vars');

function range_query_vars($qvars)
{
	$qvars[] = 'range';
	return $qvars;
}

add_filter('query_vars', 'range_query_vars');

function filterByDropdown($query)
{
	if ($color = get_query_var('colour')) {
		$color_query = array(
			'taxonomy' => 'ranges_colour',
			'field' => 'slug',
			'terms' => $color,
		);
	} else {
		$color_query = null;
	}
	if ($style = get_query_var('style')) {

		$style_query = array(
			'taxonomy' => 'ranges_style',
			'field' => 'slug',
			'terms' => $style,
		);
	} else {
		$style_query = null;
	}
	if ($range = get_query_var('range')) {

		$range_query = array(
			'taxonomy' => 'ranges_type',
			'field' => 'slug',
			'terms' => $range,
		);
	} else {
		$range_query = null;
	}
	$taxquery[] = array(
		'relation' => 'AND',
		$color_query
	);
	if (($query->is_main_query()) && (is_tax())) :
		$query->tax_query->queries[] = $taxquery;
		$query->query_vars['tax_query'] = $query->tax_query->queries;
	// $query->set('tax_query', $taxquery);
	endif;
}
add_action('pre_get_posts', 'filterByDropdown');

// Register Gallery Custom Post Type
function gallery_post_type() {
	$labels = array(
		'name'                  => _x( 'Gallery', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Gallery', 'text_domain' ),
		'name_admin_bar'        => __( 'Gallery', 'text_domain' ),
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
		'label'                 => __( 'Gallery', 'text_domain' ),
		'description'           => __( 'Gallery information page.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'tags', 'revisions', 'featured', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'taxonomies' 						=> array('post_tag'),
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-camera',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
    'show_in_rest'          => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'gallery', $args );
}
add_action( 'init', 'gallery_post_type', 0 );
add_action( 'init', 'gallery_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function gallery_taxonomies()
{
	// partners taxonomy
    $gallery_range_labels = array(
        'name'          => 'Image Range',
        'singular_name' => 'Image Range',
        'menu_name'     => 'Image Range'
    );
    $gallery_range_args = array(
        'labels'                     => $gallery_range_labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'show_in_rest'          		 => true,
				'rewrite'                    => array('pages' => true)
    );
    register_taxonomy( 'gallery_range', array( 'gallery' ), $gallery_range_args );

		// range colour taxonomy
      // $gallery_tags_labels = array(
			// 	'name' 												=> _x( 'Gallery Tags', 'taxonomy general name' ),
			// 	'singular_name' 							=> _x( 'Gallery Tag', 'taxonomy singular name' ),
			// 	'search_items' 								=>  __( 'Search Tags' ),
			// 	'popular_items' 							=> __( 'Popular Tags' ),
			// 	'all_items' 									=> __( 'All Tags' ),
			// 	'parent_item' 								=> null,
			// 	'parent_item_colon' 					=> null,
			// 	'edit_item' 									=> __( 'Edit Tag' ),
			// 	'update_item' 								=> __( 'Update Tag' ),
			// 	'add_new_item' 								=> __( 'Add New Tag' ),
			// 	'new_item_name' 							=> __( 'New Tag Name' ),
			// 	'separate_items_with_commas' 	=> __( 'Separate tags with commas' ),
			// 	'add_or_remove_items' 				=> __( 'Add or remove tags' ),
			// 	'choose_from_most_used' 			=> __( 'Choose from the most used tags' ),
			// 	'menu_name' 									=> __( 'Gallery Tags' ),
      // );
      // $gallery_tags_args = array(
      //     'labels'                     => $gallery_tags_labels,
      //     'hierarchical'               => true,
      //     'public'                     => true,
      //     'show_ui'                    => true,
      //     'show_admin_column'          => true,
      //     'show_in_nav_menus'          => true,
      //     'show_tagcloud'              => true,
			// 		'show_in_rest'          		 => true,
      //     'rewrite' 									 => array( 'slug' => 'gallery_tag' ),
      // );
      // register_taxonomy( 'gallery_tag', array( 'gallery' ), $gallery_tags_args );

}

// Register Ulster At Home Custom Post Type
function ulsterathome_post_type() {
	$labels = array(
		'name'                  => _x( '#ulsterathome', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( '#ulsterathome', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( '#ulsterathome', 'text_domain' ),
		'name_admin_bar'        => __( '#ulsterathome', 'text_domain' ),
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
		'label'                 => __( '#ulsterathome', 'text_domain' ),
		'description'           => __( 'Gallery information page.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'tags', 'revisions', 'featured', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'taxonomies' 						=> array('post_tag'),
		'menu_icon'             => 'dashicons-camera',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
    'show_in_rest'          => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'ulsterathome', $args );
}
add_action( 'init', 'ulsterathome_post_type', 0 );
add_action( 'init', 'ulsterathome_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function ulsterathome_taxonomies()
{
	// partners taxonomy
    $ulsterathome_range_labels = array(
        'name'          => 'Image Range',
        'singular_name' => 'Image Range',
        'menu_name'     => 'Image Range'
    );
    $ulsterathome_range_args = array(
        'labels'                     => $ulsterathome_range_labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'show_in_rest'          		 => true,
				'rewrite'                    => array('pages' => true)
    );
    register_taxonomy( 'ulsterathome_range', array( 'ulsterathome' ), $ulsterathome_range_args );

		// range colour taxonomy
      // $ulsterathome_tags_labels = array(
			// 	'name' 												=> _x( 'Tags', 'taxonomy general name' ),
			// 	'singular_name' 							=> _x( 'Tag', 'taxonomy singular name' ),
			// 	'search_items' 								=>  __( 'Search Tags' ),
			// 	'popular_items' 							=> __( 'Popular Tags' ),
			// 	'all_items' 									=> __( 'All Tags' ),
			// 	'parent_item' 								=> null,
			// 	'parent_item_colon' 					=> null,
			// 	'edit_item' 									=> __( 'Edit Tag' ),
			// 	'update_item' 								=> __( 'Update Tag' ),
			// 	'add_new_item' 								=> __( 'Add New Tag' ),
			// 	'new_item_name' 							=> __( 'New Tag Name' ),
			// 	'separate_items_with_commas' 	=> __( 'Separate tags with commas' ),
			// 	'add_or_remove_items' 				=> __( 'Add or remove tags' ),
			// 	'choose_from_most_used' 			=> __( 'Choose from the most used tags' ),
			// 	'menu_name' 									=> __( 'Tags' ),
      // );
      // $ulsterathome_tags_args = array(
      //     'labels'                     => $ulsterathome_tags_labels,
      //     'hierarchical'               => true,
      //     'public'                     => true,
      //     'show_ui'                    => true,
      //     'show_admin_column'          => true,
      //     'show_in_nav_menus'          => true,
      //     'show_tagcloud'              => true,
			// 		'show_in_rest'          		 => true,
      //     'rewrite' 									 => array( 'slug' => 'tag' ),
      // );
      // register_taxonomy( 'ulsterathome_tag', array( 'ulsterathome' ), $ulsterathome_tags_args );

}
