<?php
include_once '../database.php';

$db = new DB('localhost', 'root', '', 'hotel', 'utf8mb4');

$reserveer = $db->deleteReservering($_GET['klantnummer']);

?>