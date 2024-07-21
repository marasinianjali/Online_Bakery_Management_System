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
    <link rel="stylesheet" href="./assets/css/headpart.css">
</head>
<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "obms");

    // Check database connection
    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    }
    ?>
     <!-- header part start -->
     <div id="header">
    
            <h2>Welcome
            <a href="manage_profile.php">
                <?php
                            // Fetch existing profile information
                            $staff_id = $_SESSION['staff_id'];
                            // Fetch additional information
                            $query = "SELECT * FROM delivery_staff WHERE staff_id = '$staff_id' ";

                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {

                                $username = $row['username'];
                            }
                            echo $username;
                            ?>
                </a>
            </h2>


    </div>