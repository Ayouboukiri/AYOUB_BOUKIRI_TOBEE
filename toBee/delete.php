<html>
<head>
    <title>Suppression de produit</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
    <?php
        include "db_conn.php";

        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $_GET['reference']); 
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
			header("Location: settings.php");
            } else {
                echo "Aucun produit trouvé avec cet identifiant.";
            }

            $stmt->close();
        } else {
            echo "Erreur lors de la préparation de la requête.";
        }
    ?>
</body>
</html>
