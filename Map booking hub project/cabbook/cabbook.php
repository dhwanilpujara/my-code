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
        <title>Cab Booking</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
    </head>
    <body>
        <div id="map"></div>
        <div id = "cabformfilter">
        <form method="get" action="filter_results.php">
        <label for="vehicle">Vehicle:</label>
        <select name="vehicle" id="vehicle">
            <option value="two_wheeler">Two Wheeler</option>
            <option value="three_wheeler">Three Wheeler</option>
            <option value="four_wheeler">Four Wheeler</option>
        </select>
        <br>

        <label for="sub_part">Sub Part:</label>
        <select name="sub_part" id="sub_part">
            <option value="bike">Bike</option>
            <option value="cycle">Cycle</option>
            <option value="mountain_bike">Mountain Bike</option>
            <option value="autorickshaw">Autorickshaw</option>
            <option value="e_rickshaw">E-Rickshaw</option>
            <option value="mini_car">Mini Car (1-3 passengers)</option>
            <option value="sedan">Sedan (1-3 passengers)</option>
            <option value="suv">SUV (1-7 passengers)</option>
        </select>
        <br>

        <label for="fuel">Fuel:</label>
        <select name="fuel" id="fuel">
            <option value="petrol">Petrol</option>
            <option value="diesel">Diesel</option>
            <option value="ev">Electric Vehicle (EV)</option>
            <option value="cng">Compressed Natural Gas (CNG)</option>
        </select>
        <br>

        <label for="passengers">No. of Passengers:</label>
        <input type="number" name="passengers" id="passengers" min="1" max="15">
        <br>

        <input type="submit" value="Apply Filter">
    </form>
    </div>
        <script src="../scripter/map.js"></script>
    </body>
</html>
    