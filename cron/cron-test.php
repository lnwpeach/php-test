<?php

$dir = __DIR__;
$myfile = fopen(__DIR__."/cron-text.txt", "w") or die("Unable to open file!");
$txt = "Test crontab\n";
fwrite($myfile, $txt);
$dt = date("Y-m-d H:i:s");
fwrite($myfile, $dt);
fclose($myfile);

$dt2 = date("Y-m-d_H:i:s");
exec("git -C {$dir}/.. add -A");
exec("git -C {$dir}/.. commit -m 'crontest_{$dt2}'");
exec("git -C {$dir}/.. push origin master");

echo 'Success';

?>