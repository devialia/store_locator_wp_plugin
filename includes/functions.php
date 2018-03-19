<?php
/**
* Añado el API de Goolge Maps a ACF
**/
function devialia_config_acf_init() {
	if (get_field('api_google_maps', 'devialia-store-locator'))
		$API = get_field('api_google_maps', 'devialia-store-locator');
	else
		$API = 'AIzaSyCWa8wzE5ZIRS4OP5kB3CmeKluUoETeKTg';
	acf_update_setting('google_api_key', $API);
}
add_action('acf/init', 'devialia_config_acf_init');