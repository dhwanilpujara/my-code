<!DOCTYPE html>
<html>
<head>
    <title>Meeting Point Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
</head>
<body>
    <div id="map"><script src="../scripter/map.js"></script></div>
    <div id="formforprivatespace" style="z-index: 1; position: absolute; top: 50px; left: 20px; width: 300px; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
        <h2>Create a Private Space</h2>
        <input type="text" id="createSpaceName" placeholder="Space Name">
        <input type="text" id="createAccessCode" placeholder="Access Code">
        <button id="createSpaceButton">Create Space</button>
        <button id="destroySpace" style="display: none;">Destroy Space</button>
        <h2>Join a Private Space</h2>
        <input type="text" id="joinSpaceName" placeholder="Space Name">
        <input type="text" id="joinAccessCode" placeholder="Access Code">
        <button id="joinSpaceButton">Join Space</button>
        <button id="leaveSpace" style="display: none;">Leave Space</button>
    </div>
    <div class="livelocate">
    <button onclick="trackLiveLocation()">Live</button>
    </div>
    <div id="spaceInfo" style="z-index: 1; position: absolute; top: 10px; right: 10px; display: none;"></div>
    <script>
        var privateSpace = null;
        var userMarker = null;
        var usersInSpace = []; // List of users in the private space

        document.getElementById('createSpaceButton').addEventListener('click', function () {
            var spaceName = document.getElementById('createSpaceName').value;
            var accessCode = document.getElementById('createAccessCode').value;
            var meetingPoint = map.getCenter();

            privateSpace = {
                name: spaceName,
                accessCode: accessCode,
                meetingPoint: meetingPoint,
                users: []
            };

            document.getElementById('formforprivatespace').style.display = 'none';
            document.getElementById('spaceInfo').style.display = 'block';
            document.getElementById('destroySpace').style.display = 'block';

            document.getElementById('spaceInfo').innerHTML = `Space Name: ${spaceName}<br>Access Code: ${accessCode}`;

            userMarker = L.marker(meetingPoint).addTo(map);
            userMarker.bindPopup("Your Location").openPopup();
            trackLiveLocation();
            setInterval(trackLiveLocation, 5000);
        });

        document.getElementById('joinSpaceButton').addEventListener('click', function () {
            var joinSpaceName = document.getElementById('joinSpaceName').value;
            var joinAccessCode = document.getElementById('joinAccessCode').value;
            if (privateSpace && joinSpaceName === privateSpace.name && joinAccessCode === privateSpace.accessCode) {
                var userMeetingPoint = privateSpace.meetingPoint;
                var newUserMarker = L.marker(userMeetingPoint).addTo(map);
                newUserMarker.bindPopup("User's Location at " + privateSpace.name).openPopup();

                // Add the new user to the list of users in the private space
                usersInSpace.push(newUserMarker);

                document.getElementById('formforprivatespace').style.display = 'none';
                document.getElementById('spaceInfo').style.display = 'block';
                document.getElementById('leaveSpace').style display = 'block';
                
                trackLiveLocation();
                setInterval(trackLiveLocation, 5000);
            } else {
                alert("Access code is incorrect. You cannot join the private space.");
            }
        });

        document.getElementById('destroySpace').addEventListener('click', function () {
            privateSpace = null;
            if (userMarker) {
                map.removeLayer(userMarker);
            }

            // Remove all users from the private space
            for (var i = 0; i < usersInSpace.length; i++) {
                map.removeLayer(usersInSpace[i]);
            }
            usersInSpace = [];

            document.getElementById('spaceInfo').innerHTML = "";
            document.getElementById('spaceInfo').style.display = 'none';
            document.getElementById('destroySpace').style.display = 'none';
            document.getElementById('formforprivatespace').style.display = 'block';
        });

        document.getElementById('leaveSpace').addEventListener('click', function () {
            if (userMarker) {
                map.removeLayer(userMarker);
            }

            // Remove the user from the list of users in the private space
            var userIndex = usersInSpace.indexOf(userMarker);
            if (userIndex !== -1) {
                usersInSpace.splice(userIndex, 1);
            }

            document.getElementById('spaceInfo').style.display = 'none';
            document.getElementById('leaveSpace').style.display = 'none';
            document.getElementById('formforprivatespace').style.display = 'block';
        });

        function trackLiveLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.watchPosition(function(position) {
                    var newLat = position.coords.latitude;
                    var newLng = position.coords.longitude;
                    if (userMarker) {
                        userMarker.setLatLng([newLat, newLng]);
                    }

                    // Update the location of all users in the private space
                    for (var i = 0; i < usersInSpace.length; i++) {
                        usersInSpace[i].setLatLng([newLat, newLng]);
                    }
                }, function(error) {
                    console.error('Error getting geolocation:', error);
                });
            } else {
                alert("Geolocation is not available in your browser.");
            }
        }
    </script>
    <script src="../scripter/livetrack.js"></script>
</body>
</html>
