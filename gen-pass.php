<?php
    function gen_pass($len) {
        $str = "";
        for($i=0;$i<$len;$i++) {
            $rand_up = rand(65, 90);
            $rand_low = rand(97, 122);
            $rand_num = rand(48, 57);
        
            $rand_arr = [$rand_up, $rand_low, $rand_num];
            $rand_sel = rand(0, 2);
            $chr = chr($rand_arr[$rand_sel]);
            $str .= $chr;
        }
    
        return $str;
    }

    for($i=0;$i<20;$i++) {
        echo gen_pass(15).'<br>';
    }
?>

<html>
<head></head>
<body>
    <h3>Gen Password</h3>
    <form action="" method='post'>
        Password: <input type='password' name='password' value=''> <input type='submit' name='submit'>
        <br>
        <br>
        <input type='submit' name='clear' value='Clear'>
    </form>
</body>
</html>