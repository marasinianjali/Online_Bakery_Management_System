<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit(); 
}
include('layout/headpart.php');
include('layout/sidebar.php');


$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
}

$sid = $_SESSION['user_id'];
// Fetch additional information
$query = "SELECT * FROM signup 
    INNER JOIN customer_details ON signup.sid = customer_details.cid 
    AND signup.sid = '$sid' ";


$result_details = $conn->query($query);
if ($result_details->num_rows > 0) {
    $row_details = $result_details->fetch_assoc();
    $username = $row_details['username'];
    $email = $row_details['email'];
    $phone = $row_details['phone'];
    $address = $row_details['address'];
} else {
    $username = '';
    $email = '';
    $phone = '';
    $address = '';
}

// Fetching sid and pid 


// Store the product ID in a variable
$pid = $_SESSION['product_id'];


if(isset($_POST['submit'])){

   // form submission
    $delivery_date = $_POST['delivery_date'];
    $product_weight = $_SESSION['product_weight']; 
    $quantity = $_SESSION['quantity']; 
    $price = $_SESSION['total_price']; 
   
    
    if(empty($username) || empty($email) || empty($phone) || empty($address) || empty($delivery_date)) {
        $error_message = "All fields are required! Please First Complete your Information from going manage profile..";
    } else {
        // insertion if all the fields are complete

        $product_weight = $_SESSION['product_weight']; 
        $quantity = $_SESSION['quantity']; 
        $price = $_SESSION['total_price']; 
        $cake_type = $_SESSION['cake_type'];
        $message = $_SESSION['message'];
   
        // Assuming $sid contains the logged-in user's ID
        $cid = $sid;
        
        $sql = "INSERT INTO orders_table(sid, cid, pid,  product_weight,
                 quantity, total_price, cake_type, message,  delivery_date) 
                VALUES ('$sid', '$cid','$pid', 
                 '$product_weight', '$quantity', '$price', '$cake_type', '$message', '$delivery_date')";
        $r = $conn->query($sql);

        if ($r) {
            $success_message = "Order placed successfully.";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>

<link rel="stylesheet" href="./assets/css/confirm_order.css">
 <div class="message-container">
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
<div class="main-div">
   
    <form action="" method="post" enctype="multipart/form-data">
        <h4>Bill</h4>
        <hr>
        <table>
            <tr>
                <td><label>  Deliver to:</label></td>
                <td> <input type="text" name="username" 
            value="<?php echo $username; ?>" readonly ></td>
            </tr>

            <tr>
                <td><label > Contact Number:</label></td>
                <td> <input type="text" name="phone" value="<?php echo $phone; ?>" readonly > </td>
            </tr>
            <tr>
                <td><label > Contact Address: </label></td>
                <td><input type="text" name="address" value="<?php echo $address; ?>" readonly >  </td>
            </tr>
           

            <tr>
                <td><label >Email to: </label></td>
                <td> <input type="text" name="email" value="<?php echo $email; ?>" readonly> </td>
            </tr>
        </table>


         
            <p>Bill to the same address <a href="manage_profile.php">Edit</a></p> 
            <hr>
            
        <table style="width:70%;" border="2" id="table2">
            <tr>
                <th>Name</th><th>Photo</th><th>Weight (kg)</th><th>Quantity</th><th>Cake Type</th><th>Price</th>
            </tr>
            <tr>
                <td><?php echo $_SESSION['product_name']; ?></td>
                <td><img src="image/<?php echo $_SESSION['product_photo']; ?>" height="80px"/></td>
               
                <td><?php echo $_SESSION['product_weight']; ?></td>
                <td><?php echo $_SESSION['quantity']; ?></td>
                <td><?php echo $_SESSION['cake_type']; ?></td>
               <td> <?php echo $total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : ''; ?> </td>
            </tr>
        </table>
        <p> Your Message: <?php echo $_SESSION['message'];?></p>
        <!-- Delivery Date -->
    <label for="delivery_date">Delivery Date:</label>
    <input type="date" id="delivery_date" name="delivery_date"  min="<?php echo date('Y-m-d'); ?>" required>
    <p>We may contact you before confirming your order.</p>
    <hr>
        <button type="submit" class="order" name="submit">Place Order</button>
    </form>
</div>

<!-- <?php
    include('layout/footer.php');
?> -->
