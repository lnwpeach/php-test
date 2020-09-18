<?php
header("Access-Control-Allow-Origin: *");
$answer = ['success'=>1];
$data = json_decode(file_get_contents('php://input'), true)['json'];
$data = json_decode($data, true);

exit(json_encode($data));
?>