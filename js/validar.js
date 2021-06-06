$(document).ready(function() {

    var mensaje = $('#mensaje').data('id');

if(mensaje.includes('correctamente'))
{       
   Swal.fire({
   position: 'center',
   icon: 'success',
   title: mensaje,
   showConfirmButton: false,
   timer: 2500,
   customClass:'modal2'
    });
}
else{
    Swal.fire({
   position: 'center',
   icon: 'error',
   title: mensaje,
   showConfirmButton: false,
   timer: 2500,
   customClass:'modal2'
    });
}

});