<?php
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADD PRODUCT</title>
        <link rel="icon" href="image\beelogo.png" type="image/x-icon">

        <link rel="stylesheet" href="settings.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <form action="add_product.php" method="POST">
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
			<center>
			<div class="add_container">
			<h3 class="add_title">Add the product:</h3>
            <?php
             if (isset($_GET['success'])) { ?>
     		<p class="success"><?php echo $_GET['success']; ?></p>
    		<?php }
             if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
    		<?php }
             ?>
				<form action="add_product.php" method="post">
					<table class="add_table">
						<tr ><td class="cl_add">Category</td><td ><input class="inp_add"  type="text" name="categorie" required></td></tr>
						<tr ><td class="cl_add">Title</td><td ><input class="inp_add" type="text" name="title" required></td></tr>
						<tr ><td class="cl_add">Quantity</td><td ><input class="inp_add" type="text" name="quantity" required></td></tr>
						<tr ><td class="cl_add">Price</td><td ><input class="inp_add" type="text" name="price" required></td></tr>
						<tr ><td class="cl_add">Image_url</td><td ><input class="inp_add" type="file" name="image" accept="image/*" required></td></tr>
					</table>
					<input class="button_inp" type="submit" value="Add"> &nbsp;&nbsp;<input class="inp_cancel" type="reset" value="Cancel">
			</form>
		</div>
		</center>
<?php
		
        if (isset($_POST['title'], $_POST['price'], $_POST['quantity'], $_POST['categorie'], $_POST['image'])) {

            // Check if the product already exists
            $check_sql = "SELECT * FROM product WHERE title=?";
            $stmt_check = $conn->prepare($check_sql);
            $stmt_check->bind_param("s", $_POST['title']);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
    
            if ($result_check->num_rows > 0) {
                header("Location: add_product.php?error=The product is already exist");
                exit();
            } else {
                // Insert the product into the database
                $image='"image/'.$_POST['image'].'"';
                $insert_sql = 'INSERT INTO product (title, price, quantity, categorie, image) VALUES (?, ?, ?, ?, ?)';
                $stmt_insert = $conn->prepare($insert_sql);
                $stmt_insert->bind_param('sdiss', $_POST['title'], $_POST['price'], $_POST['quantity'], $_POST['categorie'], $image);
    
                if ($stmt_insert->execute()) {
                    header("Location: add_product.php?success=The product has been added");
                    exit();
                } else {
                    echo "Error: " . $stmt_insert->error;
                }
            }
        } 
    
    ?>
    
</body>
</html>