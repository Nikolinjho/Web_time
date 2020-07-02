<?php
$date = date("Y-m-d");
$time = date("H:i:s");
echo json_encode([$date, $time]);