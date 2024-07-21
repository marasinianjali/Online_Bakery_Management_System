<?php
// session_start();
// if(!isset($_SESSION['login'])){
//     header("Location:login.php");
// }
if(isset($_POST['Yes'])){
    // Check if product ID is set
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        // Establish database connection
        $conn = new mysqli("localhost", "root", "", "obms");
        if($conn->connect_error){
            die("Connection Error");
        }

        // Prepare and execute SQL query to delete product
        $sql = "DELETE FROM product WHERE pid = '$id' ";
        if ($conn->query($sql) === TRUE) {
            // Product deleted successfully, redirect back to productdetails.php
            header("Location: productdetails.php?id=".$id);
            exit(); // Ensure that no further code is executed after redirection
        } else {
            echo "Error deleting product: " . $conn->error;
        }

        // Close database connection
        $conn->close();
    } else {
        echo "Product ID not specified.";
    }
} elseif (isset($_POST['No'])) {
    // Redirect or include the appropriate file if "No" is clicked
    header("Location: productdetails.php?id=".$_GET['pid']);
    exit(); // Ensure that no further code is executed after redirection
} else {
}


?>


<link rel="stylesheet" href="./assets/css/delete.css">

<div class="delete">
    <form action="" method="post">
        <h1>Warning!</h1>
        <p>Are you sure you want to delete this product? </p>
        <div class="button">
        <input type="submit" value="No" class="No"  name="No">
        <input type="submit" value="Yes" class="Yes"  name="Yes">
    </form>
</div>