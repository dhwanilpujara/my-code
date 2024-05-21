// Retrieve the OTP from the user's input
$enteredOtp = $_POST['otp'];

// Retrieve the OTP from the database for the given email
$sql = "SELECT otp FROM users WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$row = $stmt->fetch();
$storedOtp = $row['otp'];

// Compare the entered OTP with the stored OTP
if ($enteredOtp === $storedOtp) {
    // OTP is correct, mark the user as verified
    $updateSql = "UPDATE users SET is_verified = 1 WHERE email = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([$email]);
    echo "Email Verified Successfully!";
} else {
    echo "Invalid OTP. Please try again.";
}
