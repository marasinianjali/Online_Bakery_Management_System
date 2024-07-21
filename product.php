  
<link rel="stylesheet" href="./assets/css/product.css">

      
        <?php
        // Start session
        session_start();
        // if(!isset($_SESSION['login'])){
        //     header("Location:login.php");
        //}
        include('layout/headpart.php');
        include('layout/sidebar.php');
        ?>
 <div id="main">
    <div id="content">
        
          <h2 class="details">Product Details</h2>
        <div class="product-container">
            <?php
            $i=1;
            // Retrieve the category parameter from the URL
            $category = $_GET['category'] ?? ''; // Default to empty string if parameter not set

            $conn= new mysqli("localhost","root","","obms");
            if($conn->connect_error){
                die("Connection Error");
            }
            // $sql="SELECT * FROM product ORDER BY created_at DESC";
            // if (!empty($category)) {
            //     $sql .= " WHERE category = '$category'";
            // }
            // Check if category parameter is set in the URL
            if (isset($_GET['category'])) {
                $category = $_GET['category'];
                // display all products based on the selected category
                $sql = "SELECT * FROM product WHERE category = '$category' ORDER BY created_at DESC";
            } else {
                // If category parameter is not set, then display all the other products
                $sql = "SELECT * FROM product ORDER BY created_at DESC";
            }
            
            $r=$conn->query($sql);
            while($row=$r->fetch_assoc()){
                $product_name=$row['product_name'];
                $category=$row['category'];
                $price=$row['price'];
                $product_photo=$row['product_photo'];
                if($product_photo==""){
                    $image='image/logo.png';
                }
                else{
                    $image='image/'.$product_photo;
                }
                ?>
                <div class="product">
                    <img src="<?php echo $image; ?>" alt="<?php echo $product_name; ?>" class="product-image">
                    <div class="product-details">
                        <h3><?php echo $product_name; ?></h3>
                        <p><strong>Category:</strong> <?php echo $category; ?></p>
                        <p><strong>Price:</strong> <?php echo $price; ?></p>
                        <?php
                       
                            // Pass product ID as a parameter in the URL
                            echo '<a href="product_order.php?id=' . $row['pid'] . '" class="buy">View This</a>';
                        ?>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
   
</div>
<!-- 
<?php
   include('layout/footer.php');
   ?> -->

