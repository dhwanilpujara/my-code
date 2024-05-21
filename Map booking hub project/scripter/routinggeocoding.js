document.getElementById('routingform').addEventListener('submit', function (e) {
    e.preventDefault(); 
    
    var startLocation = document.getElementById('originid').value;
    var endLocation = document.getElementById('destinationid').value;

    
    geocodeLocation(startLocation, function (startCoordinates) {
        geocodeLocation(endLocation, function (endCoordinates) {
            
            routingControl.setWaypoints([
                L.latLng(startCoordinates),
                L.latLng(endCoordinates)
            ]);
        });
    });
});


function geocodeLocation(location, callback) {
    var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(location);

    fetch(nominatimUrl)
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data && data.length > 0) {
                
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);
                callback([lat, lon]);
            } else {
                console.log('Location not found');
            }
        })
        .catch(function (error) {
            console.error('Error geocoding location:', error);
        });
}
