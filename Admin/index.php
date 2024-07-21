<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

include('layout/headpart.php');
include('layout/sidebar.php');

$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];

    // Displaying that specific items status
    // fetch the status of each order individually.

    $sql = "SELECT status FROM orders_table WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_status = $row['status'];

    if ($action == 'confirmed') {
        if ($current_status != 'confirmed') {
            $sql = "UPDATE orders_table SET status = 'confirmed' WHERE order_id = $order_id";
            if (mysqli_query($conn, $sql)) {
                // Status changed successfully
            } else {
                // Error
            }
        }
    } elseif ($action == 'canceled') {
        if ($current_status != 'confirmed') {
            $sql = "UPDATE orders_table SET status = 'canceled' WHERE order_id = $order_id";
            if (mysqli_query($conn, $sql)) {
                // Status changed successfully
            } else {
                // Error
            }
        }
    }
}
$sql = "SELECT * 
FROM orders_table 
INNER JOIN signup ON orders_table.sid = signup.sid
INNER JOIN product ON orders_table.pid = product.pid  WHERE status = 'pending' ORDER BY orders_table.created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<title>Admin_Dashboard</title>
<link rel="stylesheet" href="./assets/css/dashboard.css">


<div class="main-div">
    <h1 class="to">New Orders</h1>
    <div class="orders-list">
        <table style="width:70%;" border="2">
            <tr>
                <th>S.N</th>
                <th>Order Date</th>
                <th>Order By</th>
                <th>Product Name</th>
                <th>Photo</th>
                <th>Weight (kg)</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Cake Type</th>
                <th>Message</th>
                <th>Delivery Date</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><img src="../image/<?php echo $row['product_photo']; ?>" height="50px" /></td>
                    <td><?php echo $row['product_weight']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><?php echo $row['cake_type']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="confirmed">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <input type="hidden" name="action" value="confirmed">
                            <button type="submit" <?php if ($row['status'] == 'confirmed' || $row['status'] == 'cancel') echo 'disabled'; ?> class="confirm">confirmed</button>
                        </form>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="canceled">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <input type="hidden" name="action" value="canceled">
                            <button type="submit" <?php if ($row['status'] == 'confirmed' || $row['status'] == 'canceled') echo 'disabled'; ?> class="cancel">canceled</button>
                        </form>
                    </td>
                </tr>
            <?php
                $count++;
            }
            ?>
        </table>
    </div>
</div>
