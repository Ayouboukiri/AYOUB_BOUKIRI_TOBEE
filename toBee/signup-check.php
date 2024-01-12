<?php
session_start();
include "db_conn.php";

if (
    isset($_POST['uname']) && isset($_POST['password']) &&
    isset($_POST['name']) && isset($_POST['re_password'])
) {
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    $re_pass = $_POST['re_password'];
    $name = $_POST['name'];

    $user_data = 'uname=' . $uname . '&name=' . $name;

    if (empty($uname) || empty($pass) || empty($re_pass) || empty($name)) {
        header("Location: signup.php?error=All fields are required&$user_data");
        exit();
    } elseif ($pass !== $re_pass) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {
        // Check if the username already exists
        $check_sql = "SELECT * FROM users WHERE user_name=?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: signup.php?error=The username is already taken&$user_data");
            exit();
        } else {
            
            

            // Insert new user
            $insert_sql = "INSERT INTO users (user_name, password, name) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param("sss", $uname, $pass, $name);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: signup.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: signup.php?error=Unknown error occurred&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
