<?php
include "../database/database.php";
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $fullname = trim(htmlspecialchars($_POST['name-signup']));
    $email = trim(htmlspecialchars($_POST['email-signup']));
    $password = trim(htmlspecialchars($_POST['password-signup']));
    $role = "user";
    $hash = password_hash($password,  
          PASSWORD_DEFAULT); 
    try {
        $statment = $con->prepare("INSERT INTO `user`(`nom`, `email`,`password`, `role`) VALUES (?, ?,?,?)");
        $statment->bind_param("ssss", $fullname, $email,$hash,$role);
        $statment-> execute();
        $statment->close();
        header('Location: /Gestion Restaurant/frontend/index.php');
    } catch (Exception $e){

    }
}
?>
?>