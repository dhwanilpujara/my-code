<?php
// PHP code to insert a new message into the database
$message = $_POST['message'];
$query = "INSERT INTO chat_messages (username, message) VALUES ('Anonymous', '$message')";
mysqli_query($link, $query);
?>
