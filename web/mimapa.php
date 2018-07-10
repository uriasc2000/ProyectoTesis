<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Mapa de recorrido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>
    <div class="card">
      <h5 class="card-header">Presentación grafica de recorrido</h5>
      <div class="card-body">
        
      </div>
    </div>
    <div id="map"></div>
        <div id="ingreso">
          <form> 
            <?php
              $viaje = $_GET['viaje'];
              echo "<input type=\"hidden\" value =\"$viaje\" name =\"viaje\" id=\"viaje\"/>";
            ?>                                
          </form>
        </div>    
    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(14.563, -90.7398),
          zoom: 15
        });
      
        var idviaje = document.getElementById('viaje').value;
        var infoWindow = new google.maps.InfoWindow;

        obtenerPuntos("obtenerpuntosviaje.php?id_viaje=",idviaje,function(data) {
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

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;
        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };
        request.open('GET', url, true);
        request.send(null);
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;
        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };
        request.open('GET', url, true);
        request.send(null);
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

      function doNothing() {}
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTOZpHPXJ1Z6m_WYQ6YRtLoHznv5vOvqE&callback=initMap">
    </script>
  </body>
</html>