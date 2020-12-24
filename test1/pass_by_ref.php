<?php
$arr = [1,2,3,4,5,6];

// foreach($arr as &$item) {
//     if($item == 3) $item = 33;
// }

foreach($arr as &$item) {
    if($item == 5) $item += 100;
}
unset($item);

// $item = 111;

echo "<pre>"; 
var_dump($arr);
echo "</pre>";

echo "<pre>"; 
var_dump($item);
echo "</pre>";
?>