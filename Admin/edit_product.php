<?php
include('layout/headpart.php');

$conn = new mysqli("localhost", "root", "", "obms");
if($conn->connect_error){
    die("Connection Error");
}

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE pid = '$product_id'";
    $result  = $conn -> query($sql);
    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        $product_name = $row['product_name'];
        $category = $row['category'];
        $price = $row['price'];
        $product_photo = $row['product_photo'];
        if($product_photo==""){
            $img='../image/logo.png';
        }
        else{
            $img='../image/'.$product_photo;
        }
    }
}

if(isset($_POST['update'])){
    $new_product_name = $_POST['name'];
    $new_category = $_POST['category'];
    $new_price = $_POST['price'];
    // Process file upload if a new file is provided
    if($_FILES['photo']['name'] != ""){
        $new_photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "../image/".$new_photo);
    } else {
        // If no new file provided, keep the existing one
        $new_photo = $product_photo;
    }
    $sql = "UPDATE product SET product_name = '$new_product_name',
    category = '$new_category', price = '$new_price', product_photo = '$new_photo'
    WHERE pid = '$product_id' ";
    $conn->query($sql);
    // Redirect after update
    header("Location: productdetails.php");
    exit();
}
?>

<title>Update Product</title>
<link rel="stylesheet" href="assets/css/addproduct.css">
   
<div id="main">
    <div id="content">
        <h1>Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            Product Name: <input type="text" name="name" value="<?php echo $product_name ;?>"><br>
            Category: <input type="text" name="category" value="<?php echo $category ;?>" ><br>
            Price: <input type="text" name="price" value="<?php echo $price ;?>" ><br>
            Product Image: 
            <img src='<?php echo $img ?>' height='50px'/><br>
            <input type="file" name="photo"><br>
                
            <input type="submit" value="Update" name="update">
        </form>
    </div>
</div>
