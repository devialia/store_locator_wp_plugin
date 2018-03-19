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
		* Creo un widget para el dashboard
		*/
		function custom_dashboard_widget() { ?>
		        <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" />     
		        <h1>¡Hola! Este es tu área personal en la web XXXX</h1>
		        <p>Aquí va todo el texto que quieras, con todo el HTML que precises</p>
		<?php }

		function add_custom_dashboard_widget() {
		        wp_add_dashboard_widget('custom_dashboard_widget', 'Bienvenido al editor de la web de XXXX', 'custom_dashboard_widget');
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