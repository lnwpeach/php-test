<?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("ETDA-invoice.xml");
// $xmlDoc->load("test.xml");

$x = $xmlDoc->documentElement;

// foreach ($x->childNodes AS $key => $item) {
//   print $key . " => " . $item->nodeName . " = " . $item->nodeValue . "<br>";
// }

$a = $x->childNodes;
// echo "<pre>";
// print_r($a[3]->childNodes[11]->childNodes[3]->nodeValue);
// echo "</pre>";

$b = $a[3]->childNodes[11]->childNodes[3]->nodeValue;
$b = preg_replace("/^[\s]+/", "", $b);
echo nl2br($b);
?>