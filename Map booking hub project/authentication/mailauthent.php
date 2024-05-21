<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/../private/config.php";
// Generate a random OTP
$otp = mt_rand(100000, 999999);

// Insert user data into the database along with the generated token
$sql = "INSERT INTO users (email, verification_token, otp) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email, $token, $otp]);

// Send the OTP to the user's email
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = 'your_email@example.com';
$mail->Password = 'your_email_password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('your_email@example.com', 'Your Name');
$mail->addAddress($email);

$mail->isHTML(true);
$mail->Subject = 'Your Verification OTP';
$mail->Body = 'Your OTP: ' . $otp;

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'An OTP has been sent to your email address.';
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mail Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Send OTP</h2>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="form-group">
                <button id="send-otp">Send OTP</button>
            </div>
        </form>
    </div>
</body>
</html>
