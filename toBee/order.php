<?php
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To Bee</title>
        <link rel="stylesheet" href="tobee.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="image\beelogo.png" type="image/x-icon">


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
                <form action="beauty.php" method="POST">
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
                <button type="button" class="btn-buy" >Buy Now</button>
                <!-- cart Close -->
                <i class='bx bx-x-circle' onclick="close_cart()" id="close-cart"></i>
                </div>
                <a href="settings.php"><?php if ($_SESSION['name']=="admin") {echo("<i class='bx bxs-cog settings' ></i>");}?></a>

            </nav>
            
    </header>
   
    <?php include "search.php"?>


    
    <?php

include "add_commandes.php"

?>

   <script src="tobee.js"> </script>
 
</body>
</html>