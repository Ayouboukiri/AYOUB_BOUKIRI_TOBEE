<?php
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HONEY</title>
        <link rel="stylesheet" href="tobee.css">
        <link rel="icon" href="image\beelogo.png" type="image/x-icon">

        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header>
        <nav>
            <a href="To_Bee.php">
            <img src="image\beelogo.png" alt="beeLogo" class="logo">
            <P class="toBee">To Bee</P></a>
            <P class="user_name"><?php echo $_SESSION['name'] ?></P>

            <ul >
                <a href="beauty.php" class="nav_b">Beauty</a>
                <a href="honey.php" class="nav_b">Honey</a>
                <a href="beewax.php" class="nav_b">BeeWax</a>
            </ul>
            <div class="search-container">
                <form action="honey.php" method="POST">
                    <input type="text" id="search" name="search">
                    <button class="search_button" onclick="search()" id="search-button">Search</button> 
                </form>
            </div>
             <i class='bx bx-cart' onclick="show_cart()" id="car_icon"></i> 
             <div class="cart" >
                <h2 class="cart-title">Your Cart</h2>
                <!-- content -->
                <div class="cart-content">
                    
                </div>
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>
                <!-- buy Button -->
                <button type="button" class="btn-buy">Buy Now</button>
                <!-- cart Close -->
                <i class='bx bx-x-circle' onclick="close_cart()" id="close-cart"></i>
                </div>
                <a href="settings.php"><?php if ($_SESSION['name']=="admin") {echo("<i class='bx bxs-cog settings' ></i>");}?></a>

            </nav>
            
    </header>
    <?php include "search.php"?>

    <section class="shop container"> 
        <h1 class="section-title">Honey Products</h1>
        <div class="shop-content">
        <?php 

$sql='select * from product where categorie="honey"' ;
$result = $conn->query($sql);

while($enreg = mysqli_fetch_assoc($result)){
    echo (' <div class="product-box product24">
    <img src='.$enreg['image'].'alt="" class="product_img">
    <h2 class="product-title">'.$enreg['title'].'</h2>
    <span class="price">'.$enreg['price'].'DH</span>
    <i class="bx bx-shopping-bag add-cart" ></i>
</div>
');
   
}

?>
        </div>
    </section> 
   <?php

include "add_commandes.php"
?>
        <script src="tobee.js"> </script>

</body>
</html>