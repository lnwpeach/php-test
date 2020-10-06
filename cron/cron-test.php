<?php

$myfile = fopen("/var/www/html/test/cron/cron-text.txt", "w") or die("Unable to open file!");
$txt = "Test crontab\n";
fwrite($myfile, $txt);
$dt = date("Y-m-d H:i:s")."\n";
fwrite($myfile, $dt);
fclose($myfile);

exec("git -C /var/www/html/test/ add -A");
exec("git -C /var/www/html/test/ commit -m 'cron test {$dt}'");
exec("git -C /var/www/html/test/ push github master");

echo 'Success';

?>