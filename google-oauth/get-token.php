<?php
session_start();
if(!isset($_GET['code']) || !isset($_GET['scope'])) {
    echo "Unauthorized Page";
    exit();
}

$authCode = $_GET['code'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Token</title>
</head>
<body>
    <input type="text" name="code" value="<?php echo $authCode;?>" style="padding:10px;width:600px;font-size:14px;" onclick="this.select();">
</body>
</html>