<?php
include('layout/headpart.php');

?>
 <link rel="stylesheet" href="./assets/css/productdetails.css">
 
<!-- Main Part start-->
    <div id="main">
        <!-- Sidebar Part start-->
       <?php    include('layout/sidebar.php');   ?> 
        <!-- Sidebar Part end-->
        <!-- Content Part start-->
        <div id="content">
            <h1 class="p-details">Product Details</h1>
            <span style="width:70%;"><a href="addProduct.php" class="add-product-button">Add Product</a></span>
            <table style="width:70%;" border="1">
                <tr>
                    <th>SN</th><th>Name</th><th>Category</th><th>Price</th><th>Photo</th><th colspan="2">Action</th>
                </tr>
                <?php
                session_start();
                
                $i=1;
                $conn= new mysqli("localhost","root","","obms");
                if($conn->connect_error){
                    die("Connection Error");
                }
                //  $id = $_SESSION['id'];
                $sql="SELECT * FROM product ORDER BY created_at DESC ";
                $r=$conn->query($sql);
                while($row=$r->fetch_assoc()){
                   
                    $product_name=$row['product_name'];
                    $category=$row['category'];
                    $price=$row['price'];
                    $product_photo=$row['product_photo'];
                    $product_id = $row['pid'];   // product ID here
                    if($product_photo==""){
                        $img='../image/logo.png';
                    }
                    else{
                    $img='../image/'.$product_photo;
                    }
                    echo "
                    <tr><td>$i</td><td>$product_name</td><td>$category</td><td>$price</td>
                    <td><img src='$img' height='50px'/><td><a href='edit_product.php?id=$product_id'>Edit</a></td>
                    <td><a href='delete_product.php?id=$product_id'>Delete</a></td>
                  
                    </tr>
                    ";
                    $i++;
                }
                ?>
            </table>
        </div>
        <!-- Content Part end-->
    </div>
     <!-- Main Part End-->