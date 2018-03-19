<?php
/**
* Función que devuelve el mapa del Store Locator
*/
function print_devialia_store_locator() {
	$map = '<div id="map-canvas"></div>';

	return $map;
}

/**
* Función que genera el mapa del Store Locator
*/
function print_devialia_store_locator_script() {
	// Creo una instacia de la clase Devialia_SL_JSON
	$json = new Devialia_SL_JSON();

	// Creo una instacia de la clase Map_Styles
	$style = new Map_Styles(get_field('map_style','devialia-store-locator'));

	// Consulto la info guardada en BBDD para pintar el mapa
	$default_marker = get_field('default_marker_icon','devialia-store-locator');
	if (!empty($default_marker))
		$icon = $default_marker['url'];
	else
		$icon = 'undefined';
	$user_marker = get_field('center_marker_icon','devialia-store-locator');
	if (!empty($user_marker))
		$user_icon = $user_marker['url'];
	else
		$user_icon = 'undefined';
	$center_location = get_field('initial_center','devialia-store-locator');
	if (!intval(get_field('map_zoom','devialia-store-locator')))
		$zoom = 12;
	else
		$zoom = get_field('map_zoom','devialia-store-locator');
	$default_country = get_field('default_country','devialia-store-locator');

	// Añado el mapa en si mismo
	$map = "
	<script>
	jQuery(document).ready(function($){
		var map = new GoogleMaps({lat: ".$center_location['lat'].", lng: ".$center_location['lng']."}, '".$icon."', '".$user_icon."');
		var center_marker = 'undefined';

		map.get_map('map-canvas', {
			zoom: ".$zoom.",";
			if (get_field('zoom','devialia-store-locator'))
				echo "zoomControl: 'true',";
			if (get_field('map_type','devialia-store-locator'))
				echo "mapTypeControl: 'true',";
			if (get_field('scale','devialia-store-locator'))
				echo "scaleControl: 'true',";
			if (get_field('street_view','devialia-store-locator'))
				echo "streetViewControl: 'true',";
			if (get_field('rotation','devialia-store-locator'))
				echo "rotateControl: 'true',";
			if (get_field('fullscreen','devialia-store-locator'))
				echo "fullscreenControl: 'true',";
			
			echo $style->get_style();
			echo "custom: 'true',";
		echo "});
		$.getJSON('".$json->json_public."', function(locations){
			map.add_cluster(locations);
		});
	";

	// Permito la ampliación de la funcionalidad del script
	do_action( 'extend_print_devialia_store_locator_script' );

	$map .= "
	});
	</script>
	";

	return $map;
}