<?php 
session_start(); 
include "db_conn.php";


if (isset($_POST['uname']) && isset($_POST['password'])) {

    $uname = $_POST['uname'];
    $pass = $_POST['password'];

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name=? AND password=?");
        $stmt->bind_param("ss", $uname, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
			header("Location: index.php?error=your in");
            $row = $result->fetch_assoc();
            if ($uname === "admin" && $pass === "admin") {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                header("Location: settings.php");
                exit();
            } else if ($row['user_name'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                header("Location: To_Bee.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name and password");
            exit();
        }
        $stmt->close();
    }
} else {
    header("Location: index.php");
    exit();}