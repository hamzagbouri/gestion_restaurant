<?php
include "../database/database.php";
session_start();
    unset($_SESSION['id']);
    unset($_SESSION['role']);
    session_destroy();
    header("Location: /Gestion Restaurant/frontend/index.php");
    exit();
?>