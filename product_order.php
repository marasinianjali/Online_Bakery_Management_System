<?php
session_start();
include ('layout/headpart.php');
include ('layout/sidebar.php');

$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
}


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM product WHERE pid = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}
if (isset($_POST['submit'])) {
    $_SESSION['product_name'] = $product['product_name'];
    $_SESSION['product_weight'] = $_POST['cake-weight'];
    $_SESSION['quantity'] = $_POST['qty'];
    $_SESSION['total_price'] = $_POST['total-price'];
    $_SESSION['product_photo'] = $_POST['pphoto'];
    $_SESSION['cake_type'] = $_POST['cake_type'];
    $_SESSION['message'] = $_POST['message'];
    // Redirect to billing page
    header("Location: confirm_order.php");
    exit(); // Make sure to exit after redirect
}
?>
<link rel="stylesheet" href="./assets/css/product_order.css">
<h1>Product Details</h1>
<form method="post" action="">
    <div class="product-container">
        <div class="product-details">
            <div class="product-image">
                <img src="image\<?php echo $product['product_photo']; ?>" alt="<?php echo $product['product_name']; ?>">
                <input type="hidden" name="pphoto" value="<?php echo $product['product_photo']; ?>">
            </div>
            <div class="product-info">
                <h2><?php echo $product['product_name']; ?></h2>
                <p>Price: <?php echo $product['price']; ?></p>
                <hr>
                <div class="cake-details">
                    <p>Cake Weight:</p>
                    <div class="weight-options">
                        <input type="radio" id="0.5pounds" name="cake-weight" value="0.5" class="cake-weight"
                            onclick="updateTotalPrice()">
                        <label for="0.5pounds" style="font-size:20px">0.5pounds</label>
                        <input type="radio" id="1pounds" name="cake-weight" value="1" class="cake-weight"
                            onclick="updateTotalPrice()" checked>
                        <label for="1pounds" style="font-size:20px">1pounds</label>
                        <input type="radio" id="2pounds" name="cake-weight" value="2" class="cake-weight"
                            onclick="updateTotalPrice()">
                        <label for="2pounds" style="font-size:20px">2pounds</label>
                        <input type="radio" id="3pounds" name="cake-weight" value="3" class="cake-weight"
                            onclick="updateTotalPrice()">
                        <label for="3pounds" style="font-size:20px">3pounds</label>
                    </div>
                    Cake Type:
                    <select name="cake_type" required>
                        <option value="egg">Egg</option>
                        <option value="egg_less">Egg Less</option>
                    </select>
                    <p>Category: <?php echo $product['category']; ?></p>
                </div>
                <div class="quantity">
                    <button type="button" class="minus">-</button>
                    <input type="text" value="1" class="quantity-input" readonly name="qty">
                    <button type="button" class="plus">+</button>
                    <p>only 10 available at one time.</p>
                </div>
                <div class="price">

                    <input type="text" id="total-price" name="total-price" value="<?php echo $product['price']; ?>"
                        readonly>
                    <!-- <p>Total price: <span id="total-price"> <?php echo $product['price']; ?> </span></p> -->
                </div>
                <!-- Hidden input field to pass the product ID -->
                <!-- <input type="hidden" name="pid" value="<?php echo $_SESSION['product_id']; ?>"> -->
                <!-- Storing pid in session  -->
                <!-- <?php echo $_SESSION['product_id'] = $product_id; ?> -->
                <!-- <?php if (isset($_SESSION['product_id'])): ?>
    <input type="hidden" name="pid" value="<?php echo $_SESSION['product_id']; ?>">
<?php endif; ?> -->

                <!-- Storing product_id as a URL in order button for further use  -->
                <!-- <a href="confirm_order.php?product_id=<?php echo $_SESSION['product_id']; ?>" class="order">Order</a> -->

                <p>Message:</p>

                <textarea id="textarea" placeholder="What would you like to write on the cake?"
                    name="message"></textarea>

                <button type="submit" name="submit" class="order">Order</button>

            </div>
        </div>
    </div>
    <div class="des">
        <h3>Product Details</h3>
        <p> Product Description: <br> </p>
       <p> <?php echo $product['description']; ?> </p> 

    </div>
</form>

<script>
    //     document.querySelectorAll('.cake-weight').forEach(function(weight) {
    //     weight.addEventListener('click', function() {
    //         document.querySelector('.quantity-input').value = 1; // Set quantity to 1 when weight is clicked
    //         updateTotalPrice();
    //     });
    // });
    function updateTotalPrice() {
        var wt = parseFloat(document.querySelector('input[name="cake-weight"]:checked').value);
        var quantity = parseInt(document.querySelector('.quantity-input').value);
        var pricePerCake = parseFloat(<?php echo $product['price']; ?>);
        var totalPrice = pricePerCake * wt * quantity;
        document.getElementById('total-price').value = totalPrice.toFixed(2);
    }

    document.querySelector('.plus').addEventListener('click', function () {
        var quantityInput = document.querySelector('.quantity-input');
        var quantity = parseInt(quantityInput.value);
        if (quantity < 10) {
            quantityInput.value = quantity + 1;
            updateTotalPrice();
        }
    });

    document.querySelector('.minus').addEventListener('click', function () {
        var quantityInput = document.querySelector('.quantity-input');
        var quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
            updateTotalPrice();
        }
    });
    // Update the hidden input value with the total price
    document.querySelector('input[name="total-price"]').value = totalPrice.toFixed(2);
</script>