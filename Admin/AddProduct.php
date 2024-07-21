<?php
session_start();
include('layout/headpart.php');
include('layout/sidebar.php');

$nameErr = $categoryErr = $priceErr = $descriptionErr = "";

if(isset($_POST["add"])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $photo_name = "";

    // Validate Product Name
    if(empty($name)){
        $nameErr = "Product Name is required";
    } elseif(!preg_match("/^[a-zA-Z\s-]+$/", $name)) {
        $nameErr = "Only letters and white space allowed for Product Name";
    }

    // Validate Category
    if(empty($category)){
        $categoryErr = "Category is required";
    } elseif(!preg_match("/^[a-zA-Z\s]+$/", $category)) {
        $categoryErr = "Only letters and white space allowed for Category";
    }

   // Validate Price
        if (empty($price)) {
            $priceErr = "Price is required";
        } elseif (!is_numeric($price)) {
            $priceErr = "Price should be a valid number";
        } elseif ($price <= 0) {
            $priceErr = "Price must be greater than zero";
        } elseif (preg_match('/[^0-9.]/', $price)) {
            $priceErr = "Price should not contain any invalid characters";
        }

     // Validate Description
     if (empty($description)) {
        $descriptionErr = "Description is required";
    } elseif (strlen($description) < 10) {
        $descriptionErr = "Description must be at least 10 characters long";
    } elseif (strlen($description) > 1000) {
        $descriptionErr = "Description must not exceed 1000 characters";
    }

    // Check if all fields are valid
    if(empty($nameErr) && empty($categoryErr) && empty($priceErr) && empty($descriptionErr)){
        if(isset($_FILES['photo'])){
            $photo = $_FILES['photo']['tmp_name'];
            $photo_name = $_FILES['photo']['name'];
            $target = "../image/" . $photo_name;
            move_uploaded_file($photo, $target);
        }

        $conn = new mysqli("localhost", "root", "", "obms");
        if($conn->connect_error){
            die("Connection Error");
        }

        
        // Escape the description string or to use(')type of signs 
        $description = $conn->real_escape_string($description);

        $sql = "INSERT INTO product (product_name, category,  price,  product_photo, description) 
                VALUES ('$name', '$category', '$price', '$photo_name', '$description')";
        $r = $conn->query($sql);
        if($r){
            // getting product id from just insertes product
            $product_id = $conn->insert_id;
            // storing product id in session 
            $_SESSION['product_id'] = $product_id;
            header("Location: productdetails.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>


<title>Add New Product</title>
<link rel="stylesheet" href="assets/css/addproduct.css">

<div id="main">
    <div id="content">
        <h1>Add New Product</h1>
        
        <form action="AddProduct.php" method="post" enctype="multipart/form-data">
            Product Name: <input type="text" name="name" id="" required><br>
            <span class="error"><?php echo $nameErr; ?></span><br>

            Category: <input type="text" name="category" id="" required><br>
            <span class="error"><?php echo $categoryErr; ?></span><br>

            Price: <input type="text" name="price" id="" required><br>
            <span class="error"><?php echo $priceErr; ?></span><br>

            Photo: <input type="file" name="photo" id="" required><br>

            Description: <textarea name="description" id="" cols="30" rows="10" required ></textarea>
            <span class="error"><?php echo $descriptionErr; ?></span><br><br>

            <input type="submit" value="Add" name="add">
        </form>
    </div>
</div>
