<?php
session_start();
// Check if user is logged in and session variable is set
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page 
    header("Location: login.php");
    exit();
}

include('layout/headpart.php');
include('layout/sidebar.php');
$conn = new mysqli("localhost", "root", "", "obms");
if($conn->connect_error){
    die("Connection Error");
}

   // Validate Message
   if (empty($description)) {
    $descriptionErr = "Description is required";
} elseif (strlen($description) < 10) {
    $descriptionErr = "Description must be at least 10 characters long";
} elseif (strlen($description) > 1000) {
    $descriptionErr = "Description must not exceed 1000 characters";
} elseif (!preg_match('/^[a-zA-Z0-9\s]+$/', $description)) {
    $descriptionErr = "Description can only contain letters, numbers, and spaces";
} else {
    $descriptionErr = ""; // No errors, valid message
}

$sid = $_SESSION['user_id'];

// Fetch additional information
$query = "SELECT * FROM signup WHERE sid = '$sid'";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
    $username = $row['username'];
}

// Handle form submission
if(isset($_POST["submit"])){
    // Get form data
    $message = ( $_POST["message"]); 
    $photo = "";

    // Handling file upload
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK){
        $photo = $_FILES['photo']['name'];
        $target = "image/".$photo;

        // Move uploaded file to destination
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            // Insert message into database
            $sql = "INSERT INTO messagedb (sid, message, photo) VALUES ('$sid', '$message', '$photo')";
            if($conn->query($sql)) {
                $success_message = "Message sent successfully. We may contact you after viewing your message";
            } else {
                $error_message = "Error: " . $conn->error;
            }
        } else {
            $error_message = "Error uploading file";
        }
    } else {
        // Insert message into database without photo
        $sql = "INSERT INTO messagedb (sid, message) VALUES ('$sid', '$message')";
        if($conn->query($sql)) {
            $success_message = "Message sent successfully. We may contact you after viewing your message ";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

?>

<link rel="stylesheet" href="assets/css/contact_us.css">

<!-- success or error message to display  -->
<div class="message-container">
    <?php if (isset($success_message)): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
</div>

<div class="message-box">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="textarea">
            <h3>Welcome <?php echo $username; ?>, please write your message here..</h3>
            <textarea name="message" id="message" placeholder="Type your message here..." required></textarea>
            <span class="error"><?php echo $descriptionErr; ?></span><br><br>
            <input id="image-upload" type="file" name="photo" style="display: none;" onchange="previewImage(event)">
            <label for="image-upload" class="custom-file-upload">
                Select Image
            </label>
            <div id="image" class="image"></div>
            <br>
            <button type="submit" name="submit">Send Message</button>
        </div>
        <p class="additional-info">For more, please call us or send a message via WhatsApp Number at 9843959446.</p>
    </form>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var img = document.createElement('img');
        img.src = reader.result;
        img.style.maxWidth = '100px'; //size for image to show
        document.getElementById('image').innerHTML = '';
        document.getElementById('image').appendChild(img);
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
