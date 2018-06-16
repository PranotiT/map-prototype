<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>First Leaflet map</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
	<style>
		#mapContainer {
			position: absolute;
			top:0;
			right:0;
			bottom:0;
			left:0;

		}
	</style>
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
	<div id="mapContainer"></div>
	<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
	<script>
		//instantiate the leaflet map
		var map = L.map('mapContainer').setView([53.073635, 8.806422], 14);

		//CartoDB layer names: light_all / dark_all / light_nonames / dark_nonames
      	 var layer = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
         }).addTo(map)

          //Leaflet has a very handy shortcut for zooming the map view to the detected location — locate method with the setView option, replacing the usual setView method in the code:
         map.locate({setView: true, maxZoom: 16});

      	 //Marker to show the user‘s current position
         /*L.marker([53.073635, 8.806422]).addTo(map)
    	.bindPopup('You are  here..!')
    	.openPopup();*/

    	//adding an event listener to locationfound event before the locateAndSetView call:
		function onLocationFound(e) {
    		var radius = e.accuracy / 2;

    		L.marker(e.latlng).addTo(map)
        		.bindPopup("You are within " + radius + " meters from this point").openPopup();

    		L.circle(e.latlng, radius).addTo(map);
		}

		map.on('locationfound', onLocationFound);    	

		//show an error message if the geolocation failed:
		function onLocationError(e) {
    		alert(e.message);
		}

		map.on('locationerror', onLocationError);

	</script>
</body>
</html>