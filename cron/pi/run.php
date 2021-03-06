<?php

$dir = __DIR__;
exec("git -C {$dir}/.. pull origin master");

// write file
$myfile = fopen(__DIR__."/text.txt", "w") or die("Unable to open file!");
$txt = "Test crontab\n";
fwrite($myfile, $txt);
$dt = date("Y-m-d H:i:s");
fwrite($myfile, $dt);
fclose($myfile);

exec("git -C {$dir}/.. add -A");
exec("git -C {$dir}/.. commit -m \"crontest {$dt}\"");
exec("git -C {$dir}/.. push origin master");

echo 'Success';

?>