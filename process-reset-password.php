<?php
session_start();

// Include database connection file
include('db.php');

// Validate password reset token
$token = $_POST['token']; // Assuming form method is POST
// Add additional validation as needed (e.g., check if token exists in the reset_requests table)

// Validate and sanitize new password
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
if ($password != $confirm_password) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: reset-password.php?token=$token"); // Redirect back to reset password page
    exit;
}
// Hash the new password before storing it in the database (you should use password_hash() function for better security)
$hashed_password = md5($password);

// Update user's password in the database
$sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Password has been reset successfully.";
    header("Location: login.php"); // Redirect to login page
    exit;
} else {
    $_SESSION['error'] = "Error occurred. Please try again later.";
    header("Location: reset-password.php?token=$token"); // Redirect back to reset password page

}

$conn->close();
?>
