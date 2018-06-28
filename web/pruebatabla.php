<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Viaje</title>
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript">
      
      $(function(){
        $("#consultar").click(function(){
          $("#receptor").text("consultando...");
          $.get("obtenerviajes.php",{placa:$("#entrada").val()},function(data){
            var xml = data.responseXML;
            var xmlString = (new XMLSerializer()).serializeToString(data);
            $("#receptor").html(xmlString);
          },"xml");
      });
      });

    </script>
  </head>
  <body>
    <input type="input" id="entrada" size="25">
    <input type="button" id="consultar" value="consultar">
    <div id="receptor"></div>
  </body>
</html>