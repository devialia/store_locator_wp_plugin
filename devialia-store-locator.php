<?php
/**
 * Plugin Name:     Devialia Store Locator
 * Plugin URI:      http://devialia.com/
 * Description:     Plugin que permite tener un store locator con locales organizados en localidades y sublocalidades.
 * Además se añade un módulo para poder incorporar publicidad, tanto en los locales como a nivel general.
 * Author:          Devialia
 * Author URI:      http://devialia.com/
 * Text Domain:     devialia-store-locator
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Devialia_Store_Locator
 */

register_activation_hook( __FILE__, 'check_acf_plugin_installed' );
function check_acf_plugin_installed(){
    if ( !is_plugin_active( 'advanced-custom-fields-pro/advanced-custom-fields-pro.php' ) ) {
           // Para las máquinas y muestra un error
           wp_die('Uppsss. Este plugin necesita que esté activado el plugin 
                   "Advanced Custom Fields" por lo que no se puede activar.. <br>
                    <a href="' . admin_url( 'plugins.php' ) . '">&laquo; 
                    Volver a la página de Plugins</a>');
    }
}

include('includes/functions.php');
include('includes/rol.php');
include('includes/locales.php');