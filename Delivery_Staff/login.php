<?php

session_start(); // Start session

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "obms");
    if($conn->connect_error){
        die("Connection Error");
    }

    $sql = "SELECT * FROM delivery_staff WHERE email='$email'";
    $r = $conn->query($sql);
    if($r->num_rows > 0){
        $row = $r->fetch_assoc();
        $hashed_password = $row['password']; // Get the hashed password from the database
        if(password_verify($password, $hashed_password)) { // Verify the password
            
            $_SESSION['staff_id'] = $row['staff_id']; 
            $_SESSION['login'] = true; 
            header("Location: index.php");
            exit();
        } else {
            echo "Login Error";
        }
    } else {
        echo "Account not found";
    }
}



?>

    <link rel="stylesheet" href="./assets/css/Login.css">
    <title>Login Page</title>
    
        <div class="login-details-container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="input-field">
                    <label for="email">Email</label>
                    <br>
                    <input type="text" id="email" name="email">
                </div>
                
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="button">
                    <input type="submit" value="Login" class="login"  name="login">
                </div>
               

                <div class="signup">
                    <p>Don't have a account?</p>
                 
                    <a href="signup.php">Signup </a>
                </div>
            </form>
        </div> 
  

