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

if(isset($_GET['user_id'])){
    $id=$_GET['id'];
    $user_id=$_GET['user_id'];
    $email=$_GET['email'];
 
    $sql="INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$id') ;";
    if(mysqli_query($connect, $sql)){
     header("location: index.php?error=successfullyAdded");
     exit();
 } 
 }

 if(isset($_POST['update'])){
    $count=$_POST['count'];
    $pid=$_POST['pid'];
    $uid=$_SESSION['user_id'];
    $updateQuantitySql = "UPDATE cart SET product_count = '$count' WHERE user_id = '$uid' AND product_id = '$pid'";
    mysqli_query($connect, $updateQuantitySql);

 }
 
 if(isset($_POST['remove'])){
    $count=$_POST['count'];
    $pid=$_POST['pid'];
    $uid=$_SESSION['user_id'];
    $updateQuantitySql = "DELETE from cart  WHERE user_id = '$uid' AND product_id = '$pid'";
    mysqli_query($connect, $updateQuantitySql);

 }


if(isset($_GET['pid'])){

    $pid=$_GET['pid'];
    $uid=$_GET['uid'];
    $sql="DELETE from cart where product_id = '$pid' && user_id=$uid;";
    if(mysqli_query($connect, $sql)){
        echo "<p class='success-msg-box style='display: none;' >Product Removefrom Cart successfully!</p>";
    }
}

$id=$_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart | <?php echo $firstname ;?></title>
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
        <h1 class="heading">Your <span>Cart</span></h1>
        <div class="row-container">
            <?php
                $net_total=0;
                $select_cart_items_sql = "SELECT * FROM cart INNER JOIN product ON cart.product_id = product.product_ID 
                WHERE cart.user_id = '$user_id' ";
                $cart_items = mysqli_query($connect ,$select_cart_items_sql);
                
                if(mysqli_num_rows($cart_items)){?>
                    <table>
                        <thead>
                            <td><b>Product Image</b></td>
                            <td><b>Product Name</b></td>
                            <td><b>Brand</b></td>
                            <td><b>Suitable Bike</b></td>
                            <td><b>Price</b></td>
                            <td><b>Quantity</b></td>
                            <td><b>Update</b></td>
                        </thead>
                <?php
                    while($cart_item = mysqli_fetch_assoc($cart_items)) {
                        $product_id = $cart_item['product_ID'];
                        $brand = $cart_item['brand'];

                        $brands_sql = "SELECT * FROM brand where brand_id='$brand';";
                        $brands = mysqli_query($connect,$brands_sql);
                        $brand = mysqli_fetch_assoc($brands);
                        $brandName = $brand['brand_name'];

                        ?>
                        <tr>
                            <td><img src="<?php echo $cart_item['image_addresse']; ?>" class="img-responsive" alt="Image"></td>
                            <td><?php echo $cart_item['name']; ?></td>
                            <td><?php echo $brandName ?></td>
                            <td><?php echo $cart_item['bike']; ?></td>
                            <td><?php echo $cart_item['price']; ?></td>
                            <td>

                            <?php 
                            $sql="SELECT * from cart where product_id = $product_id && user_id = $user_id;";
                            $result=mysqli_query($connect,$sql);
                            $row=mysqli_fetch_assoc($result);
                            $count=$row['product_count'];
                            $price=$cart_item['price'];
                            $total=$count*$price;

                            $net_total=$net_total+$total;
                            $_SESSION['total']=$net_total;
                           
                            ?>


                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" >
                                    <input style="width: 8rem; height: 4rem; margin: 0; " type="number" value="<?php echo $row['product_count']; ?>" name="count"  min="1" max="<?php echo $cart_item['quantity']; ?>"  onkeydown="return false"> 
                                    <input type="hidden" name="pid" value="<?php echo $cart_item['product_ID']; ?>">
                                    
                                    <td style="display: grid; font-size: 1.2rem;">
                                    <a><button style="width: 12rem;" class="btn"  type="submit" name="update">update</button></a>
                                    <a><button style="width: 12rem;" class="btn" type="submit" name="remove" >Remove</button></a>
                                    </td>
                                </form>
                               
                            </td> 
                           
                        </tr>
                    <?php
                    } ?>
                    </table>

                   


                    <h2 style="margin-top: 3rem;width:20%;margin-left:80%">Total : Rs. <?php echo $net_total ; ?> </h2>
                    <a href="checkout.php"><button style="width:20%;margin-left:80%" class="btn">checkout</button></a>
                <?php   
                }else{?>
                    <section class="box-empty">
                        <div class="box-container" style="padding: 4rem 2rem;">
                            <div class="box">
                                <h1 style="font-size: 30px;">Your Cart Is Empty!!!!</h1>
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
        include_once 'footer.php';
    ?>


    
   
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>   
</body>
</html>