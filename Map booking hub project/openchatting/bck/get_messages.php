<?php
// PHP code to retrieve and display messages from the database
$query = "SELECT * FROM chat_messages";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<strong>" . $row['username'] . ":</strong> " . $row['message'] . "<br>";
}
?>
