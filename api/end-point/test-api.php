<?php
header('Access-Control-Allow-Origin: *');

$answer['success'] = 1;
$answer['get'] = $_GET;
$answer['post'] = $_POST;
$answer['input'] = file_get_contents('php://input');
exit(json_encode($answer));
?>