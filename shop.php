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

   
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
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


    <section class="popular" id="popular2">
        <h1 class="heading">Welcome to <span>Our Shop</span></h1>
        <div class="box-container">
        <?php 
            include "connection.php";
            $sql="SELECT * FROM  brand;";
            
            $result=mysqli_query($connect,$sql);

            while($row=mysqli_fetch_assoc($result)){ 
                $imgName=$row['image_address'];
                $id=$row['brand_id'];?>
                <div class="box">
                    <img class="brand" src="<?php echo $imgName ;?>" alt="">
                    <h3><?php echo $row['brand_name']; ?> </h3>
                    <a href="product.php?id=<?php echo $id ;?>" class="btn">shop now </a>
                </div>
            <?php 
            }
            ?>
        </div>
    </section>

    <?php
        include_once 'footer.php';
    ?>



    
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>
</body>
</html>