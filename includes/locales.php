<?php
/**
* Creaión delCustom Post Type Stores
**/
function devialia_stores_cpt() {
	$labels = array(
		"name" => __( "Stores", "devialia-store-locator" ),
		"singular_name" => __( "Store", "devialia-store-locator" ),
		"menu_name" => __( "Stores", "devialia-store-locator" ),
		"all_items" => __( "All Stores", "devialia-store-locator" ),
		"add_new" => __( "Add New", "devialia-store-locator" ),
		"add_new_item" => __( "Add New Store", "devialia-store-locator" ),
		"edit_item" => __( "Edit Store", "devialia-store-locator" ),
		"new_item" => __( "New Store", "devialia-store-locator" ),
		"view_item" => __( "View Store", "devialia-store-locator" ),
		"view_items" => __( "View Stores", "devialia-store-locator" ),
		"search_items" => __( "Search Store", "devialia-store-locator" ),
		"not_found" => __( "No Stores Found", "devialia-store-locator" ),
		"not_found_in_trash" => __( "No Stores found in trash", "devialia-store-locator" ),
		"parent_item_colon" => __( "Parent Store:", "devialia-store-locator" ),
		"featured_image" => __( "Featured image for this store:", "devialia-store-locator" ),
		"set_featured_image" => __( "Set featured image for this store", "devialia-store-locator" ),
		"remove_featured_image" => __( "Remove featured image for this store", "devialia-store-locator" ),
		"parent_item_colon" => __( "Parent Store:", "devialia-store-locator" ),
	);

	$args = array(
		"label" => __( "Stores", "devialia-store-locator" ),
		"labels" => $labels,
		"description" => __( "This CPT is used to create the stores for the Devialia Store Locator plugin.", "devialia-store-locator" ),
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"menu_position"	=>	2,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "store" ),
		"query_var" => true,
		"menu_icon" => "https://icons.iconarchive.com/icons/designcontest/ecommerce-business/16/store-icon.png",
		"supports" => array( "title", "editor", "custom-fields" ),
	);

	register_post_type( "stores", $args );
}
add_action( 'init', 'devialia_stores_cpt' );

/**
* Creación de Custom Taxonomy Stores
**/
function devialia_stores_locations() {
	$labels = array(
		"name" => __( "Stores Locations", "devialia-store-locator" ),
		"singular_name" => __( "Store Location", "devialia-store-locator" ),
		"menu_name" => __( "Locations", "devialia-store-locator" ),
		"all_items" => __( "All Locations", "devialia-store-locator" ),
		"edit_item" => __( "Edit Location", "devialia-store-locator" ),
		"view_item" => __( "View Location", "devialia-store-locator" ),
		"update_item" => __( "Update Location Name", "devialia-store-locator" ),
		"add_new_item" => __( "Add New Location", "devialia-store-locator" ),
		"new_item_name" => __( "New Location Name", "devialia-store-locator" ),
		"parent_item" => __( "Parent Location", "devialia-store-locator" ),
	);

	$args = array(
		"label" => __( "Stores Locations", "devialia-store-locator" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Stores Locations",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'stores_locations', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "stores_locations", array( "stores" ), $args );
}
add_action( 'init', 'devialia_stores_locations' );

/**
* Creo la página de opciones del Store Locator
**/
if (function_exists('acf_add_options_page')) {
	acf_add_options_sub_page(array( // Parent page
		'page_title' => __( "Store Locator Configuration", "devialia-store-locator" ),
		'menu_title' => __( "Store Locator Configuration", "devialia-store-locator" ),
		'menu_slug'  => 'devialia-store-locator',
		'parent_slug'=> 'edit.php?post_type=stores',
		'position'   => '1',
		'post_id'    => 'devialia-store-locator',
		'icon_url'	 => plugin_dir_url( dirname(__FILE__) ) . 'img/icon-devialia.png',
	));
}