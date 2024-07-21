<?php
// Start session
session_start();
include('layout/headpart.php');

// Check if user is logged in
// if(!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// Fetch user information from the database
// $user_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "", "obms");
if($conn->connect_error){
    die("Connection Error");
}

// $sql = "SELECT * FROM signup";
$sql = "SELECT * FROM signup INNER JOIN customer_details ON 
signup.sid = customer_details.cid";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Display user information
    while($row = $result->fetch_assoc()) {
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
      
    }
} else {
    echo "User not found.";
}
if(isset($_POST["add"])){
    $photo_name = "";
    if(isset($_FILES['photo'])){
        $photo = $_FILES['photo']['tmp_name'];
        $type = $_FILES['photo']['type'];
        $size = $_FILES['photo']['size'];
        $photo_name = $_FILES['photo']['name'];
        $target = "image/".$photo_name;
        move_uploaded_file($photo, $target);
    }
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO customer_details (photo, phone, address)
     VALUES ('$photo_name', '$phone', '$address')";
     $r = $conn->query($sql);
     if($r){
        $sql = "SELECT * FROM customer_details WHERE cid = $user_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Display user information
            while($row = $result->fetch_assoc()) {
                $photo_name = $row['photo'];
                $phone = $row['phone'];
                $address = $row['address'];
              
            }
        } else {
            echo "User not found.";
        }
     }else{
        echo "Error";
     }
}

$conn->close();
?>
<link rel="stylesheet" href="./assets/css/manage_profile.css">
<!-- <link rel="stylesheet" href="assets/css/manage_profile.css"> -->
<h2>User Profile</h2>
<div class="main">
    <form action="profile.php" method="post">
         Photo: <input type="file" name="photo" id=""> <br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" ><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" ><br>

        <input type="submit" value="add" name="add">
    </form>
</div>

