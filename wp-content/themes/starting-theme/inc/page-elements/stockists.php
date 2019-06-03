<div class="container-fluid stockists">
    <h2>find a stockist</h2>
    <p>Dtias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil imp.</p>
  <div class="row stockists_locations clear">
    <div class="col-xs-6 col-md-3 matchheight">
      <h4>UK <span>&</span> Ireland</h4>
      <p>United Kingdom & Ireland</p>

      <button type="button" data-toggle="collapse" data-target="#collapseUK" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

    </div>
    <div class="col-xs-6 col-md-3 matchheight">
      <h4>EU</h4>
      <p>European Union</p>

      <button type="button" data-toggle="collapse" data-target="#collapseEU" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

    </div>
    <div class="col-xs-6 col-md-3 matchheight">
      <h4>USA</h4>
      <p>United States of America</p>
      <button type="button" data-toggle="collapse" data-target="#collapseUS" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>
    </div>
    <div class="col-xs-6 col-md-3 matchheight">
      <h4>Rest <span>of</span> World</h4>
      <p>Rest of the World</p>
      <button type="button" data-toggle="collapse" data-target="#collapseROW" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>
    </div>

  </div>

  <div class="collapse" id="collapseUK">
    <div class="row">
      <div class="stockists_locations">

        <label>Search your Town or Postcode</label>
        <input class="controls" type="text" placeholder="Search your Town or Postcode">

      </div>
    </div>
  </div>







  <div class="collapse" id="collapseEU">
    <div class="row">
      <div class="stockists_locations">
        <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
        <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>

  <div class="collapse" id="collapseUS">
    <div class="row">
      <div class="stockists_locations">
        <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
        <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>

  <div class="collapse" id="collapseROW">
    <div class="row">
      <div class="stockists_locations">
        <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
        <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>

</div>

<div id="map"></div>
<script>
  // This example adds a search box to a map, using the Google Place Autocomplete
  // feature. People can enter geographical searches. The search box will return a
  // pick list containing a mix of places and predicted search terms.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initMap() {
  var sydney = new google.maps.LatLng(-33.867, 151.195);

  infowindow = new google.maps.InfoWindow();

  map = new google.maps.Map(
      document.getElementById('map'), {center: sydney, zoom: 15});

  var request = {
    query: 'Museum of Contemporary Art Australia',
    fields: ['name', 'geometry'],
  };

  var service = new google.maps.places.PlacesService(map);

  service.findPlaceFromQuery(request, function(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }
      map.setCenter(results[0].geometry.location);
    }
  });
}

  function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13,
      mapTypeId: 'roadmap'
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEgmXmc6iIdAgHKm9DzbYS-40OEwPefRw&libraries=places&callback=initAutocomplete" async defer></script>
