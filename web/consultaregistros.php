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
  <div class="card">
  <h5 class="card-header">Consulta de registros</h5>
  <div class="card-body">

<div>
  <form class="form-inline">
    <div class="form-group mb-2">
      <label for="lbl_entrada" class="sr-only">INGRESE PLACA BUS</label>
      <input type="text" readonly class="form-control-plaintext" id="lbl_entrada" value="INGRESE PLACA BUS">
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <label for="entrada" class="sr-only">Entrada</label>
      <input type="text" class="form-control" id="entrada">
    </div>
  </form>
  <form>
  <input type="button" id="Consultar" value="CONSULTAR" class="btn btn-primary">
  </form>
  </div>
  <div id="receptor"></div>
  </div>
  </div>
  
  </body>
</html>