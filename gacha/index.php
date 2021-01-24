<?php
session_start();

?>

<html>
<head></head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<body>
    <h3>ทดสอบความเกลือ</h3>
    Round: <input type='number' name='round' value='1' min='1'> <button onclick='random()'>Random</button>
    <br>
    <br>

    Reward: <span name='reward'></span>

    <br><br>
    <table border=1 style='width: 200px;'>
        <thead>
            <tr>
                <td>Item</td>
                <td>Rate</td>
                <td>Qty</td>
            </tr>
        </thead>
        <tbody id='item_total'>
            <tr>
                <td>1</td>
                <td>0</td>
                <td name='r_qty'></td>
            </tr>
            <tr>
                <td>2</td>
                <td>0</td>
                <td name='sr_qty'></td>
            </tr>
            <tr>
                <td>3</td>
                <td>94.3</td>
                <td name='ssr_qty'></td>
            </tr>
            <tr>
                <td>4</td>
                <td>5.1</td>
                <td name='ur_qty'></td>
            </tr>
            <tr>
                <td>5</td>
                <td>0.6</td>
                <td name='uur_qty'></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>Sum</td>
                <td name='sum_qty'></td>
            </tr>
        </tfoot>
    </table>

    <br>
    <button onclick='clear_reward()'>Clear</button>
</body>
</html>

<script>
function random() {
    var q = {};
        q['round'] = $('[name=round]').val();
    var json = JSON.stringify(q);
    var url = "api/random.php";
    $.ajax({
        data: {'json': json}, url: url, type: 'post', dataType: 'json',
        success: function(res) {
            if(res.success != 1) {
                alert(res.message);
            }
            
            var reward = res.reward;

            var txt = "";
            $.each(reward, function(k, v) {
                if(v)
                    txt += `${k}: ${v} | `;
            });
            txt = txt.slice(0, -3);
            $('[name=reward]').text(txt);

            if(localStorage.reward_total && localStorage.reward_total != '{}') {
                reward_total = JSON.parse(localStorage.reward_total);
            } else {
                reward_total = {};
            }

            $.each(reward, function(k, v) {
                if(reward_total[k]) {
                    reward_total[k] += v;
                } else {
                    reward_total[k] = v;
                }
            });

            reward_total = JSON.stringify(reward_total);
            localStorage.setItem('reward_total', reward_total);
            
            retrieve();
        }
    })
}

function retrieve() {
    if(localStorage.reward_total && localStorage.reward_total != '{}') {
        reward_total = JSON.parse(localStorage.reward_total);
    } else {
        reward_total = '';
    }

    if(reward_total) {
        $("[name=r_qty]").text(reward_total[1]);
        $("[name=sr_qty]").text(reward_total[2]);
        $("[name=ssr_qty]").text(reward_total[3]);
        $("[name=ur_qty]").text(reward_total[4]);
        $("[name=uur_qty]").text(reward_total[5]);
    } else {
        $("[name=n_qty]").text(0);
        $("[name=r_qty]").text(0);
        $("[name=sr_qty]").text(0);
        $("[name=ssr_qty]").text(0);
        $("[name=ur_qty]").text(0);
        $("[name=uur_qty]").text(0);
    }

    var sum = 0;
    for(var i=1;i<=5;i++) {
        sum += reward_total[i]*1;
    }
    $("[name=sum_qty]").text(sum || 0);
}

function clear_reward() {
    if( !confirm('Are you sure?') ) return false;

    $('[name=reward]').text('');
    localStorage.setItem('reward_total', '{}');
    retrieve();
}

$("[name=round]").on('keydown', function(e) {
    if(e.keyCode == 13) random();
})

$(document).ready(function() {
    retrieve();
})
</script>