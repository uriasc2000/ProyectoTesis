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

      $(function(){
        $("#test").click(function(){
          alert('Hola '+$("#test").val());
      });
      });

      function sayHello(persona)(
        alert('Hola '+$("#test").val());
      )

    </script>
  </head>
  <body>
    <input type="input" id="entrada" size="25">
    <input type="button" id="consultar" value="consultar">
    <input type="button" id="test" value="Marvin">
    <div id="receptor"></div>
    <div id="map"></div>
  </body>
</html>