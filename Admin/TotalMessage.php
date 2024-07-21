<?php
session_start();
include('layout/headpart.php');
$conn = new mysqli("localhost", "root", "", "obms");
if ($conn->connect_error) {
    die("Connection Error");
} 

// Selecting or fetching data form database from two different tables

$sql = "SELECT * FROM signup
    INNER JOIN messagedb ON signup.sid = messagedb.sid ";
$result = mysqli_query($conn, $sql);

// Error name is not fetching properly
?>

<link rel="stylesheet" href="assets/css/order.css">


<div class="main-div">
<?php    include('layout/sidebar.php'); ?> 
    <h1 class=to>Total Message</h1>
   
    <div class="orders-list">
    <table style="width:70%;" border="2">
        <tr>
            <th>S.N</th>
            <th>Message By</th>  
            <th>View Message</th> 
            <th>Send Date</th>
        </tr>
        <?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {    
        ?>
        <tr>
            <td><?php echo $count; ?></td> 
            <td><?php echo  $row['username']; ?></td>
            <td><?php echo $row['message']; ?>
                <img src="../image/<?php echo $row['photo']; ?>" width="80px">
            </td>
            <td><?php echo $row['created_at'] ;?></td>
        </tr>
        <?php
            $count++;
        }
        ?>
    </table>
</div>
 
    </div>
</div>


