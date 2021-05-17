$(document).ready(function(){
    $(".btnCompra").click(function(event){
      event.preventDefault();
      var usu = $(this).data('usu');
      var importe = $(this).data('importe');
      var fecha = $(this).data('fecha');
      
      $.ajax({
        method:'POST',
        url:'pagar.php',
        data:{
          usu:usu,
          importe:importe,
          fecha:fecha
        }
      }).done(function(respuesta){
        window.location.replace("pagar.php");
      });
    });
});