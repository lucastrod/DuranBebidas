$(document).ready(function(){
  $("input[name=envio]").change(function(){
    actualizar();
  });

  function actualizar() {
    var activo = $('input[name="envio"]:checked').val();
    $.ajax({
        type: "POST",
        url: "./actualizarEnvio.php",
        data:{
          activo:activo
        },
        success: function(data) {
          var jsonData = JSON.parse(data);
            $('#envio').text(jsonData.envio);
            $('#subtotal').text(jsonData.total);
        }
    });
}

});