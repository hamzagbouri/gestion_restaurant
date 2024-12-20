<?php
include "../../database/database.php";
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if(isset($_POST['accept']))
    {
        $reservationId = $_POST['res-id'];
        $newStatus = "Accepted";
        $stmt = $con->prepare('UPDATE `reservation` set `status` = ? where `id` = ?');
        $stmt->bind_param('ss',$newStatus,$reservationId);
        $stmt->execute();
        header("Location: /Gestion Restaurant/frontend/admin/reservation.php");

    } else if(isset($_POST['reject']))
    {
        $reservationId = $_POST['res-id'];
        $newStatus = "Rejected";
        $stmt = $con->prepare('UPDATE `reservation` set `status` = ? where `id` = ?');
        $stmt->bind_param('ss',$newStatus,$reservationId);
        $stmt->execute();
        header("Location: /Gestion Restaurant/frontend/admin/reservation.php");

    } else if(isset($_POST['action'])) {
        $reservationId = $_POST['res-id'];
        $newStatus = $_POST['new-status'];
        $stmt = $con->prepare('UPDATE `reservation` set `status` = ? where `id` = ?');
        $stmt->bind_param('ss',$newStatus,$reservationId);
        $stmt->execute();
        header("Location: /Gestion Restaurant/frontend/client/reservation.php");

    } else{
        echo 'aa';
    }
}
?>