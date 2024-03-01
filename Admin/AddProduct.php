<?php
if(isset($_POST["add"])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $photo_name = "";
    if(isset($_FILES['photo'])){
        $photo = $_FILES['photo']['tmp_name'];
        $type = $_FILES['photo']['type'];
        $size = $_FILES['photo']['size'];
        $photo_name = $_FILES['photo']['name'];
        $target = "image/".$photo_name;
        move_uploaded_file($photo, $target);
    }    

    $conn = new mysqli("localhost", "root", "", "obms");
    if($conn->connect_error){
        die("Connection Error");
    }
    // Store complete path to the image in the database
    $sql = "INSERT INTO product (name, category, price, description, photo) 
    VALUES ('$name', '$category', '$price', '$description', '$photo_name')";

    $r = $conn->query($sql);
    if($r){
        header("Location: product.php");
    }
    else{
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="assets/css/addproduct.css">
</head>
<body>   
    <div id="main">
        <div id="content">
            <h1>Add New Product</h1>
            <form action="AddProduct.php" method="post" enctype="multipart/form-data">
                Product Name: <input type="text" name="name" id=""><br>
                Category: <input type="text" name="category" id=""><br>
                Price: <input type="text" name="price" id=""><br>
                Photo: <input type="file" name="photo" id=""><br>
                Description: <textarea name="description" id="" cols="30" rows="10"></textarea><br>
                <input type="submit" value="Add" name="add">
            </form>
        </div>
    </div>
</body>
</html>
