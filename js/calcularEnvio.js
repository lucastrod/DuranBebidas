
    function initMap(dir) {

    const bounds = new google.maps.LatLngBounds();
    
    // initialize services
    const geocoder = new google.maps.Geocoder();
    const service = new google.maps.DistanceMatrixService();
    // Datos del cliente
    const origin1 = {
      lat: -34.57882308284431,
      lng: -58.431455779050324
    };
    
    const destinationB = dir;

    const request = {
      origins: [origin1],
      destinations: [ destinationB],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false,
    };
    // put request on page
    document.getElementById("request").innerText = JSON.stringify(
      request,
      null,
      2
    );
    // get distance matrix response
    service.getDistanceMatrix(request).then((response) => {
      // put response
      document.getElementById("response").innerText = JSON.stringify(
        response,
        null,
        2
      );
      
    });
  }

  function getCostoEnvio(km){

      if (km<3) {
        //$200
      }

      if (km>3 && km<6) {
        //$400
      } 

      if (km>6 && km<10) {
        //$600
      } 

  }
