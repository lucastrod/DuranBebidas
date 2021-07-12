
    $(document).ready(function() {

        var direccion = $('#dir').data('id');
        
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
              var km = response.rows[0].elements[0].distance.value/1000;
              //document.getElementById("res").innerText =  response.rows[0].elements[0].distance.value/1000;
              
              $.ajax({
                            type:"POST",
                              url:"pasarEnvio.php",
                              data:{
                              km:km,
                              }
                        });
             
            });
          }
        });