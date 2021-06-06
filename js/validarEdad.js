Swal.fire({
    position: 'center',
    title: 'Bienvenido a Duran Bebidas',
    showConfirmButton: true,
    showCancelButton: true,
    width: '800px',
    confirmButtonClass:'botonSweet',
    cancelButtonClass:'botonSweet2',
    text: "¿Sos mayor de edad? Al confirmar ser mayor de edad manifiesta su conformidad con los términos de confidencialidad y el uso de cookies de este sitio web. Beber con moderación. Prohibida su venta a menores de 18 años.",
    customClass:'modal4',
    cancelButtonColor:'red',
    confirmButtonColor:'green',
    confirmButtonText:'Si',
    cancelButtonText:'No',
    focus: false,
   }).then(function (result) {

    if (result.isConfirmed){
        $.ajax({
			type:"POST",
      		url:"guardarCookie.php",
    		success:function(resp){
                Swal.fire({
                    icon: 'success',
                    title: 'Bienvenido',
                  showConfirmButton: false,
                     timer: 1500,
                  customClass:'modal4'
                });
    		}
  			});
    }
    else{
        setTimeout("location.href='https://www.youtube.com/watch?v=ZAAjm4IJhFY'",0000);
    }  
});