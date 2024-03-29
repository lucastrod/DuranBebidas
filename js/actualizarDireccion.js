  function cambiar(id,calle, numero, piso_departamento){

	Swal.fire({
		title: 'Direccion de Envio',
		customClass:'modal',
		showConfirmButton: true,
		showCancelButton: true,
		cancelButtonColor:'red',
        confirmButtonColor:'green',
        confirmButtonText:'Confirmar',
        cancelButtonText:'Cancelar',
		html:
		'<br><label for="c_fname" class="text-black" style="font-size:14px;"><strong>Calle</strong></label>'+ 
		'<input type="text" id="swal-input1" class="swal2-input" autofocus placeholder="Calle" value="'+calle+'">' +
		'<label for="c_fname" class="text-black" style="font-size:14px;"><strong>Numero</strong></label><br>'+ 
		'<input type="number" id="swal-input2" class="swal2-input" placeholder="Numero" value="'+numero+'">' +
		'<div><label for="c_fname" class="text-black" style="font-size:14px;"><strong>Piso/Departamento</strong></label></div>'+ 
		'<input type="text" id="swal-input3" class="swal2-input" autofocus placeholder="Piso/Departamento" value="'+piso_departamento+'">',
		 preConfirm: function() {
		   return new Promise(function(resolve) {
		   if (true) {
			resolve({calle: document.getElementById('swal-input1').value, 
			numero: document.getElementById('swal-input2').value, 
			piso_departamento: document.getElementById('swal-input3').value});
		   }
		  });
		 }
		 }).then(function(result) {
		//swal(JSON.stringify(result));
		if (result.isConfirmed) {
			if(result.value.calle ==='' || result.value.numero ===''){
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

				let ca = result.value.calle;
				let num = result.value.numero;
				let piso = result.value.piso_departamento;

				let direccion = ca +' '+num+', CABA';

				if(direccion !=''){
					initMap(direccion);
					}
					  function initMap(direccion) {
						
						const bounds = new google.maps.LatLngBounds();
						
						// initialize services
						const geocoder = new google.maps.Geocoder();
						const service = new google.maps.DistanceMatrixService();
						// Datos del cliente
						const origin1 = {
						  lat: -34.57882308284431,
						  lng: -58.431455779050324
						};
					   
						const destinationB = direccion;
					   
						const request = {
						  origins: [origin1],
						  destinations: [ destinationB],
						  travelMode: google.maps.TravelMode.DRIVING,
						  unitSystem: google.maps.UnitSystem.METRIC,
						  avoidHighways: false,
						  avoidTolls: false,
						};
							
						// get distance matrix response
						service.getDistanceMatrix(request).then((response) => {
						  // put response
			
						  var domicilioDestino = response.destinationAddresses[0];
			
						  if(domicilioDestino == 'Buenos Aires, CABA, Argentina'){
							
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Debe colocar una dirección válida',
							  showConfirmButton: false,
								 timer: 2500,
							  customClass:'modal2'
							  });
						  }
						  else{
			
						  var km = response.rows[0].elements[0].distance.value/1000;
						  //document.getElementById("res").innerText =  response.rows[0].elements[0].distance.value/1000;
						  
						  	$.ajax({
								type:"POST",
							  	url:"actualizarDireccion.php",
							 	data:{
							  	id:id,
							  	calle:ca,
							  	numero:num,
							  	piso_departamento:piso
							  	},
								success:function(resp){
		
									Swal.fire({
							   			position: 'center',
							   			//icon: 'success',
							   			title: 'Guardando Cambios...',
							   			showConfirmButton: false,
							   			timer: 2500,
										customClass:'modal2',
										willOpen: () => {
											Swal.showLoading()
										  }
									});
									setTimeout(function(){window.top.location="confirmarDomicilio.php?km="+km} , 2000);
								}
							});

						}	
						 
						});
									   
					  }
						  

				/*$.ajax({
					type:"POST",
					  url:"actualizarDireccion.php",
					  data:{
					  id:id,
					  calle:ca,
					  numero:num,
					  piso_departamento:piso
					  },
					success:function(resp){

					Swal.fire({
					   position: 'center',
					   //icon: 'success',
					   title: 'Guardando Cambios...',
					   showConfirmButton: false,
					   timer: 1500,
					customClass:'modal2',
						willOpen: () => {
						  Swal.showLoading()
						}
					});
					}
				});*/
				//setTimeout("location.href='confirmarDomicilio.php'",1500);
			}
			
		}
		});
	

	

	/*Swal.fire({
        position: 'center',
		inputPlaceholder: 'Ingrese Direccion',
        title: 'Direccion de Envio',
        input: 'text',
        showConfirmButton: true,
		showCancelButton: true,
        inputValue:calle,
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
			  calle:valueInt,
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
  });*/
}
