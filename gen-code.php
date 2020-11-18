<?php
    function gen_pass($len) {
        $str = "";
        for($i=0;$i<$len;$i++) {
            $rand_up = rand(65, 90); // A-Z
            $rand_low = rand(97, 122); // a-z
            $rand_num = rand(48, 57); // 0-9
        
            $rand_arr = [$rand_up, $rand_low, $rand_num];
            $rand_sel = rand(0, 2);
            $chr = chr($rand_arr[$rand_sel]);
            $str .= $chr;
        }
    
        return $str;
    }

    function gen_pass_sign($len) {
        $sign_arr = [33, 35, 36, 38, 43, 45, 46, 47, 61, 95];
        $str = "";
        $sign_count = 0;
        $sign_max = floor($len * 0.25);
        for($i=0;$i<$len;$i++) {
            $rand_up = rand(65, 90); // A-Z
            $rand_low = rand(97, 122); // a-z
            $rand_num = rand(48, 57); // 0-9
            $rand_sign = $sign_arr[rand(0, count($sign_arr)-1)]; // Sign !#$&+-./=_
        
            $rand_arr = [$rand_up, $rand_low, $rand_num, $rand_sign];
            $rand_sel = rand(0, count($rand_arr)-1);
            if($rand_sel == 3) $sign_count++;
            if($sign_count > $sign_max) $rand_sel = rand(0, count($rand_arr)-2);

            $chr = chr($rand_arr[$rand_sel]);
            $str .= $chr;
        }
    
        return $str;
    }

    function gen_code($len) {
        $str = "";
        for($i=1;$i<=$len;$i++) {
            $rand_up = rand(65, 90);
            $rand_num = rand(48, 57);
        
            $rand_arr = [$rand_up, $rand_num];
            $rand_sel = rand(0, 1);
            $chr = chr($rand_arr[$rand_sel]);
            $str .= $chr;
            if($i % 4 == 0 && $i != $len) $str .= '-';
        }
    
        return $str;
    }

    function gen_num($len) {
        $str = "";
        for($i=1;$i<=$len;$i++) {
            $rand_num = rand(48, 57);
        
            $chr = chr($rand_num);
            $str .= $chr;
        }
    
        return $str;
    }

    for($i=0;$i<5;$i++) {
        echo gen_pass(18).'<br>';
    }

    echo '<br>';

    for($i=0;$i<5;$i++) {
        echo gen_pass_sign(18).'<br>';
    }

    echo '<br>';

    for($i=0;$i<5;$i++) {
        echo gen_code(16).'<br>';
    }

    echo '<br>';

    for($i=0;$i<5;$i++) {
        echo gen_num(6).'<br>';
    }
?>