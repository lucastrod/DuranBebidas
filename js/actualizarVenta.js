$(document).ready(function(){
    $("input[name=venta]").change(function(){
        var id = $(this).data('id');
        var estado =  $(this).data('estado');
      actualizar(id,estado);
    });
  
    function actualizar(id,estado) {

      $.ajax({
          type: "POST",
          url: "./actualizarVenta.php",
          data:{
            id:id,
            estado:estado
          },
          success: function(data) {
            var jsonData = JSON.parse(data);
              $('#envio').text(jsonData.envio);
              $('#subtotal').text(jsonData.total);
              //setTimeout("location.href='entregas.php'",2000);
          }
      });
  }
  
  });