  function cambiar(id,direccion){

	Swal.fire({
        position: 'center',
		inputPlaceholder: 'Ingrese Direccion',
        title: 'Direccion de Envio',
        input: 'text',
        showConfirmButton: true,
		showCancelButton: true,
        inputValue:direccion,
        customClass:'modal2',
        cancelButtonColor:'red',
        confirmButtonColor:'green',
        confirmButtonText:'Confirmar',
        cancelButtonText:'Cancelar'
       }).then(function (result) {

        if (result.isConfirmed) {
		let valueInt = result.value;
  		 
			if(result.value===''){
				Swal.fire({
  				icon: 'error',
  				title: 'Oops...',
  				text: 'Debe colocar una dirección válida',
				showConfirmButton: false,
       			timer: 1500,
                customClass:'modal2'
				});
			}
            else{
			$.ajax({
			type:"POST",
      		url:"actualizarDireccion.php",
		  	data:{
              id:id,
			  direccion:valueInt,
      		},
    		success:function(resp){
			Swal.fire({
       		position: 'center',
       		icon: 'success',
       		title: 'Direccion Editada',
       		showConfirmButton: false,
       		timer: 1500,
            customClass:'modal2'
        	});
    		}
  			});
              setTimeout("location.href='checkout.php'",1500);
		    }
        }  
  });
}