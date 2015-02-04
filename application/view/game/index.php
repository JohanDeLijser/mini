<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoZoqIaXIJo2eLAtWPBBAh3XRQg49FFC4">
    </script>
  
    <script type="text/javascript">
      var map;
      var marker;
      function initialize() {
        var mapOptions = {
          zoom: 9
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

        // Try HTML5 geolocation
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
                                             position.coords.longitude);

            var infowindow = new google.maps.InfoWindow({
              map: map,
              position: pos,
              content: 'Your current location.'
            });

            map.setCenter(pos);
        }, function() {
            handleNoGeolocation(true);
        });
        } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }

            google.maps.event.addListener(map, 'click', function(event) {
               placeMarker(event.latLng);
            });

            function placeMarker(location) {
                if (!marker) {
                  marker = new google.maps.Marker({
                    position: location,
                    map: map
                  })
                  $("#guess").show();
                } else {
                  marker.setPosition(location);
                 
                }
                console.log(location);
                $("#inputLat").val(location['k']);
                $("#inputLng").val(location['D']);
            }
      }

      function handleNoGeolocation(errorFlag) {
        if (errorFlag) {
          var content = 'Error: The Geolocation service failed.';
        } else {
          var content = 'Error: Your browser doesn\'t support geolocation.';
        }

        var options = {
          map: map,
          position: new google.maps.LatLng(60, 105),
          content: content
        };

        var infowindow = new google.maps.InfoWindow(options);
        map.setCenter(options.position);
      }

      google.maps.event.addDomListener(window, 'load', initialize);

      
              
    </script>

  </head>
  <body>
  <div class="container">
    <div id="map-canvas" style="width:600px; height:600px; float:right;"></div>
   
      <form method="post" action="<?php echo URL . 'game/result'; ?>" >
        <input type="hidden" id="inputLat" name ="inputLat" />
        <input type="hidden" id="inputLng" name ="inputLng" />
        <input type="hidden" name="id" value="<?php echo $this->game->id;?>">
        <input type="submit" value="Raad de positie!" name="submit" style="display:none;" id="guess" />
      </form>
        
          <img src="../images/<?php echo $this->game->filename?>" style="width:400px; margin-left: 5px; margin-right: auto;" />

  </div>
  </body>
</html>
