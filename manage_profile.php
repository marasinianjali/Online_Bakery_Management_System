<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit(); 
}
        include('layout/headpart.php');
        include('layout/sidebar.php');

$phoneErr = $addressErr = "";
$phone = $address = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
}
$sid = $_SESSION['user_id'];
// Fetch existing profile information
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login
$sql_fetch_profile = "SELECT * FROM signup WHERE sid = $user_id";
$result_profile = $conn->query($sql_fetch_profile);
if ($result_profile->num_rows > 0) {
    $row_profile = $result_profile->fetch_assoc();
    $username = $row_profile['username'];
    $email = $row_profile['email'];
    $password = $row_profile['password'];

}

// Fetch additional information
$sql_fetch_details = "SELECT * FROM customer_details WHERE cid = $user_id";
$result_details = $conn->query($sql_fetch_details);
if ($result_details->num_rows > 0) {
    $row_details = $result_details->fetch_assoc();
    $photo = $row_details['photo'];
    $phone = $row_details['phone'];
    $address = $row_details['address'];
} else {
    $photo = '';
    $phone = '';
    $address = '';
}


if (isset($_POST['save'])) {
    $new_phone = test_input($_POST['phone']);
    $new_address = test_input($_POST['address']);
    
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

    if (empty($phoneErr) && empty($addressErr)) {
        if ($result_details->num_rows > 0) {
            $sql_update_details = "UPDATE customer_details SET phone = '$new_phone', address = '$new_address' WHERE cid = $user_id";
        } else {
            $sql_update_details = "INSERT INTO customer_details (cid, sid, phone, address) VALUES ('$user_id', '$sid', '$new_phone', '$new_address')";
        }
        $conn->query($sql_update_details);

        if (!empty($_FILES['photo']['name'])) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); 
            }
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $sql_update_photo = "UPDATE customer_details SET photo = '$target_file' WHERE cid = $user_id";
                $conn->query($sql_update_photo);
            } else {
                echo "Error uploading file.";
            }
        }

        echo "<script>alert('Profile updated successfully!');</script>";
    }
}
?>

<link rel="stylesheet" href="./assets/css/manage_profile.css">

<div class="main-div">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Welcome <?php echo $username; ?></h3>
        <hr>
        <div class="photo-input-container">
            <input type="file" name="photo" id="photo"><br>
            <?php if (!empty($photo)) echo "<img src='$photo' alt='User Photo'>"; ?>
            <div class="change-image">
                <label for="photo">Upload Image</label>
            </div>
        </div>
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="text" id="email" name="email" value="<?php echo $email; ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="phone">Phone No</label></td>
                <td>
                    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                    <span class="error"><?php echo $phoneErr; ?></span>
                </td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td>
                    <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
                    <span class="error"><?php echo $addressErr; ?></span>
                </td>
            </tr>
        </table>
        <button type="submit" class="save" name="save">Save</button>
    </form>
</div>
