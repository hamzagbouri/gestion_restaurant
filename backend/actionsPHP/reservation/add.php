<?php
include "../../database/database.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $user_id = $_SESSION['id_logged'];
    $menu = $_POST['menu-select'];
    $adresse = $_POST['adresse-reservation'];
    $nbrPersoone = $_POST['nbr-personne-reservation'];
    $date = $_POST['date-reservation'];
    $heure = $_POST['heure-reservation'];
    $status = "En Attente";
    try{
        $stmt = $con -> prepare('INSERT INTO `reservation` (date_reservation,heure_reservation,status,id_menu,id_client,addresse_reservation,nbr_personnes)
        VALUES (?,?,?,?,?,?,?)');
        $stmt->bind_param('sssssss',$date,$heure,$status,$menu,$user_id,$adresse,$nbrPersoone);
        $stmt->execute();
    }catch(Exception $e){
        $_SESSION['error'] = "Couldn't add Reservation";
    }
   header('Location: /Gestion Restaurant/frontend/client/reservation.php');

} else
?>