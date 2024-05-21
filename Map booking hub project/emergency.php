<?php
// require_once $_SERVER['DOCUMENT_ROOT']."../private/config.php";

// // Check if latitude and longitude data is received
// if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
//     // Code to insert the received location data into the database
//     $latitude = $_POST['latitude'];
//     $longitude = $_POST['longitude'];
//     $sql = "INSERT INTO emergencylocation (latitude, longitude) VALUES ('$latitude', '$longitude')";
//     $stmt = $link->prepare($sql);
//     $stmt->execute([
//         ':latitude' => $latitude,
//         ':longitude' => $longitude
//     ]);

//     $response = ['message' => 'Location data received and stored.'];
//     header('Content-Type: application/json');
//     echo json_encode($response);
//     exit();
// } else {
//     $response = ['error' => 'Latitude and longitude data not provided.'];
//     header('Content-Type: application/json');
//     echo json_encode($response);
//     exit();
// }
 ?>



<!DOCTYPE html>
<html>
    <head>
        <title>Emergency</title>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
    </head>
    <body>
        <div id="map"></div>
        <div class="livelocate">
            <button onclick="sendEmergencyMessage()">Emergency</button>
        </div>
        <script>
            function sendEmergencyMessage() {
                // Get user's current location
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        // Send the location to the server for insertion
                        sendLocationToServer(latitude, longitude, function(response) {
                            // Handle the server response
                            if (response.error) {
                                console.error('Error inserting location:', response.error);
                            } else {
                                console.log('Location inserted:', response.message);

                                // After successful insertion, update location from server
                                updateLocationFromServer();
                            }
                        });
                    }, function(error) {
                        console.error('Error getting geolocation:', error);
                    });
                } else {
                    alert("Geolocation is not available in your browser.");
                }
            }

            function sendLocationToServer(latitude, longitude, callback) {
                // Send the location to the server using an AJAX request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/emergency.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        callback(response);
                    } else {
                        console.error('Error inserting location:', xhr.status);
                        callback({ error: 'Failed to insert location data.' });
                    }
                };

                xhr.send('latitude=' + latitude + '&longitude=' + longitude);
            }

            function updateLocationFromServer() {
                // Fetch the latest location data from the server using an AJAX request
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/get_latest_location.php', true);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        if (data.latitude && data.longitude) {
                            // Clear existing markers
                            markersLayer.clearLayers();
                            // Create a marker and add it to the map
                            var marker = L.marker([data.latitude, data.longitude]);
                            markersLayer.addLayer(marker);
                        }
                    }
                };

                xhr.send();
            }

            // Poll the server for location updates every 5 seconds
            setInterval(updateLocationFromServer, 5000);
        </script>
        <script src="../scripter/livetrack.js"></script>
    </body>
</html>
