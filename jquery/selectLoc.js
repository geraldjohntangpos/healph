//<![CDATA[

		// global "map" variable
		var map = null;
		var marker = null;

		// popup window for pin, if in use
		var infowindow = new google.maps.InfoWindow({
				size: new google.maps.Size(150,50)
				});

		// A function to create the marker and set up the event window function
		function createMarker(latlng, name, html) {

		var contentString = html;

		var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				zIndex: Math.round(latlng.lat()*-100000)<<5
				});

		google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(contentString);
				infowindow.open(map,marker);
				});

		google.maps.event.trigger(marker, 'click');
		return marker;

}

function initialize() {

		// the location of the initial pin
		var lat = 10.29622504439878;
		var lng = 123.89832615852356;
		var add = "Metro Colon, Cebu City, Cebu, Philippines";
		var myLatlng = new google.maps.LatLng(lat, lng);
		//var myLatlng = new google.maps.LatLng(navigator.geolocation.getCurrentPosition());
		// create the map
		var myOptions = {
				zoom: 19,
				center: myLatlng,
				mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
				navigationControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		// establish the initial marker/pin
		var image = '/images/googlepins/pin2.png';
		//var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
		marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			icon: image,
			title:"Property Location"
		});

		// establish the initial div form fields
		formlat = document.getElementById("latbox").value = myLatlng.lat();
		formlng = document.getElementById("lngbox").value = myLatlng.lng();
		formadd = document.getElementById("address").value = add;

		// close popup window
		google.maps.event.addListener(map, 'click', function() {
				infowindow.close();
				});

		// removing old markers/pins
		google.maps.event.addListener(map, 'click', function(event) {
				//call function to create marker
				 if (marker) {
						marker.setMap(null);
						marker = null;
						//deleteMarkers();
				 }
// function setMapOnAll(map) {
//         for (var i = 0; i < marker.length; i++) {
//           marker[i].setMap(map);
//         }
//       }

//     function clearMarkers() {
//         setMapOnAll(null);
//       }

//     function deleteMarkers() {
//         clearMarkers();
//         marker = [];
//       }

				// Information for popup window if you so chose to have one
				/*
				 marker = createMarker(event.latLng, "name", "<b>Location</b><br>"+event.latLng);
				*/

				var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
				//var image = '/images/googlepins/pin2.png';
				var myLatLng = event.latLng ;
				/*
				var marker = new google.maps.Marker({
						by removing the 'var' subsquent pin placement removes the old pin icon
				*/
				//clearMarkers();
				marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						icon: image,
						title:"Property Location"
				});

				// populate the form fields with lat & lng
				formlat = document.getElementById("latbox").value = event.latLng.lat();
				formlng = document.getElementById("lngbox").value = event.latLng.lng();

				var latlng = {lat: event.latLng.lat(), lng: event.latLng.lng()};

				// address
				var geocoder = new google.maps.Geocoder;
				geocoder.geocode({'location': latlng}, function(results, status) {
					if (status === 'OK') {
						if (results[1]) {
							//map.setZoom(11);
							var marker = new google.maps.Marker({
								position: latlng,
								map: map
							});
							document.getElementById("address").value = results[1].formatted_address;
							//window.alert(results[1].formatted_address);
							//infowindow.setContent(results[1].formatted_address);
							//infowindow.open(map, marker);
						} else {
							window.alert('No results found');
						}
					} else {
						window.alert('Geocoder failed due to: ' + status);
					}
				});
		});

}
//]]>



