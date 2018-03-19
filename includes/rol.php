<?php
/**
* Creo un nuevo rol que tiene las mismas capacidades que el rol editor
*/
$editor = get_role('editor');
add_role('gestor_locales', __('Gestor Locales'), $editor->capabilities);

/**
* Customizo el panel de administación para el rol gestor_locales
*/
function gestor_locales_customization () {
	/**
	* Únicamente se aplica al rol gestor_locales
	*/
	if (current_user_can('gestor_locales')) :

		/**
		* Oculto elementos del menú que no son necesarios
		*/
		function remove_menu_pages_for_gestor_locales () {
			remove_menu_page('edit-comments.php'); // Comentarios
			remove_menu_page('tools.php'); // Herramientas
			remove_menu_page('edit.php'); // Entradas
			remove_menu_page('edit.php?post_type=page'); // Páginas
		}
		add_action('admin_menu', 'remove_menu_pages_for_gestor_locales');

		/**
		* Quitamos metaboxes del escritorio
		*/
		function remove_dashboard_mataboxes_for_gestor_locales () {
			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
		}
		add_action('wp_dashboard_setup', 'remove_dashboard_mataboxes_for_gestor_locales');

		/**
		* Forzamos el escritorio a una sola columna
		*/ 
		function so_screen_layout_columns( $columns ) {
		    $columns['dashboard'] = 1;
		    return $columns;
		}
		 
		function so_screen_layout_dashboard() {
		    return 1;
		}

		//add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );
		//add_filter( 'get_user_option_screen_layout_dashboard', 'so_screen_layout_dashboard' );

		/**
		* Creo los widgets del escritorio
		*/
		// Stores
		function stores_dashboard_widget() { ?>
		    <a href="<?=STORES_PATH?>"><img style="width: 40%; margin-left: 30%;" src="<?= plugin_dir_url( dirname(__FILE__) ) ?>/img/tienda-online.png" /></a>
		<?php }
		// Add Store
		function new_store_dashboard_widget() { ?>
		    <a href="<?=NEW_STORE_PATH?>"><img style="width: 40%; margin-left: 30%;" src="<?= plugin_dir_url( dirname(__FILE__) ) ?>/img/cesta-de-la-compra.png" /></a>
		<?php }
		// Stores Locations
		function store_locations_dashboard_widget() { ?>
		    <a href="<?=STORES_LOCATIONS_PATH?>"><img style="width: 40%; margin-left: 30%;" src="<?= plugin_dir_url( dirname(__FILE__) ) ?>/img/marcador-de-posicion.png" /></a>
		<?php }
		// Stores Locations
		function config_store_locator_dashboard_widget() { ?>
		    <a href="<?=STORE_LOCATOR_CONFIG_PATH?>"><img style="width: 40%; margin-left: 30%;" src="<?= plugin_dir_url( dirname(__FILE__) ) ?>/img/config.png" /></a>
		<?php }

		function add_custom_dashboard_widget() {
		        wp_add_dashboard_widget('stores_dashboard_widget', __( 'STORES' ), 'stores_dashboard_widget');
		        add_meta_box('new_store_dashboard_widget', __( 'ADD NEW STORE' ), 'new_store_dashboard_widget', 'dashboard', 'side', 'high');
		        add_meta_box('store_locations_dashboard_widget', __( 'STORES LOCATIONS' ), 'store_locations_dashboard_widget', 'dashboard', 'column3', 'high');
		        add_meta_box('config_store_locator_dashboard_widget', __( 'STORE LOCATOR CONFIG' ), 'config_store_locator_dashboard_widget', 'dashboard', 'column4', 'high');
		}
		add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

		/**
		* Oculto la barra de menú para el rol gestor_locales
		*/
		function hide_admin_menu_bar () {
			echo '<style>#adminmenuwrap {display: none;}</style>';
		}
		//add_action('admin_head', 'hide_admin_menu_bar');
	endif;
}
add_action('init', 'gestor_locales_customization');