$('input[type=checkbox]').on('change', function() {
	var id = $(this).data('id');
	var precio = $(this).data('precio');
	var checkbox = document.getElementById(id);

	if(checkbox.checked){
      on(id,precio);
    }
    else{
      off(id);
    }
});
  //var checkbox = document.getElementById('checkbox');
 
  function on(id,precio){
	Swal.fire({
        position: 'center',
		inputPlaceholder: 'Ingrese Precio Oferta',
        title: 'Precio Oferta',
        input: 'text',
        showConfirmButton: true,
		showCancelButton: true,
        customClass:'modal2',
        cancelButtonColor:'red',
        confirmButtonColor:'green',
        confirmButtonText:'Confirmar',
        cancelButtonText:'Cancelar'
       }).then(function (result) {

		let valueInt = parseInt(result.value);
  		if (!Number.isInteger(valueInt)) { 
			if(result.value!=undefined){
				Swal.fire({
  				icon: 'error',
  				title: 'Oops...',
  				text: 'Debe colocar un precio válido',
				showConfirmButton: false,
       			timer: 1500,
                customClass:'modal2'
				});
				setTimeout("location.href='ListProd.php'",2000);
			}
			else{
				setTimeout("location.href='ListProd.php'",1000);
			}
		}
		else{
			if(valueInt < precio){
			$.ajax({
			type:"POST",
      		url:"procesarOferta.php",
		  	data:{
              id:id,
			  precio_oferta:valueInt,
			  accion:'Agregar'
      		},
    		success:function(resp){
			Swal.fire({
       		position: 'center',
       		icon: 'success',
       		title: 'Oferta Agregada',
       		showConfirmButton: false,
       		timer: 1500,
            customClass:'modal2'
        	});
			setTimeout("location.href='ListProd.php'",2100);
    		}
  			});
			}
			else{
				Swal.fire({
  				icon: 'error',
  				title: 'Oops...',
  				text: 'Precio de Oferta Mayor al Original',
				showConfirmButton: false,
       			timer: 2500,
                customClass:'modal2'   
				});
				setTimeout("location.href='ListProd.php'",2700);
			}
		}
	
  });
}

  function off(id){

	$.ajax({
		type:"POST",
      	url:"procesarOferta.php",
		  data:{
              id:id,
			  accion:'Eliminar'
      	},
    	success:function(resp){
		Swal.fire({
       	position: 'center',
       	icon: 'success',
       	title: 'Oferta Eliminada',
       	showConfirmButton: false,
       	timer: 1500,
        customClass:'modal2'
        });
			setTimeout("location.href='ListProd.php'",2100);
    	}
  		});
  }

  function editar(id,precio_oferta,precio){
	Swal.fire({
        position: 'center',
		inputPlaceholder: 'Ingrese Precio Oferta',
        title: 'Precio Oferta',
        input: 'text',
        showConfirmButton: true,
		showCancelButton: true,
        inputValue:precio_oferta,
        customClass:'modal2',
        cancelButtonColor:'red',
        confirmButtonColor:'green',
        confirmButtonText:'Confirmar',
        cancelButtonText:'Cancelar'
       }).then(function (result) {

		let valueInt = parseInt(result.value);
  		if (!Number.isInteger(valueInt)) { 
			if(result.value!=undefined){
				Swal.fire({
  				icon: 'error',
  				title: 'Oops...',
  				text: 'Debe colocar un precio válido',
				showConfirmButton: false,
       			timer: 1500,
                customClass:'modal2'
				});
			}
		}
		else{

			if(valueInt < precio){
			$.ajax({
			type:"POST",
      		url:"procesarOferta.php",
		  	data:{
              id:id,
			  precio_oferta:valueInt,
			  accion:'Editar'
      		},
    		success:function(resp){
			Swal.fire({
       		position: 'center',
       		icon: 'success',
       		title: 'Oferta Editada',
       		showConfirmButton: false,
       		timer: 1500,
            customClass:'modal2'
        	});
            setTimeout("location.href='ListProd.php'",1500);
    		}
  			});
			}
			else{
				Swal.fire({
  				icon: 'error',
  				title: 'Oops...',
  				text: 'Precio de Oferta Mayor al Original',
				showConfirmButton: false,
       			timer: 2500,
                customClass:'modal2'
				});
			}
		}
  });
}