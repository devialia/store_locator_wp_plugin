<?php
/**
* Añado el API de Goolge Maps a ACF
**/
function devialia_config_acf_init() {
	if (get_field('api', 'devialia-store-locator')) :
		if (get_field('api_google_maps', 'devialia-store-locator'))
			$API = get_field('api_google_maps', 'devialia-store-locator');
		else
			$API = 'AIzaSyCWa8wzE5ZIRS4OP5kB3CmeKluUoETeKTg';
		acf_update_setting('google_api_key', $API);
	endif;
}
add_action('acf/init', 'devialia_config_acf_init');

/**
* Reorganizo los campos en la página de edición de las stores
**/
function reorder_store_fields () {
	?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$('.acf-field-group-devialia-sl-stores-data-8').append( $('#postdivrich') );
				$('.acf-field-group-devialia-sl-stores-data-9').append( $('#stores_locationsdiv') );
			});
		})(jQuery);
	</script>
	<style type="text/css">
        .acf-field #wp-content-editor-tools {
            background: transparent;
            padding-top: 0;
        }
    </style>
	<?php
}
add_action('acf/input/admin_head', 'reorder_store_fields');