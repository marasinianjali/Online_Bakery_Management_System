<?php
session_start();
    include('layout/headpart.php');
    include('layout/sidebar.php');

// define variables and set to empty values
$usernameErr = $emailErr = $phoneErr = $addressErr = "";

$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
}

$staff_id = $_SESSION['staff_id']; // Assuming user_id is stored in session after login
$sql_fetch_profile = "SELECT * FROM delivery_staff WHERE staff_id = $staff_id";
$result_profile = $conn->query($sql_fetch_profile);
if ($result_profile->num_rows > 0) {
    $row_profile = $result_profile->fetch_assoc();
    $username = $row_profile['username'];
    $email = $row_profile['email'];
    $phone = $row_profile['phone'];
    $address = $row_profile['address'];
}


if (isset($_POST['update'])) {
    $new_username = test_input($_POST['username']);
    $new_email = test_input($_POST['email']);
    $new_phone = test_input($_POST['phone']);
    $new_address = test_input($_POST['address']);

    // Username Validation
    if (empty($_POST["username"])) {
        $usernameErr = "Name is required";
    } else {
        $username = test_input($_POST["username"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $usernameErr = "Only letters and white space allowed";
        }
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    
    // Phone validation
    if (empty($new_phone)) {
        $phoneErr = "Phone number is required";
    } else {
        if (!preg_match("/^\d{10}$/", $new_phone)) {
            $phoneErr = "Phone number must be 10 digits long and must not use any symbols";
        }
    }

    // Address validation
    if (empty($new_address)) {
        $addressErr = "Address is required";
    } else {
        if (!preg_match("/^[a-zA-Z0-9, ]*$/", $new_address)) {
            $addressErr = "Address can only contain letters, numbers, commas, and spaces";
        }
    }

    if (empty($usernameErr) && empty($emailErr) && empty($phoneErr) && empty($addressErr)) {
       
            $sql_update_details = "UPDATE delivery_staff SET username = '$new_username', email = '$new_email',
            phone = '$new_phone', address = '$new_address' WHERE staff_id = $staff_id";
             $conn->query($sql_update_details);


        echo "<script>alert('Profile updated successfully!');</script>";
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<link rel="stylesheet" href="./assets/css/manage_profile.css">

<div class="main-div">
    <form action="" method="post">
        <h3>Welcome <?php echo $username; ?></h3>
        <hr>
       
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" id="username" name="username" value="<?php echo $username; ?>"></td>
                <span class="error"><?php echo $usernameErr; ?></span>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="text" id="email" name="email" value="<?php echo $email; ?>" r></td>
                <span class="error"><?php echo $emailErr; ?></span>
            </tr>
            <tr>
                <td><label for="phone">Phone No</label></td>
                <td>
                    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" >
                    <span class="error"><?php echo $phoneErr; ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td>
                    <input type="text" id="address" name="address" value="<?php echo $address; ?>" >
                    <span class="error"><?php echo $addressErr; ?></span>
                </td>
            </tr>
        </table>
        <button type="update" class="update" name="update">Update</button>
    </form>
</div>
