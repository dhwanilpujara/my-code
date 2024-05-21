const geocoder = L.Control.Geocoder.nominatim();

// Create the search box element and add it to the map
const searchBox = document.getElementById('searchbarin');
searchBox.placeholder = "Search...";

// Add an event listener to the search box for user input
searchBox.addEventListener('input', function () {
    // Get the user's input text
    const query = searchBox.value;

    // Use the geocoder to search for locations based on the user's input
    geocoder.geocode(query, function (results) {
        if (results.length > 0) {
            // Get the first result and center the map on it
            const result = results[0];
            map.setView(result.center, 13);

            // Clear any previous markers and add a marker for the result
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            L.marker(result.center).addTo(map).bindPopup(result.name).openPopup();
        }
    });
});