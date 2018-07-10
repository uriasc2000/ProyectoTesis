<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Viaje</title>
    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    

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

      //evitamos el comportamiento por defecto de los links
      $(document).on("click", "a", function(e){
          e.preventDefault();    
      })

      function paginar(var_placa,var_pagina){
        //alert('info'+texto+valor);
        $.get("prueba.php",{placa:var_placa,pagina:var_pagina},function(data){
            $("#receptor").html("");
            $("#receptor").append(data);
          },"json");
      }


    </script>
  </head>
  <body>
    <input type="input" id="entrada" size="25">
    <input type="button" id="consultar" value="CONSULTAR">
    <div id="receptor"></div>
    <div id="map"></div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>