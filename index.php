  <?php
   // Check if user is logged in
   session_start();
    if(isset($_SESSION['user_id'])) {
      //  include('manage_account.php');
    }
    include('layout/headpart.php');
 
    $conn = new mysqli("localhost", "root", "", "obms");

        // Check database connection
        if ($conn->connect_error) {
            die("Connection Error: " . $conn->connect_error);
        }
    // Fetch existing profile information
   
    // // If logged in, get user information
    // $username = $_SESSION['username'];
    include('layout/sidebar.php');
 ?>
 

        <div class="banner">
            <img src="./assets/images/mainbanner.jpeg" />
        </div>
    </div>
    <div class="content">
        <h3>Buy your cakes from Bake & Break</h3>

<!-- here will the be the box images with link to the database  -->
<!-- categories -->
        <h3>Some of Our categories</h3>
        <div class="cake-categories">
            <a href="product.php?category=Birthday Cake">
                <div class="card">
                    <img src="./assets/images/birthday-banner.jpg" alt="Birthday Cake">
                        
                </div>
                <h4 class="cake-type">Birthday Cake</h4>    
            </a>
            <a href="product.php?category=Wedding Cake">
                <div class="card">
                    <img src="./assets/images/wedding-banner.jpg" alt="Wedding Cake">
                </div>
                <h4 class="cake-type">Wedding Cake</h4>
            </a>
            <a href="product.php?category=Anniversary Cake">
                <div class="card">
                    <img src="./assets/images/anniversary-banner.jpg" alt="Anniversary Cake">
                </div>
                <h4 class="cake-type">Annniversary Cake</h4>
            </a>
            <a href="product.php?category=Same Day Delivery">
                <div class="card">
                    <img src="./assets/images/sameday-delivery.png" alt="24hrs Deliver Cake">
                </div>
                <h4 class="cake-type">Same Day Delivery</h4>
            </a>
        </div>
            

        <h3>Most Popular Flavor</h3>
         <div id="items"> 
            
            <div class="item-1">
                <a href="product.php"  title="order">
                    <img src="./image/black froest.jpg" alt="item">
                    <h4 class="cake-name">Black Forest</h4>
                </a>
            </div>
            <div class="item-1">
                <a href="product.php"  title="order">
                    <img src="./image/fruits.jpg" alt="item">
                    <h4 class="cake-name">Fruits cake</h4>
                </a>
            </div>
            <div class="item-1">
                <a href="product.php"  title="order">
                <img src="./image/chocolate.jpg" alt="item">
                <h4 class="cake-name">Chocolate cake</h4>
                </a>
            </div>
          
            <div class="item-1">
            <a href="product.php" title="order">
                <img src="./image/butterscotch.jpg" alt="item">
                <h4 class="cake-name">Butterscotch cake</h4>
            </a>
            </div>
            <div class="item-1">
                <a href="product.php"  title="order">
                    <img src="./image/oreo.jpg" alt="item">
                    <h4 class="cake-name">Oreo cake</h4>
                </a>
            </div>
            <div class="item-1">
                <a href="product.php"  title="order">
                    <img src="./image/red velvet.jpg" alt="item">
                    <h4 class="cake-name">Red Velvet Cake</h4>
                </a>
            </div>
            <div class="item-1">
                <a href="product.php"  title="order">
                    <img src="./image/truffel.jpg" alt="item">
                    <h4 class="cake-name">Trufflecake</h4>
                </a>
            </div>

            <div class="item-1">
                <a href="product.php" title="order">
                    <img src="./image/white forest.jpg" alt="item">
                    <h4 class="cake-name">White Forest</h4>
                </a>
            </div>
            
            <div class="item-1">
                <a href="product.php" title="order">
                    <img src="./image/easter (1).jpg" alt="item">
                    <h4 class="cake-name">Easter Cake</h4>
                </a>
            </div>
           
        </div>
    </div>
  
   
   <?php
   include('layout/footer.php');
   ?>
