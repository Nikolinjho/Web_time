<?php

include_once "connection.php";
session_start();
                
$name = $_SESSION['login'];
$text = "true";
$time = pdo()->prepare("SELECT * FROM ".$name." WHERE arrive = :bool");
$time->bindParam(':bool', $text);                
$time->execute();
if ($time->rowCount()) {
    $time = $time->fetch();
    // echo json_encode($time);
    $name = $_SESSION['login'];
    $arrivalTime = $time['arrivalTime'];
    $leavingTime = date("H:i:s");
    $todayDate =  date("Y-m-d");
    $query = pdo()->prepare("INSERT INTO ".$name." (arrivalTime, leavingTime, date) VALUES ( :arrivalTime, :leavingTime, :date)");
    $query->bindParam(':arrivalTime', $arrivalTime );
    $query->bindParam(':leavingTime', $leavingTime );
    $query->bindParam(':date', $todayDate );
    $query->execute();
    
    include_once "deleteFlag.php";
    echo json_encode($_SESSION);
}
