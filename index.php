<?php
session_start();
include 'connection.php';

if(isset($_POST['profilebtn'])){
    header('location:profile.php');
}

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $firstname=$_SESSION['firstName'];

    // -----checkadmin-----
    $sql2 = "SELECT * FROM `admin` WHERE admin_id = '$user_id' ";
    $result2=mysqli_query($connect,$sql2);
    $row=mysqli_fetch_assoc($result2);

    if($firstname === $row['firstName'] ){
        $_SESSION['isAdmin']='Yes';
    }else{
        $_SESSION['isAdmin']='No';
    }
} 



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
       >
    </header>


    


    <section class="home" id="home"  >
        <div class="back"></div>
        <div class="content">
            <h3>About Us ...</h3>
            <p>Welcome to Ignite, your go-to destination for premium motorbike spare parts. 
                Fueled by a deep love for motorcycles, we're dedicated to enhancing your riding experience with a 
                carefully curated selection of high-quality components. Whether you're a seasoned rider or embarking on
                 your first journey, trust Ignite for reliable, precision-engineered parts that ensure every ride 
                 is an exhilarating adventure. Gear up with confidence  Ignite, where quality meets passion.</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>
    </section>
    <!-- <marquee width="100%" direction="right" height="auto" >
    <img class="logo" src="Images/logo.png" alt="">
    
    </marquee> -->
    <section class="popular" id="popular2">
        <h1 class="heading">Our <span>products</span></h1>
        <div class="box-container" id="productContainer">
            <?php
                include "connection.php";
                $sql="SELECT * from product INNER JOIN brand on brand.brand_id = product.brand";
                $result=mysqli_query($connect,$sql);

                while($row=mysqli_fetch_assoc($result)){ 
                    $imgName=$row['image_addresse'];?>
                    <div class="box">
                        <img src="<?php echo $imgName; ?>" alt="Image">
                        <div class="box1">
                            <h3><?php echo $row['name']; ?>  </h3>
                            <span class="description"> Suitable for <?php echo $row['brand_name']." ".$row['bike']; ?> .</span>
                        </div>
                    </div>
                <?php
                }
            ?>
        </div>
    </section>


    
   
    
    <section class="popular" id="popular">
        <h1 class="heading">Our <span>Brands</span></h1>
        <div class="box-container">
        <?php 
            include "connection.php";
            $sql="SELECT * FROM  brand ";
            
            $result=mysqli_query($connect,$sql);

            while($row=mysqli_fetch_assoc($result)){ 
                $imgName=$row['image_address'];
                $id=$row['brand_id'];?>
                    
                <div class="box">
                    <img class="brand" src="<?php echo $imgName ;?>" alt="">
                    <h3><?php echo $row['brand_name']; ?> </h3>
                </div>
            <?php 
            }
             ?>
        </div>
    </section>

    <section class="reveiw" id="reveiw">
        <h1 style="color: #e75b24;" > <span style="color: #666;">CUSTOMER</span> REVIEWS</h1>
        <?php 
        if(isset($_SESSION['firstName'])){
        $email=$_SESSION['user_email'];
        $sql="SELECT * from users where email = '$email' ;";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_fetch_assoc($result);
        if(isset($row['firstName'])){
        if($row['firstName']){
        ?>
        <div class="addingReview">
            <form action="addreview.php" method="POST"  enctype="multipart/form-data">
                <div >
                    <input type="hidden" value="<?php echo $_SESSION['firstName']; ?>" name="rn">
                </div> 
                <div class="input-box" >
                    <input type="text" placeholder="Add your review here " name="des">
                </div> 
                <div class="button">
                    <input type="submit" value="Add" name="submit">
                </div>
            </form>
       </div>
       <?php } }}?>
        <div class="box-container">
        <?php
            $select_reviews = mysqli_query($connect, "SELECT * FROM review");
            if(mysqli_num_rows($select_reviews) > 0) {
            while($row8 = mysqli_fetch_assoc($select_reviews)) {
        ?>
        <div class="box">
                <img src="images\customers.png" alt="">
                <h3> <?php echo $row8['reviewerName']; ?></h3>
                
                <div class="content">
                    <p> <?php echo $row8['review'] ?></p>
                </div>
                <?php
                 if(isset($_SESSION['firstName'])){
                    $sql="SELECT * from admin where email = '$email' ;";
                    $result=mysqli_query($connect,$sql);
                    $row3=mysqli_fetch_assoc($result);
                    if ( isset($row3['firstName'])) {
                        if ($row3['firstName']) {
                            echo '<a href="deletereview.php?rId=' . $row8['rId'] . '">delete</a>';
                        }
                    }else if(isset($row8['reviewerName']) ){
                        $sql1="SELECT * from users where email = '$email' ;";
                        $result1=mysqli_query($connect,$sql1);
                        $row5=mysqli_fetch_assoc($result1);
                        if($row8['reviewerName'] == $row5['firstName'] ){

                            echo '<a href="deletereview.php?rId=' . $row8['rId'] . '">delete</a>'; 
                        }
                    }}
                ?>
            </div>
<?php
    }
}
?>
        </div>
</section>







    <section class="steps">
        <div class="box">
            <img src="Images/img4.png" alt="">
            <h3>All your needs</h3>    
        </div>
        <div class="box">
            <img src="Images/img1.png" alt="">
            <h3>fast delivery</h3>
        </div>
        <div class="box">
            <img src="Images/img2.png" alt="">
            <h3>easy payments </h3>
        </div>
        <div class="box">
            <img src="Images/img3.png" alt="">
            <h3>Installations</h3>
        </div>

    </section>

    <?php
        include_once 'footer.php';
    ?>
    

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>
    
</body>


<script>
    let currentProductIndex = 0;

    const productBoxes = document.querySelectorAll('.box-container#productContainer .box');

    function showNextProducts() {
        for (let i = 0; i < 3; i++) {
            productBoxes[(currentProductIndex + i) % productBoxes.length].style.display = 'none';
        }
        currentProductIndex = (currentProductIndex + 3) % productBoxes.length;
        for (let i = 0; i < 3; i++) {
            productBoxes[(currentProductIndex + i) % productBoxes.length].style.display = 'block';
        }
    }

    for (let i = 3; i < productBoxes.length; i++) {
        productBoxes[i].style.display = 'none';
    }

    setInterval(showNextProducts, 5000);
</script>



</html>