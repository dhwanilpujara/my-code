
<?php
// Start the session to check if the user is logged in
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}

// Include database connection and helper functions here (e.g., db_connection.php)
require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";
// Get the user's information from the database (replace with your own database queries)
$userId = $_SESSION["users_id"];
$sql = "SELECT * FROM users WHERE id = ?";
if($stmt = $link->prepare($sql)){
    $stmt->bind_param("i",$userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $stmt->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>Welcome, <?php echo $userData['firstname']; ?>!</h1>

    <!-- Display user information -->
    <p>Username: <?php echo $userData['username']; ?></p>
    <p>Full Name: <?php echo $userData['firstname'] . ' ' . $userData['lastname']; ?></p>
    <p>Date of Birth: <?php echo $userData['dob']; ?></p>
    <p>Gender: <?php echo $userData['gender']; ?></p>
    <p>Address: <?php echo $userData['address']; ?></p>
    <p>Email: <?php echo $userData['email']; ?></p>
    <button onclick="redirectToUpdateProfile()">Update</button>
    <!-- Add a link to the logout page (e.g., logout.php) to allow users to log out -->
    <button onclick="redirectToLogout()">Logout</button>

</body>
</html>
