<?php 
//session ko start karenge

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Route</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
    </head>
    <body>
        <div id="map"></div>
        <div id="routeforming">
            <form id="routingform">
                <div id="yourroute">
                    <input type="text" id="originid" placeholder="Origin..">
                </div>
                <div>
                    <input type="text" id="destinationid" placeholder="Destination..">
                </div>
                <div>
                    <input type="submit" id="destinationid" placeholder="Search for routes">
                </div>
            </form>
        </div>
        <script src="../scripter/map.js"></script>
    </body>
</html>
    