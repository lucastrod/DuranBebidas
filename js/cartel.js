$(document).ready(function(){
    $(".btnAgregar").click(function(event){
      event.preventDefault();
      var id = $(this).data('id');
      var cantidad = document.getElementById(id).value;

      $.ajax({
        method:'POST',
        url:'carrito.php',
        data:{
          id:id,
          cantidad:cantidad
        }
      }).done(function(respuesta){
       Swal.fire({
       position: 'center',
       icon: 'success',
       title: 'Producto Agregado',
       showConfirmButton: false,
       timer: 1500
        });
        changeNumber();
        //setTimeout("location.href='productos.php'",1500);
      });
    });

    function changeNumber() {
      value = $('#value').text();
      $.ajax({
          type: "POST",
          url: "./add.php",
          success: function(data) {
              $('#value').text(data);
          }
      });
    }

    $("select[id=catPrinc]").change(function(){
        recargarLista();
    });

    function recargarLista(){
      var prod = $('#prod').data('id');
      $.ajax({
      type:"POST",
      url:"datos.php",
      //data:"categoria=" + $('#lista1').val(),
      data:{
              categoria:$('#catPrinc').val(),
      },
      success:function(r){
      //$('#select2lista').text(r);
              document.getElementById("subcate").innerHTML = r;
      }
    });
    }  

});