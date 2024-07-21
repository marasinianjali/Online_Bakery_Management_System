<?php
// define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = $cpasswordErr = $phoneErr  = $addressErr = "";
$username = $email = $password = $cpassword = $phone =  $address = "";

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

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);

        // Validate password format
        if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/", $password)) {
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

    // Phone validation
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^\d{10}$/", $phone)) {
            $phoneErr = "Phone number must be 10 digits long";
        } else if (preg_match('/[^0-9.]/', $phone)) {
            $phoneErr = "Phone number should not contain any invalid characters";
        }
    }

    // Photo Validation 
    // if (empty($_FILES["photo"]["name"])) {
    //     $photoErr = "Image is required";
    // } else {
    //     $photo = $_FILES['photo']['tmp_name'];
    //         $photo_name = $_FILES['photo']['name'];
    //         $target = "../image/" . $photo_name;
    //         move_uploaded_file($photo, $target);
    // }

    // Address Validation
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
        if (!preg_match("/^[a-zA-Z0-9\s,-]*$/", $address)) {
            $addressErr = "Address shouldn't contain any special character";
        }
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($usernameErr == "" && $emailErr == "" && $passwordErr == "" && $cpasswordErr == "" && $phoneErr == ""  && $addressErr == "") {
        $conn = new mysqli("localhost", "root", "", "obms");
        if ($conn->connect_error) {
            die("Connection Error");
        }

        $sql = "INSERT INTO delivery_staff (username, email, password, phone, address) 
        VALUES ('$username', '$email', '$hashed_password', '$phone',  '$address')";
        $r = $conn->query($sql);
        if ($r) {
            header('location:login.php');
        } else {
            echo "Error";
        }

        
    }
}

// creating function for validation process
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include('layout/headpart.php');
?>

<link rel="stylesheet" href="assets/css/signup.css">

<div class="register">
    <h2 class="sign">Sign_up</h2>
    <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      
        <div class="input-field">
            <label for="username">Username</label> <br>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="input-field">
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div class="input-field">
            <label for="password">Password</label> <br>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <div class="input-field">
            <label for="cpassword">Confirm Password</label> <br>
            <input type="password" id="cpassword" name="cpassword" value="<?php echo $cpassword; ?>">
            <span class="error"><?php echo $cpasswordErr; ?></span>
        </div>
        <div class="input-field">
            <label for="phone">Phone</label> <br>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
            <span class="error"><?php echo $phoneErr; ?></span>
        </div>
        <div class="input-field">
            <label for="address">Address</label> <br>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>">
            <span class="error"><?php echo $addressErr; ?></span>
        </div>
        
        <input type="submit" name="submit" value="Submit" class="Signup">
    </form>
</div>
