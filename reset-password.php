<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo '<p>' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/Login.css">
    <title>Login Page</title>
</head>
<body>
    <?php include('headpart.php');?>
    <div class="login-container" style="background-image: url(/assets/images/banner4.jpg);">
        <div class="login-details-container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="button">
                    <input type="submit" value="Login" class="login"  name="login">
                </div>
                <a href="Forget-password.php" class="help-desk">Forgot Password?</a>

                <div>
                    <p>Don't have a account?</p>
                    <p>Signup here.</p>
                    <a href="signup.php" class="Signup">Signup</a>
                </div>
            </form>
        </div> 
    </div>

    <form action="process-reset-password.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
