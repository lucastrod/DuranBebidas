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
          alert(data);

            //$('#envio').text(data);
            //$('#subtotal').text(data);
        }
    });
}
//setInterval(actualizar, 0);

});