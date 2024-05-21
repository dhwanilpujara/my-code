<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT']."/../private/config.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $post_code = $_POST['postcode'];
    
    $sql = "INSERT INTO users (username, firstname, lastname, password, email, mobile, dob, address, country, city, postcode) VALUES ('$username', '$firstname', '$lastname', '$password', '$email', '$mobile', '$dob', '$address', '$country', '$city', '$postcode')";
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
    if ($link->query($sql) === TRUE) {
        echo "Record inserted successfully.";
        header("Location: /log-in");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
}

$link->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font: 14px sans-serif; }
        .wrapper { width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../css/mainmultiform.css">
    <script src="./scripter/scripts.js"></script>
    
</head>
<body>
        <section>
        <div class="container">
        <form method="POST">
            
        <h2>Signup</h2>
        <p>Please fill in your credentials to signup.</p>
            <div class="step step-1 active">
                <div class="form-group">
                    <label for="usernames">Usernames:</label>
                    <input type="text" id="usernames" name="username" />
                </div>
                <div class="form-group">
                    <label for="fullnames">First Name:</label>
                    <input type="text" id="fullnames" name="firstname" />
                </div>
                <div class="form-group">
                    <label for="fullnames">Last Name:</label>
                    <input type="text" id="fullnames" name="lastname" />
                </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="text" id="pass" name="password" />
                </div>
                <!--<div class="form-group">-->
                <!--    <label for="conpass">Confirm Password:</label>-->
                <!--    <input type="text" id="conpass" name="confirmpassword" />-->
                <!--</div>-->
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-2">
                <div class="form-group">
                    <label for="emaild">Email</label>
                    <input type="text" id="emaild" name="email" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="mobile" />
                </div>
                <div class="form-group">
                    <label for="datebirth">DOB</label>
                    <input type="date" id="datebirth" name="dob" />
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-3">
                <div class="form-group">
                    <label for="addressline">Address</label>
                    <input type="text" id="addressline" name="address" />
                </div>
                <div class="form-group">
                    <label for="country">country</label>
                    <input type="text" id="country" name="country" />
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" />
                </div>
                <div class="form-group">
                    <label for="postCode">Post Code</label>
                    <input type="text" id="postCode" name="postcode" />
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-5">
                <div class="form-group">
                    <label>Welcome</label>
                </div>
                <button type="submit" class="submit-btn">Map Hub</button>
            </div>
        </form>
    </div>
</section>
<script src="../scripter/hotelservicescript.js">
    </script>
</body>
</html>
