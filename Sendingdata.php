<!DOCTYPE HTML>
<html>

<head>
    <link rel="stylesheet" href="assets/css/Signup.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // Error messages
        $errors = array();

        // Validation
        if (empty($username)) {
            $errors['username'] = "Username is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $errors['username'] = "Only letters and white space allowed";
        }

        if (empty($email)) {
            $errors['email'] = "Email is required";
            
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }

        if (empty($password)) {
            $errors['password'] = "Password is required";
        } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/", $password)) {
            $errors['password'] = "Password must be at least 8 characters long, contain at least one capital letter, and have at least one symbol (!@#$%^&*)";
        }

        if (empty($cpassword)) {
            $errors['cpassword'] = "Confirm-Password is required";
        } elseif ($password !== $cpassword) {
            $errors['cpassword'] = "Passwords do not match";
        }

        // If no errors, proceed with submitting data
        if (empty($errors)) {
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
                    <span class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></span>
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                    <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
                </div>
                <div class="input-field">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" value="<?php echo isset($_POST['cpassword']) ? $_POST['cpassword'] : ''; ?>">
                    <span class="error"><?php echo isset($errors['cpassword']) ? $errors['cpassword'] : ''; ?></span>
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
