<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve user input from the form
    $hotel_name = $_POST['hotel_name'];
    $floor = $_POST['floor'];
    $room = $_POST['room'];
    $beds = $_POST['beds'];
    $washroom_style = $_POST['washroom_style'];
    $address_line_1 = $_POST['address_line_1'];
    $address_line_2 = $_POST['address_line_2'];
    $address_line_3 = $_POST['address_line_3'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $country = $_POST['country'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $price_2_bed = $_POST['price_2_bed'];
    $mobile_number = $_POST['mobile_number'];
    
    // SQL query to insert data into the table
    $sql = "INSERT INTO hotel (hotel_name, floor, room, beds, washroom_style, address_line_1, address_line_2, address_line_3, district, pincode, country, latitude, longitude, price_2_bed, mobile_number) VALUES ('$hotel_name', '$floor', '$room', '$beds', '$washroom_style', '$address_line_1', '$address_line_2', '$address_line_3', '$district', '$pincode', '$country', '$latitude', '$longitude', '$price_2_bed', '$mobile_number')";
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
    if ($link->query($sql) === TRUE) {
        echo "Record inserted successfully.";
        header("Location: ");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}

$link->close();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hotel Booking</title>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/multiform.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
    </head>
    <body>
        <div id="map">
            <script src="../scripter/map.js"></script>
        </div>
    <!--    <div id="hotelform" style="z-index: 1; position: absolute; top: 50px; left: 20px; width: 300px; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">-->
    <!--    <form method="post" id="hotelbookform">-->
    <!--    <div class="slide" id="slide1">-->
    <!--        <h2>Step 1: Hotel Info</h2>-->
    <!--            <label>Hotel Name:</label>-->
    <!--            <input type="text" name="hotel_name" required/><br>-->

    <!--            <label>Floor:</label>-->
    <!--            <input type="number" name="floor" required/><br>-->
                
    <!--            <label>Room:</label>-->
    <!--            <input type="number" name="room" required/><br>-->

    <!--            <label>Beds:</label>-->
    <!--            <input type="number" name="beds" required/><br>-->

    <!--            <label>Washroom Style:</label>-->
    <!--            <select name="washroom_style" required>-->
    <!--                <option value="Western">Western</option>-->
    <!--                <option value="Indian">Indian</option>-->
    <!--                <option value="Both">Both</option>-->
    <!--            </select><br>-->
    <!--        <button onclick="showSlide('slide2')" data-slide="slide2" >Next</button>-->
    <!--    </div>-->
    <!--    <div class="slide" id="slide2" style="display: none;">-->
    <!--        <h2>Step 2: Hotel Address</h2>-->
    <!--            <label>Address Line1 :</label>-->
    <!--            <input type="text" name="address_line_1" required/><br>-->
                
    <!--            <label>Address Line2 :</label>-->
    <!--            <input type="text" name="address_line_2" required/><br>-->
                
    <!--            <label>Address Line3 :</label>-->
    <!--            <input type="text" name="address_line_3" required/><br>-->
                
    <!--            <label>District :</label>-->
    <!--            <input type="text" name="district" required/><br>-->
                
    <!--            <label>PinCode :</label>-->
    <!--            <input type="text" name="pincode" required/><br>-->
                
    <!--            <label>Country :</label>-->
    <!--            <input type="text" name="country" required/><br>-->
                

                <!--<label>Latitude:</label>-->
                <!--<input type="text" name="latitude" required><br>-->

                <!--<label>Longitude:</label>-->
                <!--<input type="text" name="longitude" required><br>-->
                
                <!--<button id="UseMarker" onclick="enableMarkerPlacement()">Use Marker</button>-->

    <!--        <button onclick="showSlide('slide3')" data-slide="slide3">Next</button>-->
    <!--        <button onclick="showSlide('slide1')" data-slide="slide1">Back</button>-->
    <!--    </div>-->
    <!--    <div class="slide" id="slide3" style="display: none;">-->
    <!--        <h2>Step 2: Hotel Address</h2>-->
    <!--            <input type="text" name="latitude" required/><br>-->
    
    <!--            <label>Longitude:</label>-->
    <!--            <label>Latitude:</label>-->
    <!--            <input type="text" name="longitude" required/><br>-->
                
    <!--            <button id="UseMarker" onclick="enableMarkerPlacement()">Use Marker</button>-->
    <!--        <button onclick="showSlide('slide4')" data-slide="slide4">Next</button>-->
    <!--        <button onclick="showSlide('slide2')" data-slide="slide2">Back</button>-->
    <!--    </div>-->
    <!--    <div class="slide" id="slide4" style="display: none;">-->
    <!--        <h2>Step 4: Hotel Price</h2>-->
    <!--            <label>2-Bed Per Room Price:</label>-->
    <!--            <input type="number" step="0.01" name="price_2_bed" id="price_2_bed" required/>-->
    <!--            <button type="button" onclick="adjustPrice('price_2_bed', 0.01)">+</button>-->
    <!--            <button type="button" onclick="adjustPrice('price_2_bed', -0.01)">-</button><br>-->
                
    <!--            <label>4-Bed Per Room Price:</label>-->
    <!--            <input type="number" step="0.01" name="price_4_bed" id="price_4_bed" required/>-->
    <!--            <button type="button" onclick="adjustPrice('price_4_bed', 0.01)">+</button>-->
    <!--            <button type="button" onclick="adjustPrice('price_4_bed', -0.01)">-</button><br>-->
                
    <!--            <label>6-Bed Per Room Price:</label>-->
    <!--            <input type="number" step="0.01" name="price_6_bed" id="price_6_bed" required/>-->
    <!--            <button type="button" onclick="adjustPrice('price_6_bed', 0.01)">+</button>-->
    <!--            <button type="button" onclick="adjustPrice('price_6_bed', -0.01)">-</button><br>-->
                
    <!--            <label>8-Bed Per Room Price:</label>-->
    <!--            <input type="number" step="0.01" name="price_8_bed" id="price_8_bed" required/>-->
    <!--            <button type="button" onclick="adjustPrice('price_8_bed', 0.01)">+</button>-->
    <!--            <button type="button" onclick="adjustPrice('price_8_bed', -0.01)">-</button><br>-->
                
    <!--            <label>12-Bed Per Room Price:</label>-->
    <!--            <input type="number" step="0.01" name="price_12_bed" id="price_12_bed" required/>-->
    <!--            <button type="button" onclick="adjustPrice('price_12_bed', 0.01)">+</button>-->
    <!--            <button type="button" onclick="adjustPrice('price_12_bed', -0.01)">-</button><br>-->
                
    <!--        <button onclick="showSlide('slide5')" data-slide="slide5">Next</button>-->
    <!--        <button onclick="showSlide('slide3')" data-slide="slide3">Back</button>-->
    <!--    </div>-->
    <!--    <div class="slide" id="slide5" style="display: none;">-->
    <!--        <h2>Step 5: Hotel Bank</h2>-->
    <!--            <label>Mobile Number:</label>-->
    <!--            <input type="text" name="mobile_number" required/><br>-->
    
    <!--            <label>Account Number:</label>-->
    <!--            <input type="text" name="account_number" required/><br>-->
    <!--        <button onclick="showSlide('slide4')" data-slide="slide4">Back</button>-->
    <!--        <button type="submit" name="deployHotel">Deploy Hotel</button>-->
    <!--    </div>-->
    <!--    </form>-->
    <!--</div>-->
    <section>
    <div class="container" style="z-index: 1; position: absolute; top: 50px; left: 20px; width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
        <form method="POST">
            <div class="step step-1 active">
                <div class="form-group">
                    <label for="hotel_name">Hotel Name</label>
                    <input type="text" id="hotel_name" name="hotel_name" />
                </div>
                <div class="form-group">
                    <label for="floor">Floors:</label>
                    <input type="number" id="floor" name="floor" />
                </div>
                <div class="form-group">
                    <label for="room">Rooms:</label>
                    <input type="number" id="room" name="room" />
                </div>
                <div class="form-group">
                    <label for="beds">Beds</label>
                    <input type="number" id="beds" name="beds" />
                </div>
                <div class="form-group">
                <label for="washroom">Washroom Style:</label>
                <select id="washroom" name="washroom_style">
                    <option value="Western">Western</option>
                    <option value="Indian">Indian</option>
                    <option value="Both">Both</option>
                </select><br>
                </div>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-2">
                <div class="form-group">
                    <label for="email">Address Line 1</label>
                    <input type="text" id="email" name="address_line_1" />
                </div>
                <div class="form-group">
                    <label for="email">Address Line 2</label>
                    <input type="text" id="email" name="address_line_2" />
                </div>
                <div class="form-group">
                    <label for="email">Address Line 3</label>
                    <input type="text" id="email" name="address_line_3" />
                </div>
                <div class="form-group">
                    <label for="country">country</label>
                    <input type="text" id="country" name="country" />
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="district" />
                </div>
                <div class="form-group">
                    <label for="postCode">Post Code</label>
                    <input type="text" id="postCode" name="pincode" />
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-3">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="mobile_number" />
                </div>
                <div class="form-group">
                    <label>Price of bed:</label>
                    <input type="number" step="0.01" name="price_2_bed" id="price_2_bed"/>
                    <button type="button" onclick="adjustPrice('price_2_bed', 0.01)">+</button>
                    <button type="button" onclick="adjustPrice('price_2_bed', -0.01)">-</button><br>
                </div>
                <div class="form-group">
                <label>Latitude:</label>
                <input type="text" name="latitude" /><br>
                
                <label>Longitude:</label>
                <input type="text" name="longitude" /><br>
                
                <button type="button" id="UseMarker" onclick="enableMarkerPlacement()">Use Marker</button>
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Deploy</button>
            </div>
            <div class="step step-4">
                <button type="submit" class="submit-btn">Hotel Deployed</button>
            </div>
        </form>
    </div>
</section>
    <script src="../scripter/hotelservicescript.js">
    </script>
    <script src="../scripter/pointer.js">
        
    </script>
    </body>
</html>