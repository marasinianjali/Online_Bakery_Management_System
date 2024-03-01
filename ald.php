<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="assets/css/Signup.css">
    <script>
        function showAlert(message)
        {
            slert(message);
        }
    </script>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        
        // Validation
        if (empty($username) || empty($email) || empty($password) || empty($cpassword)) {
            echo "<script>alert('All fields are required');</script>";
        }
         elseif (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            echo "<script>alert('Only letters and white space allowed');</script>";
        } 
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format');</script>";
        } 
        elseif (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/", $password)) {
            echo "<script>alert('Password must be at least 8 characters long, contain at least one capital letter, and have at least one symbol (!@#$%^&*)');</script>";
        }
         elseif ($password !== $cpassword) {
            echo "<script>alert('Passwords do not match');</script>";
        } 
        else {
            // Validation passed, proceed with submitting data
            $conn = new mysqli("localhost", "root", "", "obms");
            if ($conn->connect_error) {
                die("Connection Error");
            }
            $sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
            $r = $conn->query($sql);
            if ($r) {
                echo "<script>alert('Data inserted');</script>";
            } else {
                echo "<script>alert('Error');</script>";
            }
        }
    }
    ?>

    <div class="main-div" style="background-image: url(/assets/images/background\ img.jpg);">
        <div class="register">
            <h2 class="sign">Sign_up</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                </div>
                <div class="input-field">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" value="<?php echo isset($_POST['cpassword']) ? $_POST['cpassword'] : ''; ?>">
                </div>
                <div>
                    <p>Already a member?</p>
                    <a href="#" class="Login">Login</a>
                </div>
                <input type="submit" name="submit" value="Submit" class="Signup">
            </form>
        </div>
    </div>
</body>

</html>
