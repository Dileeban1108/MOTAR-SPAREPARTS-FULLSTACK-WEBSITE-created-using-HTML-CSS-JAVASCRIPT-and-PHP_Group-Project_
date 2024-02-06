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
if(isset($_GET['id'])){

    $id=$_GET['id'];
    $sql="DELETE from product where product_ID = '$id'";
    if(mysqli_query($connect, $sql)){
       
        header("location:productList.php?error=successfullyDeleted");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Product List</title>
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


    <div class="productsTable">
        <h2 class="messages">
        <?php
        if(isset($_GET['error'])){
            if($_GET['error']=='successfullyDeleted'){
                echo "Successfully Deleted The Item";
            }
        }
        ?>
        </h2>
        <h2>Available Products</h2>
        <table>
            <thead>
                <td><b>Customer name</b></td>
                <td><b>Product Name</b></td>
                <td><b>Brand</b></td>
                <td><b>Suitable Bike</b></td>
                <td><b>Price</b></td>
                <td><b>Quantity</b></td>
                <td><b>Update</b></td>
            </thead>
            
            <?php
            $resultsPerPage = 10; 
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $startFrom = ($currentPage - 1) * $resultsPerPage;

            $sql = "SELECT * FROM product LIMIT $startFrom, $resultsPerPage;";
            $result = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['brand'];
                $imgName = $row['image_addresse'];
                $sql2 = "SELECT brand_name FROM brand WHERE brand_id = $id;";
                $result2 = mysqli_query($connect, $sql2);
                $var1 = mysqli_fetch_assoc($result2);
                $brand = $var1['brand_name'];
                ?>
                
                <tr>
                    <td><img src="<?php echo $imgName; ?>" class="img-responsive" alt="Image"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $brand; ?></td>
                    <td><?php echo $row['bike']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td id="table-btn">
                        <a  href="productList.php?id= <?php echo $row['product_ID']; ?>"><button name="delete">Delete</button></a>
                        <a href="edit.php?id= <?php echo $row['product_ID']; ?>"><button class="cancelbtn" name="edit">Edit</button></a>
                    </td>
                </tr>
            <?php 
            }
            ?>
        </table>

    
        <?php
        $sql = "SELECT COUNT(*) AS total FROM product;";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $totalPages = ceil($row['total'] / $resultsPerPage);

        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        ?>
    </div>


    <?php
        include_once 'footer.php';
    ?>


    
   
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="script.js "></script>   
</body>
</html>