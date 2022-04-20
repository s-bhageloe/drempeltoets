<?php
include_once '../database.php';

$db = new DB('localhost', 'root', '', 'hotel_ter_duin', 'utf8mb4');

$reserveer = $db->deleteReservering($_GET['reserveringklantid']);

?>