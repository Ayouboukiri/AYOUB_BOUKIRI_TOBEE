<?php 
session_start();
if (isset($_SESSION['user_name'])) {
    include "db_conn.php";

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Bee</title>
    <link rel="stylesheet" type="text/css" href="To_Bee.css?v=<?php echo time();?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="image\beelogo.png" type="image/x-icon">

</head>
<body>
    <header>
        <nav>
        <a href="To_Bee.php">
        <img src="image\beelogo.png" alt="beeLogo" class="logo"></a>
        <P class="toBee">To Bee</P>
        <P class="user_name"><?php echo $_SESSION['name'] ?></P>
        <p class="log_out"><b>log Out</b></p>
        <a href="logout.php" ><i class='bx bx-log-out log_out_i' ></i></a>
        
        
        <ul >
            <a href="beauty.php" class="nav_b">Beauty</a>
                <a href="honey.php" class="nav_b">Honey</a>
                <a href="beewax.php" class="nav_b">BeeWax</a>
        </ul>
        <div class="search-container">
        <form action="To_Bee.php" method="POST">
		
		<input type="text" id="search" name="search">
        
        <button class="search_button" onclick="search()" id="search-button">Search</button> 
    </form>
</div>

                <a href="settings.php"><?php if ($_SESSION['name']=="admin") {echo("<i class='bx bxs-cog settings' ></i>");}?></a>

        </nav>
            
    </header>
    <div class="content">
        <h1 class="C_title"> Welcome <?php echo $_SESSION['name'] ?> to our beehive</h1>
        <p class="Welcome">
                Welcome to our honey haven!
             Our honey is pure goodness in every jar – natural,
             delicious, and made with love.  <br><br>
             Step into our world of sweetness! Beyond honey,
              discover the magic of our honeywax and beauty products. Pure indulgence, 
             straight from nature to enhance your glow.
        </p>
    
        <a href="honey.php"><button class="pick">Pick Now</button></a>
        
     
			<?php include "search.php"?>
            
        <div class="contact_us_container">
            <form  action="contact.php" method="POST">
                <input type="text" name="name" id="Name" placeholder="Name"><br>
                <input type="text" name="email" id="Email" placeholder="Email"><br>
                <textarea id="message" name="message"rows="4" placeholder="How can we help you."></textarea>
                <button type="submit" id="send">Send</button>
                <i class="bx bx-x contact_remove" onclick="close_contact()"></i>
            </form>
        </div>

        <script src="https://smtpjs.com/v3/smtp.js"></script>
    </div>
   
    <footer>
        <div class="contact-info">
            <p class="Email">Email: boukiri.ayo.fst@uhp.ac.ma</p>
            <p class="phone">Phone: +212 643-00064</p>
        </div>
        <button class="contact-button" onclick="contact_us()">Contact Us</button>
        <img src="image\footer logo.png" alt="" class="footer_logo">
    </footer>
    <script src="tobee.js"> </script>
</body>
</html>
<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>