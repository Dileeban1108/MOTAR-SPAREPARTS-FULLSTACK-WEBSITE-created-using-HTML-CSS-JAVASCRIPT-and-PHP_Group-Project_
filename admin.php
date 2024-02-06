<?php
include 'connection.php';
session_start();

if(isset($_POST['profilebtn'])){
    header('location:profile.php');
}

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $firstname =  $_SESSION['firstName'];
    $lastname  =  $_SESSION['lastName'];
    $mobile    =  $_SESSION['phoneNumber'];
    $email     =  $_SESSION['user_email'];
    $addres1  =  $_SESSION['addressLine1'];
    $addres2  =  $_SESSION['addressLine2'];
    $addres3  =  $_SESSION['addressLine3'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>



    <header>
        <?php 
        include 'header.php';
        ?>
        <div class="down-box"></div>
    </header>

    <section  class="profileData">
        <h2 class="heading">Admin <span>Panel</span></h2>
        <div class="orderdiv">
            <div class="controlbtn" style="display:flex;justify-content:center;align-items: center;flex-direction: column;">
                <a href="addProduct.php"><button  class="btn" style="width: 50vw;">Add Item</button></a>
                <a href="productList.php"><button class="btn" style="width: 50vw;">Show Product List</button></a>
                <a href="addBrand.php"><button class="btn" style="width: 50vw;" >Add/Delete brand</button></a>
                <a href="orderList.php"><button class="btn" style="width: 50vw;">Order List</button></a>
                <a href="#"><button class="btn" style="width: 50vw;">Messages</button></a> 
            </div>
        </div>
    </section>

    <?php
        include_once 'footer.php';
    ?>
   
    
</body>
</html>