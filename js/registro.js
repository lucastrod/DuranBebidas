$(document).ready(function() {

    var mensaje = $('#mensaje').data('id');

if(mensaje!==undefined)
{       
   Swal.fire({
   position: 'center',
   icon: 'success',
   title: 'Registro Correcto',
   text: mensaje,
   showConfirmButton: true,
   //timer: 3500,
   customClass:'modal3',
   confirmButtonColor:'green',
   confirmButtonText:'Entendido',
    });
}

});