function initialize() {
    var mapOptions = {
        center: { lat: 2.6056, lng: 98.8097 },
        zoom: 9
    };
    map = new google.maps.Map(document.getElementById('map'),
        mapOptions);
}
google.maps.event.addDomListener(window, 'load', initialize);