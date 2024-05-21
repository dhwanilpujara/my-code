<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Map Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>

</head>
<body>
    <div id="map"></div>
    <div id="search-bar">
        <input type="text" id="searchbarin" placeholder="Search...">
    </div>
    <div class="nav-buttons">
        <button onclick="redirectToHome()">Home</button>
        <button onclick="redirectToHotelBooking()">Hotel Booking</button>
        <button onclick="redirectToRestaurantBooking()">Restaurant Booking</button>
        <!--<button><a href="/CabBooking">Cab Booking</a></button>-->
        <button onclick="redirectToMeetpoint()">MeetingPoint</button>
        <button onclick="redirectToEmergency()">Emergency</button>
        <button onclick="redirectToAboutUs()">About Us</button>
    </div>
    <div class="user-actions">
        <?php if((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){?>
        <button onclick="redirectToProfile()">Profile</button>
        <button onclick="redirectToLogout()">LogOut</button>
        <?php }else{ ?>
        <button onclick="redirectToLogin()">Login</button>
        <button onclick="redirectToSignUp()">SignUp</button>
        <?php }?>
    </div>
    <div class="livelocate">
        <button onclick="tracklivelocation()">Live</button>
    </div>
    <script src="../scripter/map.js"></script>
    <script src="../scripter/scripts.js"></script>
    <script src="../scripter/routinggeocoding.js"></script>
    <script src="../scripter/searchbar.js"></script>
</body>
</html>