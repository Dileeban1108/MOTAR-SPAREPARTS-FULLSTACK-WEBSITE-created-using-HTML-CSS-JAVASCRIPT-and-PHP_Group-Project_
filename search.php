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

if(isset($_POST['addCart-btn'])){
    if(isset($user_id))
        if($_SESSION['isAdmin']==='Yes'){
            echo "<p class='error-msg-box' style='display: none;'>Admins Cant Access</p>";
        }else {
            $product_id = $_POST['product_id'];

            $check_query = "SELECT * FROM product WHERE product_id = '$product_id'";
            $check = mysqli_query($connect , $check_query);
            $result=mysqli_fetch_assoc($check);

            if($result['quantity']>0){
            $check_query = "SELECT * FROM cart WHERE user_id ='$user_id' AND product_id = '$product_id'";
            $check = mysqli_query($connect , $check_query);

            if (mysqli_num_rows($check)) {
                echo "<p class='error-msg-box' style='display: none;'>Product is already in the cart</p>";
            }else{
                $add_to_cart_sql = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";
                $add_to_cart = mysqli_query($connect , $add_to_cart_sql);

                echo "<p class='success-msg-box' style='display: none;'>Product added to the cart successfully!</p>";
            }
        }else{
            echo "<p class='error-msg-box' style='display: none;'>not enough product!</p>";
        }
    }else{
        header("Location: login.php");
    }
}


if(isset($_POST['wishlist-btn'])){
    if($_SESSION['isAdmin']==='Yes'){
        echo "<p class='error-msg-box' style='display: none;'>Admins Cant Access</p>";
    }else{
        if(isset($user_id)){
            $product_id = $_POST['product_id'];

            $check_query = "SELECT * FROM wishlist WHERE user_id ='$user_id' AND product_id = '$product_id'";
            $check = mysqli_query($connect , $check_query);

            if (mysqli_num_rows($check)) {
                echo "<p class='error-msg-box' style='display: none;' >Product is already in the Wishlist</p>";
            }else{
                $add_to_wishlist_sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
                $add_to_wishlist = mysqli_query($connect ,$add_to_wishlist_sql);

                echo "<p class='success-msg-box' style='display: none;'>Product added to the wishlist successfully!</p>";
            }
        }else{
            header("Location: login.php");
        }
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Result</title>
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
        <div class="box-container">
        <?php
            if(isset($_POST['search'])){
                $search=$_POST['search-bar'];
                $url=$_POST['url'];
                if($search!== ""){
                $sql="SELECT * from product INNER JOIN brand on brand.brand_id = product.brand 
                    where name like '$search%' OR brand_name like '$search%' OR bike like '$search%' ;";
                $result=mysqli_query($connect,$sql);
                
                while($row=mysqli_fetch_assoc($result)){ 
                    $imgName=$row['image_addresse'];?>
                    <div class="box">
                        <img src="<?php echo $imgName; ?>" alt="Image">
                        <div class="box1">
                            <h3> <?php echo $row['name'] .$row['product_ID']; ?>  </h3>
                            <span class="description"> Suitable for <?php echo $row['bike'] ; ?> .</span>
                        </div>
                        <div class="box2">
                            <?php
                            $id=$row['product_ID'];
                            ?>
                            <form method="post">
                                <button   name="wishlist-btn" class="cart" style="width:50px;"><i class="fa-solid fa-heart"></i> </button>
                                <span class="price">Rs.<?php  echo $row['price'] ; ?> </span>
                                <button  name="addCart-btn" class="cart" style="width:50px;"><i class="fa-solid fa-cart-shopping"></i></button>
                                <input type="hidden" value="<?php echo $row['product_ID'] ?>" name="product_id">
                            </form>    
                        </div>
                    </div>  
                <?php 
                }
            }else{
                
                
                header("location:$url");
            }}
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