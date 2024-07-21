<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bake & Brake</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">

</head>
<?php
$conn = new mysqli("localhost", "root", "", "obms");

// Check database connection
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}
?>

<body>

    <!-- header part start -->
    <div id="header">
        <div class="logo">
            <a href="index.php">
                <img src="./assets/images/logo.png" alt="logo" />
            </a>
        </div>

        <h2>Bake & Break</h2>
         <div class="nav">
           
            <?php if (isset($_SESSION['user_id'])): ?>
                <ul>
                    <li><a href="manage_profile.php">
                            <?php
                            // Fetch existing profile information
                            $sid = $_SESSION['user_id'];
                            // Fetch additional information
                            $query = "SELECT * FROM signup WHERE sid = '$sid' ";

                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {

                                $username = $row['username'];
                            }
                            echo $username;
                            ?>

                    <li><a href="LogOut.php">Log Out</a></li>
                <?php else: ?>
                    <li><a href="login.php"><i class="fa fa-fw fa-user"></i>Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
       
        <!-- header part end -->

    </div>