<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_Dashboard</title>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location:login.php");
    }
    include('headpart.php');
    ?>
</body>
</html>