<!DOCTYPE HTML>
<html>

<head>
<link rel="stylesheet" href="assets/css/Signup.css">
</head>

<body>
<?php
  // define variables and set to empty values
  $usernameErr = $emailErr = $passwordErr = $cpasswordErr = "";
  $username = $email = $password = $cpassword = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $usernameErr = "Name is required";
    } else {
      $username = test_input($_POST["username"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
         $usernameErr = "Only letters and white space allowed";
        //echo "<script> alert("Only letters and white space allowed")</script>";
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
        $passwordErr = "Password must be at least 8 characters long, 
        contain at least one capital letter, and have at least one symbol (!@#$%^&*)";
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

  }
  if (isset($_POST['submit'])) {
    // Perform form validation
    if ($usernameErr == "" && $emailErr == "" && $passwordErr == "" && $cpasswordErr == "") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = new mysqli("localhost", "root", "", "obms");
        if ($conn->connect_error) {
            die("Connection Error");
        }
        $sql = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";
        $r = $conn->query($sql);
        if ($r) {
            echo "Data inserted";
        } else {
            echo "Error";
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

  include('headpart.php');
  ?>

  <div class="main-div" style="background-image: url(/assets/images/background\ img.jpg);">
    <div class="register">
      <h2 class="sign">Sign_up</h2>
      <!-- <p><span class="error">* required field</span></p> -->
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="input-field">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                    <span class="error"><?php echo $usernameErr; ?></span>
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>">
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>
                <div class="input-field">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" id="cpassword" name="cpassword" value="<?php echo $cpassword; ?>">
                    <span class="error"><?php echo $cpasswordErr; ?></span>
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