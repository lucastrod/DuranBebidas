$(document).ready(function() {

    var direccion = $('#dir').data('id');
    var error = $('#err').data('id');
    var email = $('#ema').data('id');
    var clave = $('#cla').data('id');
    var usuario = $('#usu').data('id');
    var nombre = $('#nom').data('id');
    var calle = $('#cal').data('id');
    var numero = $('#num').data('id');
    var telefono = $('#tel').data('id');
    var piso_depto = $('#pis').data('id');
    var apellido = $('#ape').data('id');
    
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
          
            var domicilioDestino = response.destinationAddresses[0];

            if(domicilioDestino == 'Buenos Aires, CABA, Argentina'){
              setTimeout("location.href='registro.php?domicilio=error'",1000);
            }
            else{

                if(error ==''){

                    $.ajax({
                        type: "POST",
                        url: "./guardarRegistro.php",
                        data:{
                          email:email,
                          clave:clave,
                          usuario:usuario,
                          nombre:nombre,
                          apellido:apellido,
                          calle:calle,
                          numero:numero,
                          telefono:telefono,
                          piso_depto:piso_depto
                        },
                        success: function(data) {  
                            var mensaje = "Para terminar el proceso de registro debe seguir las instrucciones que le enviamos a la direccion de correo electronico: " + email;
                            
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                //title: 'Registro Correcto',
                                html: '<h1>Registro Correcto</h1>'+'<br>'+'<p style="font-size:16px;">'+mensaje+'</p>',
                                showConfirmButton: true,
                                //timer: 3500,
                                width: '600px',
                                //confirmButtonClass:'modal5',
                                confirmButtonColor:'green',
                                confirmButtonText:'Entendido',
                            }); 
                        }
                    });
                    
                
                }
            }
         
        });
      }
    });