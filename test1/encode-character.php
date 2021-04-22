Input : <input type="text" name='input'> <input type='submit'><br><br>
Encode : <input type="text" name='encode'><br><br>
Decode : <input type="text" name='decode'><br><br>

<?php
    function encode($input) {
        if(preg_match("/[^a-zA-Z0-9]/", $input))
            return "Error: Input wrong format";

        $result = "";
        for($i=0;$i<strlen($input);$i++) {
            $ascii = ord($input[$i]);
            if($ascii == 120 || $ascii == 121 || $ascii == 122 || $ascii == 88 || $ascii == 89 || $ascii == 90) {
                $ascii -= 26;
            }
            if($ascii == 55 || $ascii == 56 || $ascii == 57)
                $ascii -= 10;
            $result .= chr($ascii+3);
        }
        return $result;
    }

    function decode($input) {
        if(preg_match("/[^a-zA-Z0-9]/", $input))
            return "Error: Input wrong format";

        $result = "";
        for($i=0;$i<strlen($input);$i++) {
            $ascii = ord($input[$i]);
            if($ascii == 97 || $ascii == 98 || $ascii == 99 || $ascii == 65 || $ascii == 66 || $ascii == 67) {
                $ascii += 26;
            }
            if($ascii == 48 || $ascii == 49 || $ascii == 50)
                $ascii += 10;
            $result .= chr($ascii-3);
        }
        return $result;
    }

    $aa = encode('Information');
    $bb = decode($aa);

    echo '<br>';
    echo $aa;
    echo '<br>';
    echo $bb;
    // echo preg_match("/[^a-zA-Z0-9]/", 'abcABC123');
?>