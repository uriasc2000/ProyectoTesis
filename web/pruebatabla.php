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

      $(document).ready(function() {    
        $(".paginate").live("click", function(){
          var page = $(this).attr("data");        
          var placa = $("#entrada").val();
          var dataString = "placa="+placa+"&pagina="+page;
          $.ajax({
              type: "GET",
              url: "includes/pagination.php",
              data: dataString,
              success: function(data) {
                  $('#receptor').html(data);
              }
          });
        });              
      });    

    </script>
  </head>
  <body>
    <input type="input" id="entrada" size="25">
    <input type="button" id="consultar" value="CONSULTAR">
    <div id="receptor"></div>
    <div id="map"></div>
  </body>
</html>