<?php

include_once "connection.php";
$arrivalTime = date("H:i:s");
$text = "true";
session_start();
$name = $_SESSION['login'];

$query = pdo()->prepare("INSERT INTO ".$name." (arrivalTime, arrive) VALUES ( :arrivalTime,:arrive)");
$query->bindParam(':arrivalTime', $arrivalTime );
$query->bindParam(':arrive', $text );
$query->execute();
echo json_encode("inserted");

