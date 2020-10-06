<?php
$myfile = fopen(__DIR__."/cron-text.txt", "w") or die("Unable to open file!");
$txt = "Test crontab\n";
fwrite($myfile, $txt);
$dt = date("Y-m-d H:i:s")."\n";
fwrite($myfile, $dt);
fclose($myfile);
?>