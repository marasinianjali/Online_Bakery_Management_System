<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit(); // Make sure to exit after redirect
}

include ('layout/headpart.php');
include ('layout/sidebar.php');

$conn = new mysqli("localhost", "root", "", "obms");

if ($conn->connect_error) {
    die("Connection Error");
}
$order_id = $_SESSION['user_id']; // Get the user ID from the session

$sql = "SELECT * 
FROM orders_table 
INNER JOIN product ON orders_table.pid = product.pid 
WHERE sid = $order_id
ORDER BY orders_table.created_at DESC";

//$sql_fetch_details = "SELECT * FROM orders_table WHERE sid = $order_id";

$result_details = $conn->query($sql);

// Check if the cancel button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_order'])) {
    $order_id_to_cancel = $_POST['order_id'];

    // Update the order status to 'cancel' in the database
    $sql_update_status = "UPDATE orders_table SET status = 'canceled' WHERE order_id = $order_id_to_cancel";
    if ($conn->query($sql_update_status) === TRUE) {
        // Redirect or display success message
        header("Location: manage_order.php");
        exit();
    } else {
        echo "Error updating order status: " . $conn->error;
    }
}

?>

<link rel="stylesheet" href="./assets/css/manage_order.css">

<div class="main-div">
    <form action="" method="post" enctype="multipart/form-data">

        <?php if ($result_details->num_rows > 0) { ?>
            <h4>My Orders</h4>
            <p>All the orders you made till now are here</p>
            <hr>

            <table  border="2">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Weight (kg)</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
                <?php
                $sn = 1;
                while ($row_details = $result_details->fetch_assoc()) {
                    ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $row_details['product_name'] ?></td>
                        <td><img src="image/<?php echo $row_details['product_photo']; ?>" height="50px" /></td>
                        <td><?php echo $row_details['product_weight'] ?></td>
                        <td><?php echo $row_details['quantity'] ?></td>
                        <td><?php echo $row_details['price'] ?></td>
                        <td><?php echo $row_details['created_at']; ?></td>
                        <td><?php echo $row_details['delivery_date']; ?></td>
                        <td>
                            <?php
                            $status = $row_details['status'];
                            if ($status == 'confirmed') {
                                echo "Confirmed ";
                            } elseif ($status == 'delivered') {
                                echo "Delivered";
                            } elseif ($status == 'canceled') {
                                echo "Cancelled ";
                            } else {
                                echo $status; // For other status values
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($status != 'confirmed' && $status != 'delivered' && $status != 'canceled') { ?>
                                <form action="" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $row_details['order_id']; ?>">
                                    <button type="submit" name="cancel_order" class="cancel">Cancel</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
           
        <?php } else { ?>
            <div class="no-order">
            <p class="no-orders">No orders found.</p>
            </div>
        <?php } ?>
    </form>
</div>

<!-- <?php
include ('layout/footer.php');
?> -->
