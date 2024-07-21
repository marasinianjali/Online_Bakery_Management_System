<?php
session_start();
include('layout/headpart.php');
$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
} 
// Selecting or fetching data form database from two different tables

$sql = "SELECT * FROM signup
    INNER JOIN customer_details ON signup.sid = customer_details.cid  ";

$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="assets/css/order.css">

<?php    include('layout/sidebar.php'); ?> 

<div class="main-div">
        <h1 class="to">Total Users</h1>

        <div class="orders-list">
            <table style="width:70%;" border="2">
                <tr>
                    <th>S.N</th>
                    <th>User Name</th>
                    <th>Email</th>  
                    <th>Contact Number</th>
                    <th>Contact Address</th>
                </tr>
                <?php
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td> <!-- Displaying serial number -->
                    <td><?php echo  $row['username']; ?></td> 
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                </tr>
                <?php
                    $count++;
                }
                ?>
            </table>
        </div> 
    <!-- </div> -->
    
</div>



