<?php
  $endereco = carregaEndereco($_POST['endereco']);
?>
  <script>
    function initMap() {
      var directionsService = new google.maps.DirectionsService;
      var directionsDisplay = new google.maps.DirectionsRenderer;
      /*var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: {lat: 41.85, lng: -87.65}
      });
      directionsDisplay.setMap(map);
      */
      window.addEventListener('load', function() {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
      var waypts = [];
      //var checkboxArray = ['Rua Limites, 1896 - Realengo, Rio de Janeiro - RJ, Brasil'];
          waypts.push({
            location: '<?=$endereco?>',
            stopover: true
          });
      directionsService.route({
        origin: "Rua Feira Nova, 8 - Realengo, Rio de Janeiro - RJ, Brasil",
        destination: "Rua Feira Nova, 8 - Realengo, Rio de Janeiro - RJ, Brasil",
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: 'DRIVING'
      }, function(response, status) {
        if (status === 'OK') {
          directionsDisplay.setDirections(response);
          var route = response.routes[0];
          var distanciaTotal = 0;
          //var summaryPanel = document.getElementById('directions-panel');
          //summaryPanel.innerHTML = '';
          // For each route, display summary information.
          for (var i = 0; i < route.legs.length; i++) {
            var routeSegment = i + 1;
            //window.alert(route.legs[i].start_address);
            var str = route.legs[i].distance.text;
            distanciaTotal += parseFloat(str.replace(",","."));
          }
          var km = 8;
          var gasolina = 4.79;
          var calculo = parseFloat(distanciaTotal) / parseFloat(km);
          var custo = parseFloat(calculo) * parseFloat(gasolina); 
          //alert(custo.toFixed(2).replace(".",","));
          var strTotal = distanciaTotal.toFixed(2); 
          var res = strTotal.replace(".", ",");
          //alert(custo.toFixed(2).replace(".",","));
          var custoTotal = custo.toFixed(2).replace(".",",");
          return custoTotal;
          <?php
            return '<script>document.write(custoTotal)</script>';
          ?>
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    }
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap&language=pt&region=BR">
  </script>
 