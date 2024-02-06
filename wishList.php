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


if(isset($_POST['remove-btn'])){
    $product_id = $_POST['product_id'];
    $remove_product_sql = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $remove_product = mysqli_query($connect , $remove_product_sql);

    if ($remove_product) {
        echo "<p class='success-msg-box style='display: none;'' >Item remove from wishlist successfully</p>";
    } else {
        echo "<p class='error-msg-box' style='display: none;' >Item not found in the wishlist</p>";
    }
}

if(isset($_POST['addCart-btn'])){
    $product_id = $_POST['product_id'];
    $check_cart_sql = "SELECT * FROM cart WHERE user_id =$user_id AND product_id = $product_id";
    $check_cart = mysqli_query($connect , $check_cart_sql);

    if (mysqli_num_rows($check_cart)) {
        echo "<p class='error-msg-box' style='display: none;'> Product is already in the cart.</p>";
    }else{
        $add_to_cart_sql = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id);";
        $add_to_cart = mysqli_query($connect , $add_to_cart_sql);

        $remove_product_sql = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $remove_product = mysqli_query($connect , $remove_product_sql);

        echo "<p class='success-msg-box style='display: none;' >Product added to the cart successfully!</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist | <?php echo $firstname ;?></title>
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


    
    
    <section class="popular wishlist">
        <h1 class="heading">Wish<span>List</span></h1>
        <div class="row-container">
            <?php
                
                $select_wishlist_items_sql = "SELECT * FROM wishlist INNER JOIN product ON wishlist.product_id = product.product_ID 
                WHERE wishlist.user_id = '$user_id' ";
                $wishlist_items = mysqli_query($connect ,$select_wishlist_items_sql) ;
                
                if(mysqli_num_rows($wishlist_items)){
                    while($wishlist_item = mysqli_fetch_assoc($wishlist_items)) {?>
                        <div class="row">
                            <img  src=<?php echo $wishlist_item['image_addresse'] ?> alt="">
                            <div class="descrption col3">
                                <h2><?php echo $wishlist_item['name'] ?></h2>
                                <p>Rs. <?php echo $wishlist_item['price'] ?></p>
                                <p><?php echo $wishlist_item['bike'] ?></p>
                            </div>
                            <div class="option col3">
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $wishlist_item['product_id'] ?>" name="product_id">
                                    <input type="submit" name="addCart-btn"  class="btn" value="Add To Cart ">
                                    <input type="submit" name="remove-btn" class="btn" value="Remove ">
                                </form>
                            </div>    
                        </div>
                    <?php
                    }    
                }else{?>
                    <section class="popular box-empty">
                        <div class="box-container" style="padding: 4rem 2rem;">
                            <div class="box">
                                <h1 style="font-size: 30px;">wish List Is Empty!!!!</h1>
                                <a href="shop.php" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </section>
                <?php 
                }
            ?>    
        </div>
    </section>

    <?php
        include 'footer.php';
    ?>
  

    
</body>
</html>