let marker;
function enableMarkerPlacement() {
    // Enable marker placement mode
    map.on('click', function(e) {
        // Remove any existing markers
        if (marker) {
            map.removeLayer(marker);
        }

        // Create a new marker at the clicked location
        marker = L.marker(e.latlng).addTo(map);

        // Update the latitude and longitude input fields
        const latitudeInput = document.querySelector('input[name="latitude"]');
        const longitudeInput = document.querySelector('input[name="longitude"]');
        latitudeInput.value = e.latlng.lat;
        longitudeInput.value = e.latlng.lng;
    });
}