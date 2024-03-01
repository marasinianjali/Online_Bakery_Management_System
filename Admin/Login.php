<?php
if(isset($_POST['login'])){
    $username= $_POST['username'];
    $password=$_POST['password'];
    $conn= new mysqli("localhost","root","","obms");
    if($conn->connect_error){
        die("Connection Error");
    }
    $sql="select * from admin_login where username='$username' and password='$password'";
    $r=$conn->query($sql);
    if($r->num_rows>0){
        $row=$r->fetch_assoc();
        session_start();
        $_SESSION['login']=$row;
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
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/Login.css">
</head>
<body>
<div class="login-container" style="background-image: url(/assets/images/banner4.jpg);">
        <div class="login-details-container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                
                <div class="input-field">
                    <label for="Username">Username</label>
                    <input type="text" id="username" name="username">
                </div>
    
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                
                <div class="button">
                    <input type="submit" value="Login" class="login" name="login">
                </div>
                
                <a href="#" class="help-desk">Forgot Password?</a>
                  
            </form>
        </div> 
    </div>
</body>
</html>