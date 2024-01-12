<?php
session_start();
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESSAGES</title>
    <link rel="stylesheet" href="settings.css">
    <link rel="icon" href="image\beelogo.png" type="image/x-icon">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="tobee.js"></script>
</head>

<body>

    <nav>
        <a href="To_Bee.php">
            <img src="image\beelogo.png" alt="beeLogo" class="logo">
            <P class="toBee">To Bee</P>
        </a>
        <P class="user_name"><?php echo $_SESSION['name'] ?></P>

        <ul>
            <a href="beauty.php" class="nav_b">Beauty</a>
            <a href="honey.php" class="nav_b">Honey</a>
            <a href="beewax.php" class="nav_b">BeeWax</a>
        </ul>
        <div class="search-container">
            <form action="message.php" method="POST">
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
    <?php include "search.php" ?>
   
    <form action="message.php" method="post">
        <select name="users" id="users" >
        <option value="" disabled selected>Users</option>

            <?php
                $sql0 = 'select distinct user_name from contact';
                $stmt0 = $conn->prepare($sql0);
                $stmt0->execute();
                $result0 = $stmt0->get_result();
                
                while ($enreg0 = mysqli_fetch_assoc($result0)) {
                    echo ('<option class="option" value="' . $enreg0["user_name"] . '" >' . $enreg0["user_name"] . '</option>');
                }
                
                $stmt0->close();
                ?>
            </select>
            <button class="submit" type="submit">select</button>
        </form>
    <div class="container">
        <?php
        if (isset($_POST['users'])) {
            $sql = 'select * from contact where user_name = \'' . $_POST["users"] . '\'';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($enreg = mysqli_fetch_assoc($result)) {
                echo ('
                <div class="commande_container">
                    <p class="name">' . $enreg['user_name'] . '</p>
                    <p class="email">' . $enreg['email'] . '</p>
                    <p class="msg">' . $enreg['message'] . '</p>
                   
                </div>');
            }

            $stmt->close();
        }
        ?>
    </div>
    <script src="tobee.js"> </script>

</body>
</html>
