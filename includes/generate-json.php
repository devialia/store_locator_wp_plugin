<?php
if (!class_exists( 'Devialia_SL_JSON' )) :

	class Devialia_SL_JSON {
		public $stores;
		private $json;
		public $json_public;

		function __construct() {
			$uploads_dir = wp_upload_dir();
			$this->json = $uploads_dir['basedir'] . '/stores.json';
			$this->json_public = $uploads_dir['baseurl'] . '/stores.json';
			if (!file_exists($this->json))
				$this->create_json();
		}

		function create_json() {
			$stores = array();

			$args = array(
				'post_type'			=>	'stores',
				'post_status'		=>	'publish',
				'posts_per_page'	=>	-1,
			);

			$query = new WP_Query($args);
			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					$location = get_field('address');
					$stores[] = array(
						'title'				=>	get_the_title(),
						'lat'				=>	$location['lat'],
						'lng'				=>	$location['lng'],
						'address'			=>	$location['address'],
						'display_address'	=>	get_field('display_address'),
					);
				}
				wp_reset_postdata();
			}

			$this->stores = $stores;

			$stores_json = json_encode($stores);
			
			// Creo el archivo JSON con los datos obtenidos
			$file = fopen($this->json, 'w');
			fwrite($file, $stores_json);
			fclose($file);
		}
	}

endif;

/**
* Update or create the store's json when is inserted or updated an store
**/
function update_json_when_change_ddbb($post_id) {
	if (get_post_type($post_id) == 'stores') {
		$json = new Devialia_SL_JSON();
		$json->create_json();
	}
}
add_filter('save_post', 'update_json_when_change_ddbb');