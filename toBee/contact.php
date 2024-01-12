<?php
session_start();
include "db_conn.php";

if ( isset($_POST['name']) && isset($_POST['email'])&& isset($_SESSION["name"]) &&isset($_POST['message']) ) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $user=$_SESSION["name"];


    
            $insert_sql = "INSERT INTO contact (name, email, message,user_name) VALUES (?, ?, ?,?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("ssss", $name, $email, $message,$user);

            if ($stmt->execute()) {
                header("Location: To_Bee.php?success=Your message has been sent successfully");
                exit();
            } else {
                header("Location: signup.php?error=Unknown error occurred&$user_data");
                exit();
            }
        
    

}
?>
