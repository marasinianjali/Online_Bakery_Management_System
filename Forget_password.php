<?php
// Start session (if not already started)
session_start();

// Include database connection file
include('db.php');

// Validate email address
$email = $_POST['email']; // Assuming form method is POST
// Add additional validation as needed (e.g., check if email exists in your users table)

// Generate a unique token
$token = bin2hex(random_bytes(32)); // Generate a random 32-byte token

// Store the token and email in the database
$sql = "INSERT INTO reset_requests (email, token) VALUES ('$email', '$token')";
if ($conn->query($sql) === TRUE) {
    // Send email with reset link
    $reset_link = "https://example.com/reset-password.php?token=$token";
    $message = "Click the following link to reset your password: $reset_link";
    // Use PHP's mail function or a library like PHPMailer to send the email
    // mail($email, "Password Reset", $message);
    
    $_SESSION['message'] = "Password reset link has been sent to your email.";
    header("Location: forgot-password.php"); // Redirect back to forgot password page
    exit;
} else {
    $_SESSION['error'] = "Error occurred. Please try again later.";
    header("Location: forgot-password.php"); // Redirect back to forgot password page
    
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/forget-password.css">
    <title>Forget-Password Page</title>
</head>

<body>
    <?php include('headpart.php');?>
    <div class="forget-password" style="background-image: url(/assets/images/banner4.jpg);">
    <!-- login container -->
         <div class="email-details"> <!--login-details-container -->
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="button">
                    <input type="submit"  class="submit" name="submit">
                </div>
            </form>
        </div> 
    </div>
</body>
</html>