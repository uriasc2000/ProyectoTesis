jQuery(document).ready(function () {

    var marker, map, myLatLng, mapCanvas, myCenter, mapOptions, latitud, longitud, velocidad;

    cargarMapa();

    setInterval(ejecutar, 1000);

    function cargarMapa()
    {
        myCenter = new google.maps.LatLng(10.980540, -74.842178);
        mapCanvas = document.getElementById("map");
        mapOptions = {
            center: myCenter,
            zoom: 17
        };
        map = new google.maps.Map(mapCanvas, mapOptions);
        marker = new google.maps.Marker({position: myCenter});
        //marker.setIcon('iconos/van.png');
        marker.setMap(map);
        map.setCenter(marker.getPosition());
    }


    function ejecutar()
    {
        url = "coordenadas.json";
        id = 1;
        $.getJSON(url, {"id": id}, function (coordenadas)
        {
            $.each(coordenadas, function (i, coordenada)
            {
                latitud = coordenadas.latitud;
                longitud = coordenadas.longitud;
                velocidad = coordenadas.velocidad;
                mapOptions = {
                    center: myCenter,
                    zoom: 15
                };
                marker.setMap(null);
                myCenter = new google.maps.LatLng(latitud, longitud);
                marker = new google.maps.Marker({position: myCenter});
                //marker.setIcon('iconos/van.png');
                marker.setMap(map);
                marker.setPosition(myCenter);
                map.panTo(myCenter);
                document.getElementById('logD').value = velocidad;
                return false;
            });       //fin coordenadas                     
        });	// fin getJson
    } //fin función

});