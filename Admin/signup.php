<?php
// define variables and set to empty values
$usernameErr  = $passwordErr = $cpasswordErr = "";
$username  = $password = $cpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Name is required";
    } else {
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $usernameErr = "Only letters and white space allowed";
        }
    }


    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);

        // Validate password format
        if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{5,})/", $password)) {
            $passwordErr = "Password must be at least 8 characters long, contain at least one capital letter, and have at least one symbol (!@#$%^&*)";
        }
    }

    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm-Password is required";
    } else {
        $cpassword = test_input($_POST["cpassword"]);
        if ($password !== $cpassword) {
            $cpasswordErr = "Passwords do not match";
        }
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($usernameErr == "" && $emailErr == "" && $passwordErr == "" && $cpasswordErr == "") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $conn = new mysqli("localhost", "root", "", "obms");
        if ($conn->connect_error) {
            die("Connection Error");
        }
        $sql = "INSERT INTO admin_login (username, password) VALUES ('$username',  '$hashed_password')";
        $r = $conn->query($sql);
        if ($r) {
            header('location:login.php');
        } else {
            echo "Error Try again!";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include('layout/headpart.php');
?>
<link rel="stylesheet" href="assets/css/signup.css">
<div class="main-div">
    <div class="register">
        <h2 class="sign">Sign_up</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-field">
                <label for="username">Username</label> <br>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                <span class="error"><?php echo $usernameErr; ?></span>
                </div>
                
            <div class="input-field">
                <label for="password">Password</label>  <br>
                <input type="password" id="password" name="password" value="<?php echo $password; ?>">
                <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <div class="input-field">
                <label for="cpassword">Confirm Password</label><br>
                <input type="password" id="cpassword" name="cpassword" value="<?php echo $cpassword; ?>">
                <span class="error"><?php echo $cpasswordErr; ?></span>
            </div>
            <input type="submit" name="submit" value="Submit" class="Signup">
        </form>
    </div>
</div>

