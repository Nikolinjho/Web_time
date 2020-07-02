<?php

$name = $_SESSION['login'];
$text = "true";
$deletionRow = pdo()->prepare("DELETE  FROM ".$name." WHERE arrive = :bool");
$deletionRow->bindParam(':bool', $text);                
$deletionRow->execute();
unset( $_SESSION["seconds"]);