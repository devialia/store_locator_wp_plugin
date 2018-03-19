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

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

register_activation_hook( __FILE__, 'check_acf_plugin_installed' );
function check_acf_plugin_installed(){
    if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
           // Para las máquinas y muestra un error
           wp_die('Uppsss. Este plugin necesita que esté activado el plugin 
                   "Advanced Custom Fields" por lo que no se puede activar.. <br>
                    <a href="' . admin_url( 'plugins.php' ) . '">&laquo; 
                    Volver a la página de Plugins</a>');
    }
}

/**
* Variables globales y constanes
*/
define( "STORES_PATH", "/wp-admin/edit.php?post_type=stores" );
define( "NEW_STORE_PATH", "/wp-admin/post-new.php?post_type=stores" );
define( "STORES_LOCATIONS_PATH", "/wp-admin/edit-tags.php?taxonomy=stores_locations&post_type=stores" );
define( "STORE_LOCATOR_CONFIG_PATH", "/wp-admin/edit.php?post_type=stores&page=devialia-store-locator" );


include('includes/functions.php');
include('includes/rol.php');
include('includes/locales.php');
include('includes/map-styles.php');
include('includes/generate-json.php');
include('includes/store-locator.php');