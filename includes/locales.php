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
		"menu_position"	=>	1,
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