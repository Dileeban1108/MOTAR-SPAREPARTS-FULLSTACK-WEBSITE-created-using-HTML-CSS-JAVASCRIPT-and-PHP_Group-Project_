<?php

include 'connection.php';
session_start();

if(isset($_POST['profilebtn'])){
    header('location:profile.php');
}


if(isset($_SESSION['user_id'])){
    $user_id   = $_SESSION['user_id'];
    $firstname =  $_SESSION['firstName'];
    $lastname  =  $_SESSION['lastName'];
    $mobile    =  $_SESSION['phoneNumber'];
    $email     =  $_SESSION['user_email'];
    $addres1   =  $_SESSION['addressLine1'];
    $addres2   =  $_SESSION['addressLine2'];
    $addres3   =  $_SESSION['addressLine3'];
}
    

if(isset($_POST['updatebtn'])){
    if($_SESSION['isAdmin']==='Yes'){
        if (isset($_POST['firstname']) && $_POST['firstname'] !== '') {
            $firstname = $_POST['firstname'];
            $sql = "UPDATE `admin` SET firstName = '$firstname' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset($_POST['lastname']) && $_POST['lastname'] !== '') {
            $lastname = $_POST['lastname'];
            $sql = "UPDATE `admin` SET lastName = '$lastname' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset($_POST['mobile']) && $_POST['mobile'] !== '') {
            $mobile = $_POST['mobile'];
            $sql = "UPDATE `admin` SET phoneNumber = '$mobile' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql); 
            $isChange = 'Yes';
        }
        if (isset($_POST['email']) && $_POST['email'] !== '') {
            $email = $_POST['email'];
            $sql = "UPDATE `admin` SET email = '$email' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql); 
            $isChange = 'Yes';
        }
        if (isset($_POST['addres1']) && $_POST['addres1'] !== '') {
            $addres1 = $_POST['addres1'];
            $sql = "UPDATE `admin` SET addressLine1 = '$addres1' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset($_POST['addres2']) && $_POST['addres2'] !== '') {
            $addres2 = $_POST['addres2'];
            $sql = "UPDATE `admin` SET addressLine2 = '$addres2' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset( $_POST['addres3']) &&  $_POST['addres3'] !== '') {
            $addres3 = $_POST['addres3'];
            $sql = "UPDATE `admin` SET addressLine3 = '$addres3' WHERE admin_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }

        $_SESSION['firstName'] = $firstname;
        $_SESSION['lastName'] = $lastname;
        $_SESSION['phoneNumber'] = $mobile;
        $_SESSION['user_email'] = $email;
        $_SESSION['addressLine1'] = $addres1;
        $_SESSION['addressLine2'] = $addres2;
        $_SESSION['addressLine3'] = $addres3;

    }else{

        if (isset($_POST['firstname']) && $_POST['firstname'] !== '') {
            $firstname = $_POST['firstname'];
            $sql = "UPDATE users SET firstName = '$firstname' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset($_POST['lastname']) && $_POST['lastname'] !== '') {
            $lastname = $_POST['lastname'];
            $sql = "UPDATE users SET lastName = '$lastname' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset($_POST['mobile']) && $_POST['mobile'] !== '') {
            $mobile = $_POST['mobile'];
            $sql = "UPDATE users SET phoneNumber = '$mobile' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql); 
            $isChange = 'Yes';
        }
        if (isset($_POST['email']) && $_POST['email'] !== '') {
            $email = $_POST['email'];
            $sql = "UPDATE users SET email = '$email' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql); 
            $isChange = 'Yes';
        }
        if (isset($_POST['addres1']) && $_POST['addres1'] !== '') {
            $addres1 = $_POST['addres1'];
            $sql = "UPDATE users SET addressLine1 = '$addres1' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset($_POST['addres2']) && $_POST['addres2'] !== '') {
            $addres2 = $_POST['addres2'];
            $sql = "UPDATE users SET addressLine2 = '$addres2' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }
        if (isset( $_POST['addres3']) &&  $_POST['addres3'] !== '') {
            $addres3 = $_POST['addres3'];
            $sql = "UPDATE users SET addressLine3 = '$addres3' WHERE user_id = '$user_id'";
            $result=mysqli_query($connect,$sql);
            $isChange = 'Yes';
        }

        $_SESSION['firstName'] = $firstname;
        $_SESSION['lastName'] = $lastname;
        $_SESSION['phoneNumber'] = $mobile;
        $_SESSION['user_email'] = $email;
        $_SESSION['addressLine1'] = $addres1;
        $_SESSION['addressLine2'] = $addres2;
        $_SESSION['addressLine3'] = $addres3;

    }

    if($isChange === 'Yes'){
        echo "<p class='success-msg-box' style='display: none;' > Updated successfully </p>"; 
    }
    $isChange = 'End';


}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page | <?php echo $firstname ;?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <?php include 'msg-box.php' ?>
</head>
<body>

    <header>
        <?php 
        include 'header.php';
        ?>
        <div class="down-box">
        <div class="outter-box">
                <form action="search.php" method="post" enctype="multipart/form-data"> 
                    <input class="search-bar" name="search-bar" type="text" placeholder="Search Here...">
                    <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>">
                    <button class="search-icon" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </header>

    
    <section  class="profileData">
        <h1 class="heading">Profile <span>Details</span></h1>
        <div class="firstdev">
            <div class="col1">
                <div class="col2-2">
                    <div class="col1">
                        <i class="fa-solid fa-user"></i>
                    </div> 
                    <div class="col2">
                        <h2><?php echo $firstname." ".$lastname?> </h2>
                        <p><?php echo $mobile ?></p>
                        <p><?php echo $email ?></p>
                    </div>
                </div>
                <address><?php echo $addres1 ?></address>
                <address><?php echo $addres2 ?></address>
                <address><?php echo $addres3 ?></address>
            </div>
            <div class="col2">
                <h2>Update Your Profile Details:</h2>
               
                <form action="" method="post">
                    <div class="col2-2">
                        <div class="col2">
                            <input type="text" name="firstname" placeholder="First Name">
                            <input type="text" name="lastname" placeholder="Last Name">
                            <input type="text" name="mobile" placeholder="Mobile Number">
                            <input type="text" name="email" placeholder="Email">
                        </div>
                        <div class="col2">
                            <input type="text" name="addres1" placeholder="Address Line 1">
                            <input type="text" name="addres2" placeholder="Address Line 2">
                            <input type="text" name="addres3" placeholder="Address Line 3">
                            <input  type="submit" name="updatebtn" value="Update" class="btn">
                        </div>
                    </div>    
                </form>    
            </div>
        </div>                   
        
    <?php 
        if($_SESSION['isAdmin']==='Yes'){
        }else{?>
            <h2 class="heading">Order <span>Details</span></h2>
            <div class="orderdiv">
            <?php 
                $select_orders_sql = "SELECT distinct ordered_items.*,product.*,orders.date FROM `product` INNER JOIN 
                `ordered_items` ON ordered_items.product_id=product.product_ID INNER JOIN orders ON orders.order_id= ordered_items.order_id
                WHERE orders.user_id= $user_id";
                $select_orders = mysqli_query($connect,$select_orders_sql);

                if(mysqli_num_rows($select_orders)){ ?>
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>order status</th>

                        </tr>
                <?php
                    while($order = mysqli_fetch_assoc($select_orders)){?>
                        <tr>
                            <td><?php echo $order['bike'].' '.$order['name']; ?></td>
                            <td><?php echo $order['price']; ?></td>
                            <td><?php echo $order['count']; ?></td>
                            <td><?php echo $order['price'] * $order['count']; ?></td>
                            <td><?php echo $order['date'] ;?></td>
                            <td><?php echo $order['status'] ;?></td>
                        </tr>
                    <?php
                    } 
                    ?>
                    </table>
                    <h2 style="margin-top: 3rem;width:20%;margin-left:80%; background-color: white; padding: 1rem; border: 0.2rem var(--red) solid; border-radius: 5px;">
                    Total : Rs. <?php 
                    $sql="SELECT total from orders where user_id= $user_id;";
                    $result = mysqli_query($connect,$sql);
                    $total=0;
                    while($row=mysqli_fetch_assoc($result)){
                        $total=$total+$row['total'];
                    }
                    echo $total;
                    ; ?> </h2>
                <?php    
                }else{ ?>
                    <section class="popular box-empty">
                        <div class="box-container">
                            <div class="box">
                                <h1 style="font-size: 30px;">Not Orders Placed Yet!!!!</h1>
                                <a href="shop.php" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </section>
                <?php
                }
                ?>
            </div>
            <?php
        }
        ?>    
    </section>

    



    <?php
        include_once 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>

</body>
</html>