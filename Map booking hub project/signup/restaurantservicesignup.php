<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php"; // Include your database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve user input from the form
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $dob = $_POST['dob'];
    $addresslines = $_POST['addresslines'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $post_code = $_POST['post_code'];
    $merchantid = $_POST['merchantid'];
    $iifscode = $_POST['iifscode'];
    $accnumber = $_POST['accnumber'];

    // SQL query to insert data into the table
    $sql = "INSERT INTO resprov (username, fullname, password, email, phonenumber, dob, addresslines, country, city, post_code, merchantid, iifscode, accnumber) VALUES ('$username', '$fullname', '$password', '$email', '$phonenumber', '$dob', '$addresslines', '$country', '$city', '$post_code', '$merchantid', '$iifscode', '$accnumber')";
    if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
    if ($link->query($sql) === TRUE) {
        echo "Record inserted successfully.";
        header("Location: /restaurant");
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
        <title>Restaurant Booking</title>
        <link rel="stylesheet" href="../css/mainmultiform.css">
    </head>
    <body>
        
        </div>
    <section>
    <div class="container">
        <form method="POST">
            <div class="step step-1 active">
                <div class="form-group">
                    <label for="usernames">UserName</label>
                    <input type="text" id="usernames" name="username" />
                </div>
                <div class="form-group">
                    <label for="fullnames">Full Name:</label>
                    <input type="text" id="fullnames" name="fullname" />
                </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="text" id="pass" name="password" />
                </div>
                <div class="form-group">
                    <label for="conpass">Confirm Password:</label>
                    <input type="text" id="conpass" name="confirmpassword" />
                </div>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-2">
                <div class="form-group">
                    <label for="emaild">Email</label>
                    <input type="text" id="emaild" name="email" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="phonenumber" />
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
                    <input type="text" id="addressline" name="addresslines" />
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
                    <input type="text" id="postCode" name="post_code" />
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-4">
                <div class="form-group">
                    <label for="email">MerchantID</label>
                    <input type="text" id="email" name="merchantid" />
                </div>
                <div class="form-group">
                    <label for="iifcode">IIFSC Code</label>
                    <input type="text" id="iifcode" name="iifscode" />
                </div>
                <div class="form-group">
                    <label for="accon">Account Number</label>
                    <input type="number" id="accon" name="accnumber" />
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Submit</button>
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