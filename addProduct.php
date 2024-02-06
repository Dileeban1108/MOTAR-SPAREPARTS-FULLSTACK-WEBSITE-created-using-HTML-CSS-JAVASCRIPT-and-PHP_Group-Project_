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

if(isset($_POST['submit'])){
    $brand = $_POST['brand'];
    $part = $_POST['part'];
    $bike = $_POST['bike'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $image = $_FILES['product_img']['name'];
    $img_tmp = $_FILES['product_img']['tmp_name'];
    $img_size = $_FILES['product_img']['size'];
    $error = $_FILES['product_img']['error'];

    $sql = "SELECT * FROM brand WHERE brand_name = '$brand'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($result);

    if($row === 0){
        header("location: addProduct.php?error=noBrand");
        exit();
    } else {
        $detail = mysqli_fetch_assoc($result);
        $brand_id = $detail['brand_id'];

        $img_ex = pathinfo($image, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $img_path = "part_IMG/" . $image;

        if($img_ex_lc != "jpg" && $img_ex_lc != "png" && $img_ex_lc != "jpeg"){
            header("location: addProduct.php?error=invalidFileType");
            exit();
        }

        $sql = "INSERT INTO product (name, bike, price, brand, quantity, image_addresse) VALUES ('$part', '$bike', '$price', '$brand_id', '$quantity', '$img_path')";
     
        if(mysqli_query($connect, $sql)){
            header("location: addProduct.php?error=successfullyAdded");
            move_uploaded_file($img_tmp, $img_path);
            exit();
        } else {
            header("location: addProduct.php?error=sqlError");
            exit();
        }
    }
}


?>


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add Products</title>
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
    
    <div class="container">
        <h2 class="messages">
        <?php 
        if(isset($_GET['error'])){
            if($_GET["error"]==="invalidFileType"){
                echo"Invalid File Type";
            }
            if($_GET['error']==='successfullyAdded'){
                echo"Successfully Added The Brand";
            }
            if($_GET['error']==='noBrand'){
                echo"Invalid Brand";
            }    
        }
        ?> 
        </h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h2>Add Product</h2>
            <label for="name"><b>brand</b></label>
            <input class="input-fetails" type="text" name="brand" placeholder="Enter Brand Name" required>
                
            <label for="part"><b>name of the part</b></label>
            <input class="input-fetails" type="text" name="part" placeholder="Enter Product Name" required>
                
            <label for="bike"><b>Suitable Bike</b></label>
            <input class="input-fetails" type="text" name="bike" placeholder="Enter Suitable Bike Name " required>
                
            <label for="price"> <b>Price</b></label>
            <input class="input-fetails" type="number" name="price" placeholder="Enter Price "required>
                
            <label for="quantity"> <b>quantity</b></label>
            <input class="input-fetails" type="number" name="quantity" placeholder="Enter Quantity"required>
                
            <label for="image"><b>Image of the Product</b></label>
            <input class="input-fetails" type="file" name="product_img"required>
                
            <div class="clearfix">
                <a href="admin.php"><button type="button" class="cancelbtn">Cancel</button></a>
                <button type="submit" class="signupbtn" name="submit" >Submit</button>
            </div>
        </form>  
    </div>


    <?php
        include_once 'footer.php';
    ?>
  

    
   
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>
</body>
</html>