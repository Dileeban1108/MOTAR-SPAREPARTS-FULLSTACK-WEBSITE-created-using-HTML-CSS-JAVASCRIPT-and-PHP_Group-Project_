<?php session_start();
include 'connection.php';
$name=$_SESSION['firstName'];

if(isset($_POST['pay'])){
  $id=$_SESSION['user_id'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $addres1=$_POST['address'];
  $city=$_POST['city'];
  $address=$addres1.",".$city;
  $province=$_POST['province'];
  $zip=$_POST['zip'];
  $total=$_SESSION['total'];
  $date=date("Y/m/d");

  $sql="INSERT INTO ORDERS (user_id,customer,email,address,province,postal_code,total,date)
        values ('$id','$name','$email','$address','$province','$zip','$total','$date')";
  $result=mysqli_query($connect,$sql);

  $sql="SELECT * FROM orders ORDER BY order_id DESC LIMIT 1;";
  $result=mysqli_query($connect,$sql);
  $row=mysqli_fetch_assoc($result);

  $order_id=$row['order_id'];
  

  $sql = "INSERT INTO ordered_items (order_id, user_id, product_id, count,status)
        SELECT $order_id, user_id, product_id, product_count,'process'
        FROM cart
        WHERE user_id = '$id'";
  $result = mysqli_query($connect, $sql);


  $sql="DELETE FROM cart WHERE user_id = '$id';";
  $result=mysqli_query($connect,$sql);

  header("location:index.php");

}

















?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>motar spare parts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; 
  display: flex;
  -ms-flex-wrap: wrap; 
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; 
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; 
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; 
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text],input[type=date] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

form{
  padding: 2rem;
}


a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
<header>

<div class="upper-box">
 <a href="#" ><img class="logo" src="Images/logo.png" alt=""></a>
 <div id="menu-bar" class="fas fa-bars"></div>
 <nav class="navbar">
     
     <a href="index.php" class="active">home</a>
     <a href="shop.php">shop</a>
     
     <?php
     if(isset($_SESSION['user_email'])){
         $email=$_SESSION['user_email'];
         $sql="SELECT * from users where email = '$email' ;";
         $result=mysqli_query($connect,$sql);
         if(mysqli_num_rows($result)){?>
              
              <a href="cart.php"><i class="ri-shopping-cart-2-line"></i> </a>
             <a href="wishList.php"><i class="ri-heart-line"></i></i> </a>
         <?php   
         }
     }?>


     <?php
     if(isset($_SESSION['user_id'])){?>
         <a href="profile.php" style="font-size: 1.5rem;"><i class="fa-solid fa-user"></i><?php echo $name ;?></a>
         <a href="logout.php" style="font-size: 1.5rem;"><i class="ri-logout-box-r-line"></i></a>
         
        
     <?php 
     } else{ ?>
         <a class="action" href="login.php">Login</a>
         <a class="action" href="register.php">Register</a>
     <?php 
     }?>
 </nav>
</div>
<div class="down-box">
 <div class="outter-box">
     <form action="search.php" method="post" enctype="multipart/form-data"> 
         <input style="border: 0;" class="search-bar" name="search-bar" type="text" placeholder="Search Here...">
         <button class="search-icon" name="search"><i class="fas fa-search"></i></button>
     </form>
 </div>
</div>

 
</header>

<div class="row">
  <div  class="col-75" style="margin-top: 10rem; display: flex; align-items: center; justify-content: center;">
    <div style="width: 70%; padding: 0;" class="container">
      <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <h1 class="heading">Check<span>out</span></h1>
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="name"><i class="fa fa-user"></i> Full Name</label>
            <input required readonly type="text" id="fname" name="name" placeholder="John M. Doe" value="<?php echo $_SESSION['firstName'];?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input required readonly type="text" id="email" name="email" placeholder="john@example.com" value="<?php echo $_SESSION['user_email'];?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input required type="text" id="adr" name="address" placeholder="" value="<?php echo $_SESSION['addressLine1'].",".$_SESSION['addressLine2'];?>">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input required type="text" id="city" name="city" placeholder="Colombo" value="<?php echo $_SESSION['addressLine3'];?>">

            <div class="row">
              <div class="col-50">
                <label for="state">province</label>
                <input required type="text" id="state" name="province" placeholder="Southern">
              </div>
              <div class="col-50">
                <label for="zip">Zip code</label>
                <input required type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="img-row img-row2">
                <img src="pictures/visa.png" alt="fb">
                <img src="pictures/mastercard.png" alt="instragram">
                <img src="pictures/westernunion.png" alt="tiktok">
                <img src="pictures/americanexpress.png" alt="skyp">
            </div>
            <label for="cname">Name on Card</label>
            <input required type="text" id="cname" name="cardname" placeholder="John  Doe" >
            <label for="ccnum">Credit card number</label>
            <input required type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expdate">Expire date</label>
            <input required type="text" id="expdate" name="expdate" placeholder="MM/YY">
            <div class="row">
              
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input required type="text" id="cvv" name="cvv" placeholder="352">
              </div>
              <div class="col-50">
                <label for="total">Total</label>
                <input required type="text" id="total" name="total" readonly value="<?php echo 'rs. '.$_SESSION['total'];?>">
              </div>
            </div>
            </div>

          </div>
          <input style="width: 100%;" type="submit" name="pay" value="Continue to pay" class="btn">
        </div>
        
       
      </form>
    </div>
  </div>
  
</div>

</body>
</html>
