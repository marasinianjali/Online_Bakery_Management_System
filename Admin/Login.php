<?php

session_start();

if(isset($_POST['login'])){
    $username= $_POST['username'];
    $password=$_POST['password'];
    $conn= new mysqli("localhost","root","","obms");
    if($conn->connect_error){
        die("Connection Error");
    }
    $sql="SELECT * FROM admin_login WHERE username='$username'";
    $r=$conn->query($sql);
    if($r->num_rows>0){
        $row=$r->fetch_assoc();
        $hashed_password = $row['password']; // Get the hashed password from the database
        if(password_verify($password, $hashed_password)) { // Verify the password
        
        $_SESSION['login']=$row;
        header("Location:index.php");
        exit();
        }else{
            echo "Login Error";
        }
    }else{
        echo "Account Does not found";
    }
}
 

?>

    <link rel="stylesheet" href="./assets/css/Login.css">

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
                
                <a href="signup.php" class="help-desk">Or Signup Here</a>
                  
            </form>
        </div> 
    </div>
