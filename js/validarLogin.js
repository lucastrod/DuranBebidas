$(document).ready(function() {

    var valor = $('#login').data('id');

if(valor === 1)
{    
    Swal.fire({
        position: 'center',
        icon: 'warning',
        text: "Debe estar logueado para finalizar la compra",
        showCancelButton: false,
        customClass:'modal2',
        confirmButtonText: 'Login',
        confirmButtonColor:'green',
         }).then((result) => {
            if (result.isConfirmed) {
                setTimeout("location.href='login.php'",0000);
            }
     });
}     

});