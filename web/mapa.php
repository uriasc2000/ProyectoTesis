<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Viaje</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var myCenter = new google.maps.LatLng(14.563, -90.7398);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 15};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        marker.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTOZpHPXJ1Z6m_WYQ6YRtLoHznv5vOvqE&callback=initMap">
    </script>
  </body>
</html>