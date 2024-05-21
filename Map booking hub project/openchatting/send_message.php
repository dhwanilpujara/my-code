<?php
// PHP code to insert a new message into the database

require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['message']) && isset($_POST['username'])) {
    $message = mysqli_real_escape_string($link, $_POST['message']);
    $username = mysqli_real_escape_string($link, $_POST['username']);

    $query = "INSERT INTO chat_messages (username, message) VALUES ('$username', '$message')";
    mysqli_query($link, $query);
}

?>
