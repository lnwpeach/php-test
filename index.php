<?php
// $pdo2 = new PDO("mysql:host=localhost;dbname=vayo2", "root", "12345878");

/*
$aa = "aaaa";
echo "aa: ".$aa;
echo "<br><br>";
*/


echo '<h3>Test</h3>';

$revise = ['page' => 1, 'per_page' => 50];
$aa = http_build_query($revise);
echo "aa: ".$aa;
echo "<br><br>";

$aa = date("c", strtotime('2020-09-18'));
echo "aa: ".$aa;
echo "<br><br>";

echo 'DOCUMENT_ROOT: '.$_SERVER['DOCUMENT_ROOT'].'<br>';
echo 'REQUEST_URI: '.$_SERVER['REQUEST_URI'].'<br>';

echo '<hr>';

echo '<h3>mt_rand</h3>';
echo mt_rand(1,100).'<br>';
echo mt_rand().'<br>';
echo ((float)mt_rand()/(float)getrandmax()*100).'<br>';
echo '<hr>';

echo '<h3>hash 1234</h3>';
$aa = hash('md5', '1234');
echo 'md5: '.$aa.'<br>';
$aa = hash('sha256', '1234');
echo 'sha256: '.$aa.'<br>';
$aa = hash('sha512', '1234');
echo 'sha512: '.$aa.'<br>';
echo '<hr>';

echo '<h3>function crypt</h3>';
echo 'microtime: '.microtime(true).'<br>';

$ranid = uniqid('', true);
echo 'uniqid: '.$ranid.'<br>';
$salt = '$5$rounds=5043$'.$ranid;
$aa = crypt('1234', $salt);
echo $aa.'<br>';
$bb = crypt('1234', $aa);
echo $bb.'<br>';
echo 'microtime: '.microtime(true).'<br>';

?>