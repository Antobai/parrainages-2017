@extends('layouts.app')
@section('content')
    <form method="get" action="{{ url('/search') }}">
        <div class="form-group">
            <div class="row">
                <div class="col-xs-10" style="padding-right:0;">
                    <input type="search" class="form-control input-lg" name="query" id="query" placeholder="Parrains, communes, régions, départements">
                </div>
                <div class="col-xs-1" style="padding-left:4px;">
                    <button type="submit" class="btn btn-default btn-lg btn-success"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <hr />
    <div>
        <select id="candidatSelect" class="form-control input-lg">
            <option selected="true" disabled="disabled">Choisissez un candidat</option>
            @foreach ($candidats as $candidat)
                <option class="candidat" data-id="{{$candidat->id}}" value="">{{$candidat->nom}} {{$candidat->prenom}} ({{$candidat->count}} parrains)</option>
            @endforeach
        </select>

    </div>

    <hr />
    <!--
    <div id="mapid" style="width:100%;height:60vh;border:5px solid #eee;"></div>
    -->

@endsection

@section('after_js')
<script>
  // liste déroulante
  $(function() {
      $("#candidatSelect").on("click",function(e) {
          console.log($(e.target));
          if($(e.target).hasClass("candidat")) {
              window.location.href = "/candidat/"+$(e.target).attr("data-id");
          }
      });
  })

  function getLocation() {
      if (navigator.geolocation) {
          console.log(navigator.geolocation.getCurrentPosition(showPosition,error));
      } else {
          x.innerHTML = "Geolocation is not supported by this browser.";
      }
  }

  function error(position) {
      console.log(position);
  }


  function showPosition(position) {
      var table = [position.coords.latitude, position.coords.longitude];
      return position.coords.latitude;
  }

  console.log(getLocation());



  /*affichage de la map et définition du point d'arrivée sur la carte*/
  var mymap = L.map('mapid').setView([47.221299, 5.967714], 15);
  /*type de "tiles" pour la map, on peut en changer (skin)*/  L.tileLayer('https://api.mapbox.com/styles/v1/benoitm/ciy5sprke005d2rpb6dxry2ah/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYmVub2l0bSIsImEiOiJjaXk1c24ycGYwMDJwMzNyamhmaXc2dTNnIn0.065FxCTP4WiqVfnlubCMmA', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
      '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  id: 'mapbox.streets'
  }).addTo(mymap);

  var marker = L.marker([47.221299, 5.967714]).addTo(mymap);
  marker.bindPopup("<b>CAEM Besançon</b><br>13 A avenue Ile-de-France<br>25000 Besançon").openPopup();


  function onEachFeature(feature, layer) {
      // does this feature have a property named popupContent?
      if (feature.properties && feature.properties.popupContent) {
          layer.bindPopup(feature.properties.popupContent);
      }
  }

  var geojsonFeature = {
      "type": "Feature",
      "properties": {
          "name": "Coors Field",
          "amenity": "Baseball Stadium",
          "popupContent": "test"
      },
      "geometry": {
          "type":"Polygon","coordinates":[[[5.7898561171937,47.217783416315],[5.8018976023638,47.222105083269],[5.7894071390041,47.231303962729],[5.8145623477838,47.234960246055],[5.8182321144323,47.228366103799],[5.809915546802,47.221413634353],[5.7960645602508,47.217392312962],[5.7898561171937,47.217783416315]]]
      }
  };

  L.geoJSON(geojsonFeature, {
      onEachFeature: onEachFeature
  }).addTo(mymap);

</script>
@endsection
