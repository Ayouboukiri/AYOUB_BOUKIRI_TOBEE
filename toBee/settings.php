<?php
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Settings</title>
        <link rel="stylesheet" href="settings.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="image\beelogo.png" type="image/x-icon">
        <script src="tobee.js"></script>
        <script src="tobee.js"> </script>

</head>
<body>
    
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
                <form action="settings.php" method="POST">
                    <input type="text" id="search" name="search">
                    <button class="search_button" onclick="search()" id="search-button">Search</button> 
                </form>
            </div>
            
            </nav>
            <?php include "search.php"?>
            <div class="menu_container">
                
                    <a href="settings.php" class="menu product">Products <i class='bx bxs-shopping-bags' ></i></a>
                    <a href="message.php" class="menu message">Messages <i class='bx bxs-chat'></i></a>
                    <a href="add_product.php" class="menu message">Add product <i class='bx bxs-add-to-queue'></i></a>
                    <a href="commande.php" class="menu commande">Commandes <i class='bx bxs-cart' ></i></a>
                
            </div>
           <?php 

        $sql='select * from product ORDER BY id DESC' ;
		$result = $conn->query($sql);
		
		while($enreg = mysqli_fetch_assoc($result)){
			echo ('<div class="product_container">
            <img src='.$enreg['image'].' alt="" class="product_image">
            <p class="product_title">'.$enreg['title'].'</p>
            <p class="product_price">Price: <span>'.$enreg['price'].'</span></p>
            <p class="product_category">Category: <span>'.$enreg['categorie'].'</span></p>
            <p class="product_quantity">Quantity: <span>'.$enreg['quantity'].'</span</p>

            <a id="edit"  href="edit.php?reference='.$enreg["id"].'" >Edit</a>
            <a id="delete" onclick="delete_product()">Delete</a>

            </div>');
           echo('<div id="delete_popup">
                <h2>Do you want to delete this product </h2>
                <a class="delete_valid" href="delete.php?reference='.$enreg["id"].'"">Delete</a>
                <a class="delete_remove" onclick="close_delete()">cancel</a>
                </div>');
		}
        
        ?>
            
            
    </body>
    </html>