<?php
session_start();
include('layout/headpart.php');
include('layout/sidebar.php');

$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
}

$sql = "SELECT * 
FROM orders_table 
INNER JOIN product ON orders_table.pid = product.pid 
WHERE status = 'shipped'
ORDER BY orders_table.created_at DESC";

//$sql = "SELECT * FROM orders_table WHERE status = 'cancel'";
$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="assets/css/order.css">

<?php    include('layout/sidebar.php'); ?> 
<div class="main-div">
    <h3 class="to">List of Shipped Product </h3>
    <div class="orders-list">
        <table style="width:70%;" border="2">
            <tr>
                <th>Product Name</th>
                <th>Photo</th>
                <th>Weight (kg)</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Delivery Date</th>
                <th>Order Date</th>
                <th>Order Status</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><img src="../image/<?php echo $row['product_photo']; ?>" height="50px"/></td>
                    <td><?php echo $row['product_weight']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['created_at'];?></td>
                    <td><?php echo $row['status'];?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <div class="back">
        <a href="index.php" >Back to Dashboard</a>
    </div>
</div>


