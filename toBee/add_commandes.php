<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $products = json_decode($json_data, true);
    
    if (!empty($products)) {
        foreach ($products as $product) {
            if (isset($product['title'], $product['price'], $product['quantity'])) {
                $title = $product['title'];
                $price = $product['price'];
                $quantity = $product['quantity'];
                $userName = $_SESSION['name'];
                
                $total_price = $price * $quantity;
                $now = date("Y-m-d");
                $checkDuplicate_sql = 'SELECT * FROM commande WHERE product = ? AND userName = ? AND quantity = ? AND comm_date = ?';
                $stmtCheck = $conn->prepare($checkDuplicate_sql);
                $stmtCheck->bind_param("ssis", $title, $userName, $quantity,$now);
                $stmtCheck->execute();
                $resultCheck = $stmtCheck->get_result();

                if ($resultCheck->num_rows == 0) {
                    $insertCommande_sql = "INSERT INTO commande (product, userName, comm_date, quantity, prod_price, total_price) VALUES (?, ?, NOW(), ?, ?, ?)";
                    $stmt = $conn->prepare($insertCommande_sql);
                    
                    $stmt->bind_param("ssidd", $title, $userName, $quantity, $price, $total_price);
                    
                    if ($stmt->execute()) {
                        header("Location: order.php");
                    } else {
                        echo 'Error placing the order: ' . $stmt->error;
                    }
                } else {
                    echo 'Duplicate record found for product: ' . $title . ', quantity: ' . $quantity . ', and user: ' . $userName;
                }

                $stmtCheck->close();
            }
        }
    } 
}
?>
