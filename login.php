<?php

include 'connection.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}

if (isset($_POST['logsubmit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE email = '$email' ";
    $result=mysqli_query($connect,$sql);

    $sql2 = "SELECT * FROM `admin` WHERE email = '$email' ";
    $result2=mysqli_query($connect,$sql2);

    if(mysqli_num_rows($result)){
        while($row=mysqli_fetch_assoc($result)){ 
        
            if (password_verify($password, $row['password'])) {

                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['phoneNumber'] = $row['phoneNumber'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['addressLine1'] = $row['addressLine1'];
                $_SESSION['addressLine2'] = $row['addressLine2'];
                $_SESSION['addressLine3'] = $row['addressLine3'];
              

                header('location: index.php');
                exit();
            } else {
                echo "<p class='error-msg-box' style='display: none' > Incorrect username or password! </p>";
            }
        }
    }

    else if(mysqli_num_rows($result2)){
        while($row=mysqli_fetch_assoc($result2)){ 
        
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['admin_id'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['phoneNumber'] = $row['phoneNumber'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['addressLine1'] = $row['addressLine1'];
                $_SESSION['addressLine2'] = $row['addressLine2'];
                $_SESSION['addressLine3'] = $row['addressLine3'];
                header('location: index.php');
                exit();
            } else {
                echo "<p class='error-msg-box' style='display: none' >"."Incorrect username or password!</p>";
            }
        }
    }
    
    
    
    else {
        echo "<p class='error-msg-box' style='display: none'>Incorrect username or password! </p>";
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
    <?php
    include 'msg-box.php'
    ?>
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

    <div class="main-container">
        <div class="popup-box" id="popup-box" style="border-radius: 5px;">
            <div class="border-box">

           
            <div class="popup-btn">
              <h3 class="logbtn">Login</h3>
            </div>
            <div class="login" id="login">
                <form action="" method="post">
                    <input type="text" placeholder="Email" name="email" required><br>
                    <input type="password" placeholder="Password" name="password" required><br>
                    <input class="submitbtn" type="submit" value="Login" name="logsubmit">
                </form>
               
                <a style="margin-top: 2rem;" href="register.php">Create New Account ?</a>
            </div>
            </div>
        </div>
    </div>

    <?php
        include_once 'footer.php';
    ?>
    

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>
</body>
</html>