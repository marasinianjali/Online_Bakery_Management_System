  <?php
   // Check if user is logged in
   session_start();
    if(isset($_SESSION['user_id'])) {
      //  include('manage_account.php');
    }
    include('headpart.php');
  ?>

    <div id="container">
        <div class="side-bar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Product</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">Manage Orders</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="banner">
            <img src="./assets/images/mainbanner.jpeg" />
        </div>
    </div>
    <div class="content">
        <h3>Buy your cakes from Bake & Break</h3>
        <div id="items">
            <div class="item-1">
                <img src="./assets/images/black forest cake 1.jpg" alt="item">
                <p>Black Forest</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/fruitilicious cake.jpg" alt="item">
                <p>Fruitilicious Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/chocolate cake.jpg" alt="item">
                <p>Chocolate Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/velvet cake.jpg" alt="item">
                <p>Red Velvet Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/butterscotch.jpg" alt="item">
                <p>Butterscotch Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/easter cake.jpg" alt="item">
                <p>Easter Poster cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/womens cake.jpg" alt="item">
                <p>Women's Day Special Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/holi cake.jpg" alt="item">
                <p>Holi Special Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
            <div class="item-1">
                <img src="./assets/images/holi cake.jpg" alt="item">
                <p>Holi Special Cake</p>
                <span class="price">Rs.1200</span>
                <a href="#" class="order" title="order">ORDER THIS</a>
            </div>
        </div>
    </div>

    <div id="footer">
        <h4>Bake & Break</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae hic ex nihil
            totam earum dicta atque, voluptate quo suscipit neque adipisci dolor reiciendis quisquam possimus quasi
            omnis rem fugiat tempore?</p>

        <div class="footer-icon">
            <a href="https://www.facebook.com/">
                <i class="fa-brands fa-square-facebook"></i>
            </a>
            <a href="https://www.instagram.com/">
                <i class="fa-brands fa-square-instagram"></i>
            </a>
            <a href="https://www.instagram.com/">
                <i class="fa-brands fa-square-twitter"></i>
            </a>
            <a href="https://www.instagram.com/">
                <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="https://www.instagram.com/">
                <i class="fa-brands fa-google-plus"></i>
            </a>


        </div>
        
    </div>
    <div class="copyrights">
        <p>Copyright @2024 All rights reserved | This template is made by Bake & Break etc</p>
    </div>
</body>

</html>