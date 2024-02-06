<?php
session_start();
include 'connection.php';

if(isset($_POST['profilebtn'])){
    header('location:profile.php');
}


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $firstname=$_SESSION['firstName'];
} 
if(isset($_GET['orderId'])){

    $order_id=$_GET['orderId'];
    $product_id=$_GET['productId'];
    $sql="UPDATE ordered_items
    SET status = 'shipped'
    WHERE order_id= $order_id && product_id= $product_id;";
    if(mysqli_query($connect, $sql)){
       
        header("location:orderList.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
    td{
        font-size: 1.5rem;
        padding: 0;
    }
</style>
</head>
<body>

    <header>
        <?php 
        include 'header.php';
        ?>
        <div class="down-box"></div>
    </header>


    <div class="productsTable" style=" margin: 0; padding: 0;display: flex; flex-direction: column; align-items: center;">
        <h2 class="messages">
        <?php
        if(isset($_GET['error'])){
            if($_GET['error']=='successfullyDeleted'){
                echo "Successfully Deleted The Item";
            }
        }
        ?>
        </h2>
        <h2>order List</h2>
        <table style="width: 98vw;font-size: 1.5rem; margin: 3rem;">
            <thead>
                <td><b>customer name</b></td>
                <td><b>ordered items</b></td>
                <td><b>quantity</b></td>
                <td><b>email</b></td>
                <td><b>address</b></td>
                <td><b>Date</b></td>
                <td><b>status</b></td>
                <td><b>Update <br> status</b></td>
            </thead>
            
            <?php
            

            $sql = "SELECT distinct * FROM `product` INNER JOIN 
            `ordered_items` ON ordered_items.product_id=product.product_ID INNER JOIN orders ON orders.order_id= ordered_items.order_id";
            $result = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
               ?>
                
                <tr>
                    <td><?php echo $row['customer'];?></td>
                    <td><?php echo $row['bike']." ".$row['name']; ?></td>
                    <td><?php echo $row['count']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['address'].",".$row['province'].",".$row['postal_code']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    

                    <td id="table-btn" style="display: flex; background-color: #e75b24;">
                    <a href="orderList.php?orderId=<?php echo $row['order_id']; ?>&productId=<?php echo $row['product_id']; ?>"><button class="cancelbtn" name="edit">update</button></a>                       
                    </td>
                </tr>
            <?php 
            }
            ?>
        </table>

    
        
    </div>


    <?php
        include_once 'footer.php';
    ?>


    
   
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>   
</body>
</html>