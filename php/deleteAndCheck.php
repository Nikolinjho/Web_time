<?php
include_once "connection.php";
session_start();

$checkDate = pdo()->prepare("SELECT * FROM ".$name." WHERE date = :date");
$checkDate->bindParam(':date', date("Y-m-d"));                
$checkDate->execute(); 
if ($checkDate->rowCount()){
    $name = $_SESSION['login'];
    $text = "true";
    $time = pdo()->prepare("SELECT * FROM ".$name." WHERE arrive = :bool");
    $time->bindParam(':bool', $text);  
    $time->execute();
    if ($time->rowCount()){
        include_once "deleteFlag.php";
    }

} 
