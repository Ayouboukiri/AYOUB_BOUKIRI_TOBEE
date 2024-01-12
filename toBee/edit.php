<?php
session_start();
include "db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit</title>
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
                <form action="settings.php" method="POST">
                    <input type="text" id="search" name="search">
                    <button class="search_button" onclick="search()" id="search-button">Search</button> 
                </form>
            </div>

            </nav>
			<div class="menu_container">
                
				<a href="settings.php" class="menu product">Products <i class='bx bxs-shopping-bags' ></i></a>
				<a href="message.php" class="menu message">Messages <i class='bx bxs-chat'></i></a>
				<a href="add_product.php" class="menu message">Add product <i class='bx bxs-add-to-queue'></i></a>
				<a href="commande.php" class="menu commande">Commandes <i class='bx bxs-cart' ></i></a>
			
		</div>
            <?php include "search.php"?>
<?php include('db_conn.php'); 

	if(isset($_GET['reference']))
	{
		
		$sql1="select * from product where id='".$_GET['reference']."'";
		$result = $conn->query($sql1);
		while($enreg = mysqli_fetch_assoc($result))
		{
?>			
			<center>
			<div class="edit_container">
			<h3 class="edit_title">Edit the product N°<?php echo $_GET['reference'] ?>:</h3>
			<?php if (isset($_GET['success'])) { ?>
     		<p class="success"><?php echo $_GET['success']; ?></p>
    		<?php } ?>
				<form action="edit.php?reference=1" method="post">
					<img src=<?php echo $enreg['image']; ?> alt="" class="edit_image">
					<table class="edit_table">
						<tr ><td  class="cl_edit">Category</td><td ><input class="inp_edit"  type="text" name="categorie" value="<?php echo $enreg['categorie']; ?>"></td></tr>
						<tr ><td class="cl_edit">Title</td><td ><input class="inp_edit" type="text" name="title" value="<?php echo $enreg['title']; ?>"></td></tr>
						<tr ><td class="cl_edit">Quantity</td><td ><input class="inp_edit" type="text" name="quantity" value="<?php echo $enreg['quantity']; ?>"></td></tr>
						<tr ><td class="cl_edit">Price</td><td ><input class="inp_edit" type="text" name="price" value="<?php echo $enreg['price']; ?>"></td></tr>
					</table>
					<input class="button_inp" type="submit" value="Edit"> &nbsp;&nbsp;<input class="inp_cancel" type="reset" value="Cancel">
			<input type="hidden" name="reference" value="<?php echo $_GET['reference']; ?>">
			</form>
		</div>
		</center>
<?php
		}
    }
	if(isset($_POST['price']) and isset($_POST['quantity']) and isset($_POST['categorie']) and isset($_POST['title']))
	{
		$sql = "UPDATE product SET title=?, price=?, categorie=?, quantity=? WHERE id=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sdsii", $_POST['title'], $_POST['price'], $_POST['categorie'], $_POST['quantity'], $_POST['reference']);
		
		if ($stmt->execute()) {
			header("Location: edit.php?reference=".$_POST['reference']."&success=The product has been updated");

		} else {
			echo "Error: " . $stmt->error;
		}
	}
?>
</body>
</html>