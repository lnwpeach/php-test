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

    function gen_code($len) {
        $str = "";
        for($i=1;$i<=$len;$i++) {
            $rand_up = rand(65, 90);
            $rand_low = rand(97, 122);
            $rand_num = rand(48, 57);
        
            $rand_arr = [$rand_up, $rand_up, $rand_num];
            $rand_sel = rand(1, 2);
            $chr = chr($rand_arr[$rand_sel]);
            $str .= $chr;
            if($i % 4 == 0 && $i != $len) $str .= '-';
        }
    
        return $str;
    }

    for($i=0;$i<5;$i++) {
        echo gen_pass(15).'<br>';
    }

    echo '<br>';

    for($i=0;$i<5;$i++) {
        echo gen_code(16).'<br>';
    }
?>