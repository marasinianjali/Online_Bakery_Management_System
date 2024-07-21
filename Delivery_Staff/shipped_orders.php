<?php
session_start();
include('layout/headpart.php');
include('layout/sidebar.php');

// Connecting with database
$conn = new mysqli("localhost", "root", "", "obms");
if($conn->connect_error){
    die("Connectin Error");
}

// Out for delivery button
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];
    // Displaying that specific items status 
    // fetch the status of each order individually.

    $sql = "SELECT status FROM orders_table WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $current_status = $row['status'];

    // Updating status to out for delivery
    if ($action == 'delivered') {
        if ($current_status != 'delivered') {
            $sql = "UPDATE orders_table SET status = 'delivered' WHERE order_id = $order_id";
            if (mysqli_query($conn, $sql)) {
                // Status changed successfully
            } else {
                // Error
            }
        }
    }
}


// Fetching the information related orders form database that are approved by admin to delivered

$sql = "SELECT * 
FROM orders_table 
INNER JOIN signup ON orders_table.sid = signup.sid
INNER JOIN product ON orders_table.pid = product.pid 
INNER JOIN customer_details ON orders_table.cid = customer_details.cid
WHERE status = 'shipped' ORDER BY orders_table.created_at DESC";

//$sql  = "SELECT * FROM orders_table WHERE status = 'confirm' ORDER BY created_at DESC";
$result  = mysqli_query($conn, $sql);
?>
<link rel="stylesheet" href="./assets/css/dashboard.css">
<div class="confirmorder">
    <h3 class="conf-order">Shipped Orders are here</h3>
    <div class="orderlist">
        <table style="width:70%;" border="2">
            <tr>
                <th>S.N</th>
                <th>Order Date</th>
                <th>Delivery Date</th>
                <th>Order By</th>
                <th>Contact Address</th>
                <th>Product Name</th>
                <th>Product Photo</th>
                <th>Total Price</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
            <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $row['created_at'];?></td>
                <td><?php echo $row['delivery_date'];?></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['product_name'];?></td>
                <td> <img src="../image/<?php echo $row['product_photo'];?>" height="50px" /></td>
                <td><?php echo $row['price'];?></td>
                <td><?php echo $row['status'];?></td>
                <td>
                    
                   <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="delivered">
                   <input type="hidden" name="order_id" value="<?php echo $row['order_id']?>">
                   <input type="hidden" name="action" value="delivered">
                   <button type="submit" <?php if($row['status'] == 'delivered') echo 'disabled';?> class=" delivery">delivered</button>
                   </form>
                </td>
            </tr>
            <?php
                $count++;
            }
            ?>
        </table>
    </div>
    <div class="back">
        <a href="index.php" >Back to Dashboard</a>
    </div>
</div>