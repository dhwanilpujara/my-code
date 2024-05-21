// Initialize the map
var map = L.map('map');

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Declare the marker variable without setting a specific location
var marker;

var markersLayer = new L.LayerGroup().addTo(map);

// Function to get the user's actual location and track it
function trackLiveLocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var newLat = position.coords.latitude;
            var newLng = position.coords.longitude;

            // Create the marker if it doesn't exist
            if (!marker) {
                marker = L.marker([newLat, newLng]).addTo(map);
                map.setView([newLat, newLng], 13); // Set the map view when the marker is created
            } else {
                // Update the marker's position
                marker.setLatLng([newLat, newLng]);
            }
        }, function(error) {
            // Handle geolocation error
            console.error('Error getting geolocation:', error);
        });
    } else {
        alert("Geolocation is not available in your browser.");
    }
}

// Call the tracking function when the page loads
window.onload = function() {
    trackLiveLocation();
};
