<div class="upper-box">
 <a href="#" ><img class="logo" src="Images/logo.png" alt=""></a>
 <div id="menu-bar" class="fas fa-bars"></div>
 <nav class="navbar">
     
     <a href="index.php" class="active">home</a>
     <a href="shop.php">shop</a>
     
     <?php
     if(isset($_SESSION['user_id'])){
        if($_SESSION['isAdmin']==='Yes'){?>
            <a href="admin.php">Admin</a>
        <?php
        }else{?>
        
            <a href="cart.php"><i class="ri-shopping-cart-2-line"></i> </a>
            <a href="wishList.php"><i class="ri-heart-line"></i></i> </a>
        <?php
         }?>
         <a href="profile.php" style="font-size: 1.5rem;"><i class="fa-solid fa-user"></i> <?php echo $_SESSION['firstName'] ;?></a>
         <a href="logout.php" style="font-size: 1.5rem;"><i class="ri-logout-box-r-line"></i></a>
        <?php
        
     } else{ ?>
         <a href="login.php" ><i class="ri-shopping-cart-2-line"></i> </a>
         <a href="login.php"><i class="ri-heart-line"></i></i> </a>
         <a class="action" href="login.php">Login</a>
         <a class="action" href="register.php">Register</a>
     <?php 
     }?>
 </nav>
</div>