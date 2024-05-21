var map = L.map('map').setView([28.6139, 77.2090], 12);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);


//LIve location program
function tracklivelocation(){
if (map) { 
        map.locate({ setView: true, maxZoom: 16 });
        
    } else {
        console.error("Map is not defined.");
    }

function onLocationFound(e) {
    var radius = e.accuracy;

    L.marker(e.latlng).addTo(map)
        .bindPopup("You are within " + radius + " meters from this point").openPopup();

    L.circle(e.latlng, radius).addTo(map);
}

map.on('locationfound', onLocationFound);


function onLocationError(e) {
    alert(e.message);
}

map.on('locationerror', onLocationError);
}



// //this for button section
// const geocoder = L.Control.Geocoder.nominatim();

// // Create the search box element and add it to the map
// const searchBox = document.getElementById('searchbarin');
// searchBox.placeholder = "Search...";

// // Add an event listener to the search box for user input
// searchBox.addEventListener('input', function () {
//     // Get the user's input text
//     const query = searchBox.value;

//     // Use the geocoder to search for locations based on the user's input
//     geocoder.geocode(query, function (results) {
//         if (results.length > 0) {
//             // Get the first result and center the map on it
//             const result = results[0];
//             map.setView(result.center, 13);

//             // Clear any previous markers and add a marker for the result
//             map.eachLayer(function (layer) {
//                 if (layer instanceof L.Marker) {
//                     map.removeLayer(layer);
//                 }
//             });

//             L.marker(result.center).addTo(map).bindPopup(result.name).openPopup();
//         }
//     });
// });


// document.getElementById('routingform').addEventListener('submit', function (e) {
//     e.preventDefault(); 
    
//     var startLocation = document.getElementById('originid').value;
//     var endLocation = document.getElementById('destinationid').value;

    
//     geocodeLocation(startLocation, function (startCoordinates) {
//         geocodeLocation(endLocation, function (endCoordinates) {
            
//             routingControl.setWaypoints([
//                 L.latLng(startCoordinates),
//                 L.latLng(endCoordinates)
//             ]);
//         });
//     });
// });


// function geocodeLocation(location, callback) {
//     var nominatimUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(location);

//     fetch(nominatimUrl)
//         .then(function (response) {
//             return response.json();
//         })
//         .then(function (data) {
//             if (data && data.length > 0) {
                
//                 var lat = parseFloat(data[0].lat);
//                 var lon = parseFloat(data[0].lon);
//                 callback([lat, lon]);
//             } else {
//                 console.log('Location not found');
//             }
//         })
//         .catch(function (error) {
//             console.error('Error geocoding location:', error);
//         });
// }
