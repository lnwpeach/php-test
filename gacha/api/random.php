<?php
session_start();

$answer = ['success' => 0, 'message' => ''];
if(!isset($_POST['json'])) {
    $answer['message'] = "Error: no data";
    exit(json_encode($answer));
}

$data = json_decode($_POST['json'], true);

// ---------------------------------------------------

$chance = ['UUR' => 0.1, 'UR' => 0.5, 'SSR' => 1, 'SR' => 5, 'R' => 30, 'N' => 100];

foreach($chance as &$c) {
    $c /= 100;
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

$round = (int)$data['round'];

$reward_arr = [];
for($i = 0; $i < $round; $i++) {
    $reward = random($chance);

    if(isset($reward_arr[$reward]))
        $reward_arr[$reward]++;
    else
        $reward_arr[$reward] = 1;
}

$answer['reward_arr'] = $reward_arr;
$answer['success'] = 1;
$answer['message'] = 'Success';
exit(json_encode($answer));
?>