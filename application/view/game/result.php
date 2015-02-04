<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoZoqIaXIJo2eLAtWPBBAh3XRQg49FFC4">
    </script>
  </head>
  <body>
  <div class="container">
    <div id="map-canvas" style="width:600px; height:600px; float:right;"></div>
      <script type="text/javascript">
            var photoLat = <?php echo (json_encode($this->game->latitude)); ?>;
            var photoLong = <?php echo (json_encode($this->game->longitude)); ?>;
            var geplmarkerLat = <?php echo (json_encode($_POST['inputLat'])); ?>;
            var geplmarkerLng = <?php echo (json_encode($_POST['inputLng'])); ?>;
          function initialize() {
            
            var photoLatlng = new google.maps.LatLng(photoLat,photoLong);
            var myLatlng = new google.maps.LatLng(geplmarkerLat,geplmarkerLng);
            var mapOptions = {
              zoom: 9,
              center: photoLatlng
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

            var marker = new google.maps.Marker({
                position: photoLatlng,
                map: map,
                title: 'Hello World!'
            });

            var marker2 = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: 'Hello World2!'
            });

           var flightPlanCoordinates = [
              new google.maps.LatLng(photoLat,photoLong),
              new google.maps.LatLng(geplmarkerLat,geplmarkerLng),
            ];
            var flightPath = new google.maps.Polyline({
              path: flightPlanCoordinates,
              geodesic: true,
              strokeColor: '#FF0000',
              strokeOpacity: 1.0,
              strokeWeight: 2
            });

            flightPath.setMap(map);
          }

          google.maps.event.addDomListener(window, 'load', initialize);

    </script>
        <h2>Aantal punten : <?php echo $this->points . ' ';?></h2>
    <img src="../images/<?php echo $this->game->filename?>" style="width:400px; margin-left: 5px; margin-right: auto;" />
  </div>
  </body>
</html>
