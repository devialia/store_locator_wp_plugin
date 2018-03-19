class GoogleMaps {
	constructor(center, icon, user_icon) {
		this.map = 'undefined';
		this.center = center;
		this.center_marker = 'undefined';
		this.markers = 'undefined';
		this.icon = icon;
		this.user_icon = user_icon;
	}

	/**
	* Print the center of the map as an LatLng object
	**/
	show_center() {
		console.log('Show -> Latitud: ' + this.map.getCenter().lat() + ' Longitud: ' + this.map.getCenter().lng());
	}

	/**
	* Return the center of the map as an LatLng object
	**/
	get_center() {
		return(this.map.getCenter());
	}

	set_zoom(zoom) {
		this.map.setZoom(zoom);
	}

	/**
	* Print the Google Maps map
	* id is the div where you want to print it
	* options is an object width the different options of the map: zoom, style, center...
	*/
	get_map(id, options) {
		var args = {
          	zoom: 6,
          	center: {lat: 40.4330989, lng: -3.7045579}
        };

        if (options.zoomControl == 'true') {
        	args = Object.assign({
        		zoomControl: true
        	}, args);
        }

        if (options.mapTypeControl == 'true') {
        	args = Object.assign({
        		mapTypeControl: true
        	}, args);
        }

        if (options.scaleControl == 'true') {
        	args = Object.assign({
        		scaleControl: true
        	}, args);
        }

        if (options.streetViewControl == 'true') {
        	args = Object.assign({
        		streetViewControl: true
        	}, args);
        }

        if (options.rotateControl == 'true') {
        	args = Object.assign({
        		rotateControl: true
        	}, args);
        }

        if (options.fullscreenControl == 'true') {
        	args = Object.assign({
        		fullscreenControl: true
        	}, args);
        }

        if (options.custom == 'true') {
        	args = Object.assign({
        		disableDefaultUI: true,
        		styles: options.styles
        	}, args);
        }

		this.map = new google.maps.Map(document.getElementById(id), args);

        if (this.center != 'undefined') {
        	this.map.setCenter(this.center); // Ha de ser un objeto de tipo {lat:LAT_VALUE, lng:LONG_VALUE}
        }

        if (options.zoom != 'undefined') {
        	this.map.setZoom(options.zoom); // It has to be an integer, how much smaller it is, less zoom.
        }
	}

	/**
	* This function adds a marker into the defined center
	**/
	add_center_marker(center) {
		if (center == 'undefined')
			var center = this.center;
		var args = {
		    position: center,
		    map: this.map
		}

		// If an icon has been defined, it is added to the marker
		if (this.icon != 'undefined')
			args = Object.assign({
				icon: this.icon
			}, args);

		var marker = new google.maps.Marker(args);
		this.center_marker = marker;
	}

	/**
	* This function changes the map center and the marker
	* Pass 'true' for show for print marker
	* Pass 'true' for user for print user icon
	**/
	change_center_map(address, show, user) {
		var googleMapsUrl = 'https://maps.googleapis.com/maps/api/geocode/json?address=';
		var location;
		var map = this.map;
		if (user == 'true')
			var icon = this.user_icon;
		else
			var icon = this.icon;

		jQuery.ajax({
			dataType: "json",
			url: googleMapsUrl + address,
			//async: false
		}).done(function(data){
			location = data.results[0].geometry.location;
			map.setCenter(new google.maps.LatLng(location.lat, location.lng));
			if (show == 'true') {
				var center = {lat: location.lat, lng: location.lng};
				var args = {
				    position: center,
				    map: map
				}
				if (icon != 'undefined')
					args = Object.assign({
						icon: icon
					}, args);
				var marker = new google.maps.Marker(args);
			}
		});

		/*this.map.setCenter(new google.maps.LatLng(location.lat, location.lng));
		var center = {lat: location.lat, lng: location.lng};
		this.add_center_marker(center);
		return this.center_marker;*/
	}

	/**
	* This function recives an address and print a marker in the map
	**/
	add_marker_location(address, icon) {
		var geocoder = new google.maps.Geocoder();
		var map = this.map;
		if (icon == 'undefined')
			icon = this.icon;

		if (address == 'undefined') {
			address = this.map.getCenter().lat() + ',' + this.map.getCenter().lng();
		}

		geocoder.geocode( { 'address': address}, function(results, status) {
	    	if (status == 'OK') {
		        var args = {
		            map: map,
		            position: results[0].geometry.location
		        };

		        // If an icon has been defined, it is added to the marker
		        if(icon != 'undefined')
		        	args = Object.assign({
		        		icon: icon
		        	},args);

		        var marker = new google.maps.Marker(args);
		    } else {
		        alert('Geocode was not successful for the following reason: ' + status);
		    }
	    });
	}

	/**
	* This function calculate the distance between two coordinates in km
	**/
	distance_between_coordinates(lat1, lng1, lat2, lng2) {
		var p1 = new google.maps.LatLng(lat1, lng1);
		var p2 = new google.maps.LatLng(lat2, lng2);
		var distance = google.maps.geometry.spherical.computeDistanceBetween(p1,p2);

		return Math.round(distance);
	}

	/**
	* This function sort the locations
	**/
	sort_locations (locations) {
		var distanceObj = [];
		var i = 0;
		var map = this.map;
		var distance_between_coordinates = this.distance_between_coordinates;

		jQuery.each(locations, function(a,b) {
			distanceObj[i] = {
				distance: distance_between_coordinates(map.getCenter().lat(), map.getCenter().lng(), b.lat, b.lng),
				lat: parseFloat(b.lat),
				lng: parseFloat(b.lng),
				title: b.title,
				address: b.address,
				display_address: b.display_address,
				locality: b.locality,
				province: b.province,
				telf: b.telf,
				email: b.email,
			};
			++i;
		});

		distanceObj.sort(function(a, b){
			return parseInt(a.distance) - parseInt(b.distance)
		});

		return distanceObj;
	}

	/**
	* This function center the map with the map's markers
	**/
	fitBoundsToVisibleMarkers() {
	    var bounds = new google.maps.LatLngBounds();

	    for (var i=0; i < this.markers.length; i++) {
	        if(this.markers[i].getVisible()) {
	            bounds.extend( this.markers[i].getPosition() );
	        }
	    }

	    this.map.fitBounds(bounds);
	}

	/**
	* This function recive a locations object and create a cluster of markers with infowindow
	* if it has it.
	**/
	add_cluster(locations) {
		var icon = this.icon;
		var map = this.map;
		var locations = this.sort_locations(locations);

		this.markers = locations.map(function(location, i) {
          	var args = {
           		position: location,
            	label: ""+(i+1)
          	};

          	// If an icon has been defined, it is added to the markers.
          	if (icon != 'undefined')
	        	args = Object.assign({
	          		icon: icon
	          	}, args);

          	var marker = new google.maps.Marker(args);

          	// If info for the infowindow has been defined, the infowindow is created and the 
          	// listener for the click event is added.
          	if (location.distance != 'undefined') {
		    	var infowindow = new google.maps.InfoWindow({
			        content: location.title + "</br>" + location.display_address + "</br>Localidad: " + location.locality + " Provincia: " + location.province + "</br>Telf.: " + location.telf + " Email: " + location.email
			    });

	          	marker.addListener('click', function(){
		          	infowindow.open(map, marker);
		        });
	        }

	        jQuery('#markers ul').append('<li><b>' + location.title + '</b><br>Latitud: ' + location.lat + ', Longitud: ' + location.lng + '<br>Distancia: ' + location.distance + ' KM</li>');

          	return marker;
        });

        var markerCluster = new MarkerClusterer(this.map, this.markers, {imagePath: '/wp-content/plugins/devialia-store-locator/img/cluster/m'});
        this.fitBoundsToVisibleMarkers();
	}
}