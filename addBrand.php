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

if(isset($_POST['submit1'])){
    $brand = $_POST['brand'];
    
    
    $image = $_FILES['product_img']['name'];
    $img_tmp = $_FILES['product_img']['tmp_name'];
    $img_size = $_FILES['product_img']['size'];
    $error = $_FILES['product_img']['error'];

    $sql = "SELECT * FROM brand WHERE brand_name = '$brand'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($result);

    if($row === 1){
        header("location: addBrand.php?error=Brandhave");
        exit();
    } else {
        

        $img_ex = pathinfo($image, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $img_path = "brands/" . $image;

        if($img_ex_lc != "jpg" && $img_ex_lc != "png" && $img_ex_lc != "jpeg"){
            header("location: addBrand.php?error=invalidFileType");
            exit();
        }

        $sql = "INSERT INTO brand (brand_name, image_address) VALUES ('$brand', '$img_path')";
     
        if(mysqli_query($connect, $sql)){
            header("location: addBrand.php?error=successfullyAdded");
            move_uploaded_file($img_tmp, $img_path);
            exit();
        } 
    }
}

if(isset($_POST['submit2'])){
    $brand = $_POST['brand'];

    $sql = "SELECT * FROM brand WHERE brand_name = '$brand'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($result);

    if($row === 1){
        
        $details=mysqli_fetch_assoc($result);
        $id=$details['brand_id'];

        $sql="DELETE from product where brand = '$id'";
        if(mysqli_query($connect, $sql)){
            $sql="DELETE from brand where brand_id = '$id'";
            $result = mysqli_query($connect, $sql);
            header("location: addBrand.php?error=successfullyDeleted");
            exit();
        }
    }
    else{
        header("location: addBrand.php?error=noBrand");
    }

}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add or Delete Brand</title>
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
        <div>
            <h2 class="messages">
            <?php 
            if(isset($_GET['error'])){
                if($_GET['error']==='Brandhave'){
                    echo"Existing Brand";
                }
                if($_GET["error"]==="invalidFileType"){
                    echo"Invalid File Type";
                }
                if($_GET['error']==='successfullyAdded'){
                    echo"Successfully Added The Brand";
                }
                if($_GET['error']==='successfullyDeleted'){
                    echo"successfully Deleted The Brand";
                }
                if($_GET['error']==='noBrand'){
                    echo"Invalid Brand";
                }   
            }
            ?> 
            </h2>


            <h2>Add Brand</h2>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <label for="name"><b>brand</b></label>
                <input class="input-fetails" type="text" name="brand" placeholder="Enter Brand Name" required>
                
                <label for="image"><b>Image of the Brand</b></label>
                <input class="input-fetails" type="file" name="product_img"required>
                
                <div class="clearfix">
                    <a href="admin.php"><button type="button" class="cancelbtn">Cancel</button></a>
                    <button type="submit" class="signupbtn" name="submit1" >Add</button>
                </div>
            </form>  


           
            <form class="deleteBrand" action="<?php $_SERVER['PHP_SELF'] ?>"  method="post" enctype="multipart/form-data">
                <h2>Delete Brand</h2>
                    <label for="name"><b>brand</b></label>
                    <input class="input-fetails" type="text" name="brand" placeholder="Enter Brand Name" required>

                    <div class="clearfix">
                        <a href="admin.php"><button type="button" class="cancelbtn">Cancel</button></a>
                        <button type="submit" class="signupbtn" name="submit2" >Delete</button>
                    </div>
            </form>  
        </div>    
    </div>


    <?php
        include_once 'footer.php';
    ?>


  

    
   
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>  
</body>
</html>