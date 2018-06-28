<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Viaje</title>
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript">
      
      $(function(){
        $("#consultar").click(function(){
          $("#receptor").text("consultando.");
          $.get("prueba.php",{placa:$("#entrada").val()},function(data){
            $("#receptor").html("");
            $("#receptor").append(data);
          },"json");
      });
      });


      function cargarViaje(viaje) {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(14.563, -90.7398),
          zoom: 15
        });
      
        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        //downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
        obtenerPuntos("obtenerpuntosviaje.php?id_viaje=",viaje,function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName('marker');
          var idt = 1;
          Array.prototype.forEach.call(markers, function(markerElem) {
            var id = markerElem.getAttribute('id');
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var type = markerElem.getAttribute('tipo');
            var point = new google.maps.LatLng(
              parseFloat(markerElem.getAttribute('latitud')),
              parseFloat(markerElem.getAttribute('longitud'))
            );

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));

            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);
            var icon = customLabel[type] || {idt};
            var marker = new google.maps.Marker({
              map: map,
              position: point,
              label: idt.toString()
            });

            idt+=1;

            marker.addListener('click', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
            });
          });
        });
      }

      function obtenerPuntos(url, idViaje, callback) {
        var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;
        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };
        request.open('GET', url+idViaje, true);
        request.send(null);
      }

    </script>
  </head>
  <body>
    <input type="input" id="entrada" size="25">
    <input type="button" id="consultar" value="consultar">
    <div id="receptor"></div>
    <div id="map"></div>
  </body>
</html>