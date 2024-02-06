<?php

include 'connection.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}

if (isset($_POST['regsubmit'])) {

    $firstname = filter_var($_POST['firstname']);
    $lastname = filter_var($_POST['lastname']);
    $phonenumber = filter_var($_POST['phonenumber']);
    $email = filter_var($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='error-msg-box' style='display: none'> Invalid email address! </p>";
    } else {
        
        $check_users_sql = "SELECT * FROM `users` WHERE email = '$email'";
        $check_users = mysqli_query($connect,$check_users_sql);

        $check_admins_sql = "SELECT * FROM `admin` WHERE email = '$email'";
        $check_admins = mysqli_query($connect,$check_admins_sql);

        if(mysqli_num_rows($check_users)) {
            echo "<p class='error-msg-box' style='display: none' > Email already exists! </p>";
        }else if(mysqli_num_rows($check_admins)) {
            echo "<p class='error-msg-box' style='display: none'> Email already exists! </p>";
        }else {
            if ($password != $cpassword) {
                echo "<p class='error-msg-box'style='display: none' > Confirm password not matched! </p>";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $insert_user_sql = "INSERT INTO `users` (firstName, lastName, phoneNumber, email, password) VALUES ('$firstname', '$lastname', '$phonenumber', '$email', '$hashedPassword')";
                $insert_user = mysqli_query($connect, $insert_user_sql);


                echo "<p class='success-msg-box ' style='display: none'> Registered successfully, login now please! </p>";               
            }
        }
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

    <div class="main-container">
        <div class="popup-box" id="popup-box">
            <div class="popup-btn">
                <button class="logbtn"><h3 >Register</h3></button>
            </div>
            <div class="register" id="register">
                <form action="" method="post">
                    <input type="text" placeholder="First Name" name="firstname" required><br>
                    <input type="text" placeholder="Last Name" name="lastname" required><br>
                    <input type="text" placeholder="Phone Number" name="phonenumber" required><br>
                    <input type="email" placeholder="Email Address" name="email" required><br>
                    <input type="password" placeholder="Password" name="password" required><br>
                    <input type="password" placeholder="Confirm Password" name="cpassword" required><br>
                    <input class="submitbtn" type="submit" value="Register" name="regsubmit">
                </form>
                <a href="login.php">Already have Account ?</a>
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