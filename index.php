<?php
/*
$aa = "aaaa";
echo "aa: ".$aa."<br>";
echo "<br><br>";
*/


echo '<h3>Test</h3>';
echo "<a href='gen-code.php'>Generate Code</a><br>";

echo '<h3>Variable</h3>';
echo 'php_uname(): '.php_uname().'<br>';
echo 'php_sapi_name(): '.php_sapi_name().'<br>';
echo 'PHP_OS: '.PHP_OS.'<br>';
echo '__DIR__: '.__DIR__.'<br>';
echo 'DOCUMENT_ROOT: '.$_SERVER['DOCUMENT_ROOT'].'<br>';
echo 'REQUEST_URI: '.$_SERVER['REQUEST_URI'].'<br>';
echo '<hr>';

echo '<h3>mt_rand</h3>';
echo mt_rand(1,100).'<br>';
echo mt_rand().'<br>';
echo ((float)mt_rand()/(float)getrandmax()*100).'<br>';
echo '<hr>';

echo '<h3>hash</h3>';
$pass = "1234";
$aa = hash('md5', $pass);
echo 'md5: '.$aa.'<br>';
$aa = hash('sha256', $pass);
echo 'sha256: '.$aa.'<br>';
$aa = hash('sha512', $pass);
echo 'sha512: '.$aa.'<br>';
echo '<hr>';

echo '<h3>function crypt</h3>';
echo '$5$: sha256<br>';
echo '$6$: sha512<br>';
$st = microtime(true);
$ranid = substr(uniqid('', true), 6);
echo 'uniqid: '.$ranid.'<br>';

echo '<br>';
echo 'sha256<br>';
$salt = '$5$rounds=6139$'.$ranid;
echo 'salt: '.$salt.'<br>';
$aa = crypt($pass, $salt);
echo $aa.'<br>';
$bb = crypt($pass, $aa);
echo $bb.'<br>';
echo '<br>';

echo '<br>';
echo 'sha512<br>';
$salt = '$6$rounds=6139$'.$ranid;
echo 'salt: '.$salt.'<br>';
$aa = crypt($pass, $salt);
echo $aa.'<br>';
$bb = crypt($pass, $aa);
echo $bb.'<br>';

$ed = microtime(true);
$time = ($ed - $st) * 1000;
echo 'time: '.($time).' ms<br>';
echo '<hr>';

echo '<h3>Time</h3>';
echo 'Date time: '.date('c');
echo '<br>';
echo 'time: '.time();
echo '<br>';
echo 'microtime: '.microtime(true);
echo '<br>';
echo '<hr>';

echo '<h3>ASCII</h3>';
echo 'ord A: '.ord('A');
echo '<br>';
echo 'chr 65: '.chr(65);
echo '<br>';
echo '<hr>';

echo '<h3>Base number</h3>';
echo 'dexhex 10: '.dechex('10');
echo '<br>';
echo 'hexdec a: '.hexdec('a');
echo '<br>';
echo 'decbin 95: '.decbin('95');
echo '<br>';
echo 'bindec 1011111: '.bindec('1011111');
echo '<br>';
echo '<hr>';

?>