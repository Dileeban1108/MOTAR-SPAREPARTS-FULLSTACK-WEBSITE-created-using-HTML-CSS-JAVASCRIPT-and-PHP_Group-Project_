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
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $brand=$_POST['brand'];
        $part=$_POST['part'];
        $bike=$_POST['bike'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];
        $image=$_FILES['product_img']['name'];
        $img_tmp=$_FILES['product_img']['tmp_name'];

        if(isset($brand) && $brand !== ""){

            $sql="SELECT * FROM brand where brand_name = '$brand'";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($result);
            $brand_id=$row['brand_id'];

            $sql="UPDATE product SET brand= $brand_id  WHERE product_ID= $id ;";
            
            
            if (mysqli_query($connect,$sql)) {
                header("location:edit.php?error=brandAdd");
            } else {
                header("location:edit.php?error=brandNoAdd");
            }
        }

        elseif(isset($part)&& $part !== ""){
            $sql="UPDATE product SET name = '$part' WHERE product_ID= $id";
           
            if (mysqli_query($connect,$sql)) {
                header("location:edit.php?error=partAdd");
            } else {
                header("location:edit.php?error=partNoAdd");
            }

        }
        elseif(isset($bike)&& $bike !== ""){
            $sql="UPDATE product SET bike = '$bike'  WHERE product_ID= $id";
           
            if (mysqli_query($connect,$sql)) {
                header("location:edit.php?error=bikeAdd");
            } else {
                header("location:edit.php?error=bikeNoAdd");
            }
        }
        elseif(isset($price)&& $price !== ""){
            $sql="UPDATE product SET price = $price WHERE product_ID= $id";
           
            if (mysqli_query($connect,$sql)) {
                header("location:edit.php?error=priceAdd");
            } else {
                header("location:edit.php?error=priceNoAdd");
            }
        }
        elseif(isset($quantity)&& $quantity !== ""){
            $sql="UPDATE product SET quantity = $quantity WHERE product_ID= $id";
           
            if (mysqli_query($connect,$sql)) {
                header("location:edit.php?error=quantityAdd");
            } else {
                header("location:edit.php?error=quantityNoAdd");
            }
        }
        elseif(isset($image)&& $image !== ""){

            $img_ex=pathinfo($image,PATHINFO_EXTENSION);
            $img_ex_lc=strtolower($img_ex);
            
            $img_path = "part_IMG/" . $image;
            if($img_ex_lc != "jpg" && $img_ex_lc != "png" && $img_ex_lc != "jpeg"){
                header("location:edit.php?error=invalidFileType");
            }else{
                $sql = "UPDATE product SET image_addresse = '$img_path'  WHERE product_ID= $id";
                $result=mysqli_query($connect,$sql);
                move_uploaded_file($img_tmp, $img_path);
                header("location:edit.php?error=imageAdd");
            
            }
           
        }

        else{
            header("location:edit.php?error=addDetailsToUpdate");
        }
    }
    
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Product Edit</title>
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
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <h2>Edit product Details</h2>
        <h2 class="messages">
        <?php 
        if(isset($_GET['error'])){
            if($_GET['error']==='brandAdd'){
                echo"Successfully Added The Brand";
            }
            if($_GET["error"]==="partAdd"){
                echo"Successfully Added  Name of The Part";
            }
            if($_GET['error']==='bikeAdd'){
                echo"Successfully Added The Suitable Bike";
            }
            if($_GET['error']==='priceAdd'){
                echo"Successfully Added The Price";
            }
            if($_GET['error']==='quantityAdd'){
                echo"Successfully Added The Quantity";
            }
            if($_GET['error']==='imageAdd'){
                echo"Successfully Added The Image";
            }
            if($_GET['error']==='invalidFileType'){
                echo"Invalid File Type";
            }    
        }
        ?> 
        </h2>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <label for="name"><b>brand</b></label>
            <input class="input-fetails" type="text" name="brand" placeholder="Enter Product Name" >

            <label for="part"><b>name of the part</b></label>
            <input class="input-fetails" type="text" name="part" placeholder="Enter Feature 1" >

            <label for="bike"><b>Suitable Bike</b></label>
            <input class="input-fetails" type="text" name="bike" placeholder="Enter Feature 2 " >

            <label for="price"> <b>Price</b></label>
            <input class="input-fetails" type="number" name="price" placeholder="Enter Price ">

            <label for="quantity"> <b>quantity</b></label>
            <input class="input-fetails" type="number" name="quantity" placeholder="Enter Price ">

            <label for="image"><b>Image of the Product</b></label>
            <input class="input-fetails" type="file" name="product_img">

            <div class="clearfix">
                <a href="productList.php"><button type="button" class="cancelbtn">Cancel</button></a>
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