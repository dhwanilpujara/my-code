<?php

session_start();


if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
    exit;
}


require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";


$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to homepage
                            header("location: homepage.php");
                            exit;
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid login credentials.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid login credentials.";
                }
            } else {
                // Unable to execute the login process. Display a specific error message.
                $login_err = "Unable to execute the login process. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $link->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/mainmultiform.css">
    <script src="scripts.js"></script>
    <script src="../scripter/hotelservicescript.js">
    </script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
        <?php 
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($login_err) . '</div>';
        }        
        ?>
        <section>
        <div class="container">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="step step-1 active">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
                <span class="invalid-feedback"><?php echo htmlspecialchars($username_err); ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo htmlspecialchars($password_err); ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Login</button>
            </div>
            <p>Don't have an account? <a href="/sign-up">Sign Up</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>

<!--    <section>-->
<!--        <div class="container">-->
<!--        <form method="POST">-->
<!--            <h2>Login</h2>-->
<!--            <p>Please fill in your credentials to login.</p>-->
<!--            <div class="step step-1 active">-->
<!--                <div class="form-group">-->
<!--                    <label for="usernames">Usernames:</label>-->
<!--                    <input type="text" id="usernames" name="username" />-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="fullnames">Password:</label>-->
<!--                    <input type="text" id="fullnames" name="password" />-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="fullnames">Role:</label>-->
<!--                    <input type="text" id="fullnames" name="role" />-->
<!--                </div>-->
                
                <!--<div class="form-group">-->
                <!--    <label for="conpass">Confirm Password:</label>-->
                <!--    <input type="text" id="conpass" name="confirmpassword" />-->
                <!--</div>-->
                <!--<button type="button" class="next-btn">Next</button>-->
<!--                <button type="submit" class="submit-btn">Login</button>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</section>-->
    <!--<script src="../scripter/hotelservicescript.js">-->
    <!--</script>-->
