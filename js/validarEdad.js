Swal.fire({
    position: 'center',
    title: 'Bienvenido a Duran Bebidas',
    showConfirmButton: true,
    showCancelButton: true,
    width: '800px',
    confirmButtonClass:'botonSweet',
    cancelButtonClass:'botonSweet2',
    text: "¿Sos mayor de edad?",
    customClass:'modal4',
    cancelButtonColor:'red',
    confirmButtonColor:'green',
    confirmButtonText:'Si',
    cancelButtonText:'No',
    focus: false,
   }).then(function (result) {

    if (result.isConfirmed){
            Swal.fire({
              icon: 'success',
              title: 'Bienvenido',
            showConfirmButton: false,
               timer: 1500,
            customClass:'modal4'
            });
    }
    else{
        setTimeout("location.href='https://www.youtube.com/watch?v=ZAAjm4IJhFY'",0000);
    }  
});