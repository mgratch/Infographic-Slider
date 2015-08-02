jQuery(window).load(function( $ ) {

    var $ = jQuery;
    var mapContainer = $(".stellar-places-map-canvas");
    var mapData = mapContainer.data();
    var map = mapData.map;
    var mapBounds = mapData.mapBounds;
    var locations = mapData.stellarPlacesMapLocations;
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

    if (w < 801){
        $.each(locations, function(i,location){

            var infoWindow = location.marker.infoWindow;

            google.maps.event.addListener(infoWindow,'closeclick',function(){
                map.setCenter(mapBounds.getCenter());
            });

        });

        map.setOptions({draggable: false});

    }
});