<?php
session_start(); // Start session


if(isset($_POST['login'])){
    $email= $_POST['email'];
    $password=$_POST['password'];

    $conn= new mysqli("localhost","root","","obms");
    if($conn->connect_error){
        die("Connection Error");
    }

    $sql="select * from signup where email='$email' and password='$password'";
    $r=$conn->query($sql);
    if($r->num_rows>0){
        $row=$r->fetch_assoc();
        $_SESSION['user_id'] = $r;
        header("Location:dashboard.php");
    }
    else{
        echo "Login Error";
    }
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
</body>
</html>
