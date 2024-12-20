<?php
include "../../database/database.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_id = $_SESSION['id_logged'];
    $res_id = $_POST['r-id'];
    $menu = $_POST['menu-select-edit'];
    $adresse = trim(htmlspecialchars( $_POST['adresse-reservation-edit']));
    $nbrPersoone = trim(htmlspecialchars( $_POST['nbr-personne-reservation-edit']));
    $date = $_POST['date-reservation-edit'];
    $heure = $_POST['heure-reservation-edit'];
    $status = "En Attente";
    try{
        $stmt = $con -> prepare("UPDATE `reservation` set `date_reservation` = ?, `heure_reservation` = ?,`id_menu` = ?,`addresse_reservation` = ?,`nbr_personnes` = ? where id=$res_id ");
        $stmt->bind_param('sssss',$date,$heure,$menu,$adresse,$nbrPersoone);
        $stmt->execute();
    }catch(Exception $e){
        $_SESSION['error'] = "Couldn't Modify Reservation";
    }
   header('Location: /Gestion Restaurant/frontend/client/reservation.php');

} else
?>