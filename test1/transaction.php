<?php
require "../config.php";
$pdo = new PDO($dsn, $user, $password);
$sth = $pdo->query("select * from quotation limit 1");
$rs = $sth->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($rs);
echo "</pre>"
?>