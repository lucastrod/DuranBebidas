$(document).ready(function() {

    var recarga = $('#rec').data('id');

    if(recarga !=''){
        recargar();
    }

    function recargar() {
        Swal.fire({
            position: 'center',
            //icon: 'success',
            title: 'Realizando Registro...',
            showConfirmButton: false,
            text: "Aguarde unos instantes por favor",
            timer: 6500,
            width: '650px',
            customClass:'modal4',
             willOpen: () => {
               Swal.showLoading()
             }
         });
    }

});