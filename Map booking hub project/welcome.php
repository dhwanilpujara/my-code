<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pricerange']) && isset($_GET['beds'])) {
    $pricerange = $_GET['pricerange'];
    $beds = $_GET['beds'];
    
    // Simulate hotel data (in place of a real database query)
    $hotels = [
        ['hotel_name' => 'Hotel A', 'price_2_bed' => 100, 'beds' => 2, 'lat' => 52.5200, 'long' => 13.4050],
        ['hotel_name' => 'Hotel B', 'price_2_bed' => 150, 'beds' => 4, 'lat' => 48.8566, 'long' => 2.3522],
        ['hotel_name' => 'Hotel C', 'price_2_bed' => 80, 'beds' => 1, 'lat' => 40.7128, 'long' => -74.0060],
    ];

    $filteredHotels = [];

    // Simulate filtering based on price and beds
    foreach ($hotels as $hotel) {
        if ($hotel['price_2_bed'] <= $pricerange && $hotel['beds'] >= $beds) {
            $filteredHotels[] = $hotel;
        }
    }

    // Return the results as JSON
    header('Content-Type: application/json');
    echo json_encode($filteredHotels);
} else {
    echo json_encode([]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hotel Booking Test</title>
    <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
</head>
<body>
    <div id="map">
            <script src="../scripter/map.js"></script>
        </div>
    <div id="hotelform" style="z-index: 1; position: absolute; top: 50px; left: 20px; width: 300px; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
        <h2>Hotel Filters</h2>
        <form id="filterForm" >
            <label for="pricerange">Price Range:</label>
            <input type="number" id="pricerange" name="pricerange" min="50" max="200" step="10" value="100">
            <br><br>
            <label for="beds">Number of Beds per Room:</label>
            <input type="number" id="beds" name="beds" min="1" max="5" value="2">
            <br><br>
            <button type="button" onclick="findHotels()">Apply Filter</button>
        </form>
    </div>
    <div id="results">
        <!-- Display filtered hotel results here -->
    </div>
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

        function findHotels() {
            const pricerange = document.getElementById("pricerange").value;
            const beds = document.getElementById("beds").value;

            // Make an AJAX request to retrieve filtered hotels
            fetch(`?pricerange=${pricerange}&beds=${beds}`)
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        console.log("Raw Response:", data);
        try {
            const parsedData = JSON.parse(data);
            console.log("Parsed JSON Data:", parsedData);
            const resultsDiv = document.getElementById('results');
            resultsDiv.innerHTML = '<h3>Filtered Hotels:</h3>';
            parsedData.forEach(hotel => {
                resultsDiv.innerHTML += `<p>Hotel: ${hotel.hotel_name}, Price: ${hotel.price_2_bed}, Beds: ${hotel.beds}</p>`;
            });
        } catch (error) {
            console.error("Error parsing JSON data: ", error);
        }
    })
    .catch(error => {
        console.error("Fetch error: ", error);
    });}
    </script>
</body>
</html>
