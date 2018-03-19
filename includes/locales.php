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


/**
* Creo los campos de la página de opciones del Store Locator
*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_devialia_sl_controls',
	'title' => 'Configuración del mapa',
	'fields' => array (
		array (
			'key' => 'group_devialia_sl_controls_8',
			'label' => 'Incluir el API de Google Maps?',
			'name' => 'api',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
            'key' => 'group_devialia_sl_controls_7',
            'label' => 'API Google Maps',
            'name' => 'api_google_maps',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                    'width' => '75',
                    'class' => '',
                    'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
		array (
			'key' => 'group_devialia_sl_controls_1',
			'label' => 'Zoom',
			'name' => 'zoom',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'group_devialia_sl_controls_2',
			'label' => 'Tipo de mapa',
			'name' => 'map_type',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'group_devialia_sl_controls_3',
			'label' => 'Escala',
			'name' => 'scale',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'group_devialia_sl_controls_4',
			'label' => 'Vista de calle',
			'name' => 'street_view',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'group_devialia_sl_controls_5',
			'label' => 'Rotación',
			'name' => 'rotation',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'group_devialia_sl_controls_6',
			'label' => 'Pantalla completa',
			'name' => 'fullscreen',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'devialia-store-locator',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_devialia_sl_general',
	'title' => 'Generales',
	'fields' => array (
		array (
			'key' => 'group_devialia_sl_general_6',
			'label' => 'Idioma',
			'name' => 'language',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'en' => 'English',
				'es' => 'Español',
			),
			'default_value' => array (
				0 => 'es',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
		array (
			'key' => 'group_devialia_sl_general_7',
			'label' => 'País por defecto',
			'name' => 'default_country',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'group_devialia_sl_general_1',
			'label' => 'Estilo del mapa',
			'name' => 'map_style',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'default' => 'Por defecto',
				'dark' => 'Oscuro',
			),
			'default_value' => array (
				0 => 'default',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
		array (
			'key' => 'group_devialia_sl_general_2',
			'label' => 'Zoom del mapa',
			'name' => 'map_zoom',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '25',
				'class' => '',
				'id' => '',
			),
			'default_value' => 12,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1,
			'max' => 16,
			'step' => '',
		),
		array (
			'key' => 'group_devialia_sl_general_3',
			'label' => 'Pica por defeto',
			'name' => 'default_marker_icon',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'group_devialia_sl_general_4',
			'label' => 'Pica para el usuario',
			'name' => 'center_marker_icon',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'group_devialia_sl_general_5',
			'label' => 'Centro inicial',
			'name' => 'initial_center',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '40.4331123',
			'center_lng' => '-3.7069013',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'devialia-store-locator',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array (
	'key' => 'group_devialia_sl_styles',
	'title' => 'Estilos',
	'fields' => array (
		array (
			'key' => 'group_devialia_sl_styles_1',
			'label' => 'CSS',
			'name' => 'css',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 10,
			'new_lines' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'devialia-store-locator',
			),
		),
	),
	'menu_order' => 3,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;

/**
* Creo los campos para las Stores
**/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_devialia_sl_stores_data',
	'title' => 'Datos de la tienda',
	'fields' => array (
		array (
			'key' => 'group_devialia_sl_stores_data_1',
			'label' => 'Dirección completa',
			'name' => 'address',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '100%',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => '',
		),
		array (
			'key' => 'group_devialia_sl_stores_data_6',
			'label' => 'Dirección a mostrar',
			'name' => 'display_address',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '100',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'group_devialia_sl_stores_data_7',
			'label' => 'Código postal',
			'name' => 'cp',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'stores',
			),
		),
	),
	'menu_order' => 3,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;