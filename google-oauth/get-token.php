<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

if(!isset($_GET['code']) || !isset($_GET['scope'])) {
    echo "Unauthorized Page";
    exit();
}

$company_id = $_SESSION['company_id'];
$authCode = $_GET['code'];

echo "<script>window.opener.get_code('{$authCode}');window.close();</script>";
?>