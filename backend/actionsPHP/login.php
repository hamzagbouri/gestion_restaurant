<?php
include "../database/database.php";
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $email = trim($_POST['email-login']);
    $password = trim($_POST['password-login']);

    $stmt = $con->prepare("SELECT * FROM `user` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        $isVerified = password_verify($password, $row['password']);
          if (password_verify($password, $row['password'])) {
            $_SESSION['id_logged'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            if($row['role'] == 'admin'){
                header('Location: /Gestion Restaurant/frontend/admin/index.php');
            }
            else {
                header('Location: /Gestion Restaurant/frontend/client/home.php');

            }
            exit();
        } else {
            $_SESSION["error"] = "INVALID PASSWORD" ;

        }
    } else {
        $_SESSION["error"] = "INVALID EMAIL" ;
        }
        header("Location: /Gestion Restaurant/frontend/index.php");


    $stmt->close();
}
?>