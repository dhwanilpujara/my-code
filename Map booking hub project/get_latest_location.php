<?php
require_once $_SERVER['DOCUMENT_ROOT']."../private/config.php";

// Query to get the latest location data from the database using your custom $link resource
$sql = "SELECT latitude, longitude FROM emergencylocation ORDER BY timestamp DESC LIMIT 1";
$result = mysqli_query($link, $sql);

if ($result) {
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        // Respond with the latest location data as JSON
        echo json_encode($data);
    } else {
        // Respond with an error message if no data is found
        echo json_encode(['error' => 'No location data found.']);
    }
} else {
    // Respond with an error message if there is a database query error
    echo json_encode(['error' => 'Database query error: ' . mysqli_error($link)]);
}
?>
