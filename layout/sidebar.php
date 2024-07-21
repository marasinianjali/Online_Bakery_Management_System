<div id="container">
        <div class="side-bar">
            <ul>
                <li><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
                <li><a href="product.php">Product</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                
                    <li><a href="manage_order.php">Manage Order</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>