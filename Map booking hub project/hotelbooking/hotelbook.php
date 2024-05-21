<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pricerange']) && isset($_GET['beds'])) {
    $pricerange = $_GET['pricerange'];
    $beds = $_GET['beds'];
// Prepare and execute the SQL query to select hotels based on the filter criteria
$query = "SELECT * FROM hotel WHERE price_2_bed <= ? AND beds >= ?";

$stmt = $link->prepare($query);
$stmt->bind_param("ii", $pricerange, $beds); // 'ii' indicates two integer parameters
$stmt->execute();

if ($stmt->errno) {
    http_response_code(500);
        $errorResponse = ["error" => "Database error: " . $stmt->error];
        echo json_encode($errorResponse);
    } else {

// Get the result set
$result = $stmt->get_result();

// Fetch the results into an array
$hotels = array();
while ($row = $result->fetch_assoc()) {
    array_push($hotels, $row);
}

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($hotels);
exit();
}
// Close the database connection
$stmt->close();
$link->close();
}else {
    // Handle the case when the parameters are not provided, e.g., display a message or return an empty result.
    echo json_encode([]);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hotel Booking</title>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div id="map">
            <script src="../scripter/map.js"></script>
        </div>
        <div id="hotelform" style="z-index: 1; position: absolute; top: 50px; left: 20px; width: 300px; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
        <h2>Hotel Filters</h2>
            <form id="filterForm" method="GET">
                <label for="pricerange">Price Range:</label>
                <input type="range" id="pricerange" name="pricerange" min="50" max="8000" step="10" value="50" oninput="updatePriceValue()">
                <span id="priceValue" type="number">50</span>
                <br><br>
                <label for="beds">Number of Beds per Room:</label>
                <input type="number" id="beds" name="beds" min="1" max="5">
                <br><br>
                <label>Distance:</label>
                <input type="radio" id="nearMe" name="distance" value="near">Near Me
                <input type="radio" id="anywhere" name="distance" value="anywhere" checked>Anywhere
                <br><br>
                <button type="button" onclick="findHotels()">Apply Filter</button>
            </form>
    </div>
    <div id="results">
    <!-- Filtered hotel results will be displayed here -->
</div>
<div class="modal fade" id="hotelModal" tabindex="-1" role="dialog" aria-labelledby="hotelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hotelModalLabel">Hotel Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Display hotel details here -->
        <div id="hotelDetails"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="payButton" onclick="redirectToPay()">PROCEED</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!--<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>-->

    <script>
    function updatePriceValue() {
    const pricerange = document.getElementById("pricerange").value;
    const priceValue = document.getElementById("priceValue");
    priceValue.innerText = pricerange + " INR";
}

document.getElementById("nearMe").addEventListener("change", function () {
    if (this.checked) {
        // "Near Me" is selected, so call the trackLiveLocation function
        tracklivelocation();
    }
});

// function findHotels() {
//             const pricerange = document.getElementById("pricerange").value;
//             const beds = document.getElementById("beds").value;
            
//             // Make an AJAX request to retrieve filtered hotels
//             fetch(`../hotelbooking/hotelbook.php?price=${pricerange}&beds=${beds}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     // Process the hotel data and display markers on the map
//                     data.forEach(hotel => {
//                         L.marker([hotel.lat, hotel.long]).addTo(map)
//                             .bindPopup(`Hotel: ${hotel.hotel_name}<br>Price: ${hotel.price_2_bed}<br>Beds: ${hotel.beds}`);
//                     });
//                 })
//                 .catch(error => {
//                     console.error("Error fetching hotel data: ", error);
//                 });
//         }
function findHotels() {
    const pricerange = document.getElementById("pricerange").value;
    const beds = document.getElementById("beds").value;

    // Make an AJAX request to retrieve filtered hotels
    $.ajax({
        url: `../hotelbooking/hotelbook.php?pricerange=${pricerange}&beds=${beds}`,
        method: 'GET',
        dataType: 'json', // Specify that you expect JSON data
        success: function (data) {
            // Parse the JSON response
            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '<h3>Filtered Hotels:</h3>';
            data.forEach(hotel => {
                L.marker([hotel.latitude, hotel.longitude])
                    .addTo(map)
                    .bindPopup(`Hotel: ${hotel.hotel_name}<br>Price: ${hotel.price_2_bed}<br>Beds: ${hotel.beds}`)
                    .on('click', function () {
                        // Display hotel details in the modal
                        const hotelDetails = document.getElementById('hotelDetails');
                        hotelDetails.innerHTML = `
                            <p><strong>Hotel:</strong> ${hotel.hotel_name}</p>
                            <p><strong>Price:</strong> ${hotel.price_2_bed}</p>
                            <p><strong>Beds:</strong> ${hotel.beds}</p>
                        `;
                        // Show the modal
                        $('#hotelModal').modal('show');
                    });
                resultsDiv.innerHTML += `<p>Hotel: ${hotel.hotel_name}, Price: ${hotel.price_2_bed}, Beds: ${hotel.beds}</p>`;
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX error: " + status, error);
        }
    });
}
    </script>
    <script src="../scripter/scripts.js"></script>
    </body>
</html>