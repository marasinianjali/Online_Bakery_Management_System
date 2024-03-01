<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>

    <link rel="stylesheet" href="./assets/css/product.css">
</head>
    <body>
    <div id="main">
        <div id="content">
            <h1>Product Details</h1>
            <span style="width:100%;"><a href="addProduct.php" style="float:right; margin:10px;">Add Product</a></span>
            <div class="product-container">
                <?php
                $i=1;
                $conn= new mysqli("localhost","root","","obms");
                if($conn->connect_error){
                    die("Connection Error");
                }
                $sql="select * from product";
                $r=$conn->query($sql);
                while($row=$r->fetch_assoc()){
                    $name=$row['name'];
                    $category=$row['category'];
                    $price=$row['price'];
                    $photo=$row['photo'];
                    if($photo==""){
                        $image='image/logo.png';
                    }
                    else{
                        $image='image/'.$photo;
                    }
                    ?>
                    <div class="product">
                        <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="product-image">
                        <div class="product-details">
                            <h3><?php echo $name; ?></h3>
                            <p><strong>Category:</strong> <?php echo $category; ?></p>
                            <p><strong>Price:</strong> <?php echo $price; ?></p>
                            <a href="#" class="view-edit">View/Edit</a>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>