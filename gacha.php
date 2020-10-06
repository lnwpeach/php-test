<?php
session_start();

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$round = isset($_POST['round']) ? $_POST['round']*1 : 1;
$submit = isset($_POST['submit']) ? true : false;
$clear = isset($_POST['clear']) ? true : false;

$chance = ['UUR' => 0.1, 'UR' => 0.5, 'SSR' => 1, 'SR' => 5, 'R' => 30, 'N' => 100];
// $chance = ['Small' => 4.44, 'Large' => 39.8, 'Decreasing' => 55.7, 'OUT' => 100];
?>

<html>
<head></head>
<body>
    <h3>ทดสอบความเกลือ</h3>
    <form action="" method='post'>
        Round: <input type='number' name='round' value='<?php echo $round;?>' min='1'> <input type='submit' name='submit'>
        <br>
        <br>
        <input type='submit' name='clear' value='Clear'>
    </form>
</body>
</html>

<?php

if($submit) {
    submit();
} else if($clear) {
    $_SESSION['round'] = 0;
    $_SESSION['reward_log'] = [];
}

function random($chance) {
    $rand = ((float)mt_rand()/(float)getrandmax());
    $reward = 'Out';
    foreach($chance as $k => $c) {
        if($rand < $c) {
            $reward = $k;
            break;
        }
        $rand -= $c;
    }
    return $reward;
}

function submit() {
    global $chance, $round;

    foreach($chance as &$c) {
        $c /= 100;
    }

    $reward_log = [];
    for($i = 0; $i < $round; $i++) {
        $reward = random($chance);

        if(isset($reward_log[$reward]))
            $reward_log[$reward]++;
        else
            $reward_log[$reward] = 1;

        $_SESSION['round']++;
    }

    foreach($reward_log as $k => $v) {
        $_SESSION['reward_log'][$k] += $v;
    }

    // echo $reward.'<br>';

    echo 'Reward<br>';
    echo '<pre>';
    print_r($reward_log);
    echo '</pre>';

    echo 'Round: '.$_SESSION['round'].'<br><br>';

    echo 'Reward Log<br>';
    echo '<pre>';
    print_r($_SESSION['reward_log']);
    echo '</pre>';
    echo '<hr>';
}


?>