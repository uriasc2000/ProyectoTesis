<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Viaje</title>
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <script type="text/javascript">
      
      $(function(){
        $("#consultar").click(function(){
          $("#receptor").text("consultando");
          $.get("prueba.php",{placa:$("#entrada").val()},function(data){
            $("#receptor").html("llega");
          },"json");
      });
      });

      function respuesta(arg) {
        alert("Hola");
        $("#receptor").html(arg.toSource());

      }

    </script>
  </head>
  <body>
    <input type="input" id="entrada" size="25">
    <input type="button" id="consultar" value="consultar">
    <div id="receptor"></div>
  </body>
</html>