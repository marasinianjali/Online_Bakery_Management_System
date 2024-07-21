<?php
session_start();
include('layout/headpart.php');
include('layout/sidebar.php'); 


$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
} 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];

    // Check current status of the order
    $sql = "SELECT status FROM orders_table WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_status = $row['status'];

   
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_date'])) {
    $search_date = $_POST['search_date'];
    $sql = "SELECT * FROM orders_table WHERE DATE(created_at) = '$search_date' ORDER BY created_at DESC";
} else {
//     $sql = "SELECT * FROM orders_table ORDER BY created_at DESC";


// LET'S ADD TWO TABLE FIRST
$sql = "SELECT * 
FROM orders_table 
INNER JOIN signup ON orders_table.sid = signup.sid
INNER JOIN product ON orders_table.pid = product.pid 
ORDER BY orders_table.created_at DESC";
}

$result = mysqli_query($conn, $sql);
// $sql = "SELECT DISTINCT username FROM orders_tables";
// Using DESC FOR to display the newest order first 
// $sql = "SELECT * FROM orders_tables ORDER BY created_at DESC";
?>



<link rel="stylesheet" href="assets/css/order.css">


<div class="main-div">
    <!-- <div class="seconddiv"> -->
        <h1 class="to">Total Orders</h1>

        <!-- If the admin want to search order by date  -->
        <div class="date">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="search_date">Search by Date:</label>
                <input type="date" id="search_date" name="search_date">
                <button type="submit">Search</button>
            </form>
        </div>
        
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
                    <th>Delivery Date</th>
                    <th>Order Status</th>
                </tr>
                <?php
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // $username = $row['username'];
                    // $created_at = $row['created_at'];
                ?>
                <tr>
                    <td><?php echo $count; ?></td> <!-- Displaying serial number -->
                    <td><?php echo $row['created_at'];?></td>
                    <td><?php echo $row['username'];?></td> <!-- Displaying username --> 
                    <td><?php echo $row['product_name']; ?></td>
                    <td><img src="../image/<?php echo $row['product_photo']; ?>" height="50px"/></td>
                    <td><?php echo $row['product_weight']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['status'];?></td>
                </tr>
                <?php
                    $count++;
                }
                ?>
            </table>
        </div> 
    <!-- </div> -->
    
</div>



