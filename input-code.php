<html>
<head></head>
<body>
    <h3>Gen Password</h3>
    Code: <input type='text' name='code' oninput='input_code(event)'>
    <!-- <form action="" method='post'>
        Password: <input type='password' name='password' value=''> <input type='submit' name='submit'>
        <br>
        <br>
        <input type='submit' name='clear' value='Clear'>
    </form> -->

    <br><br><br>
</body>
</html>
<script>
// 1234567890123456
// 12345678901234561234567890123456
function input_code(e) {
    if(e.inputType == 'deleteContentBackward' || e.inputType == 'deleteContentForward') {
        return false;
    } else if(e.inputType == 'insertFromPaste') {
        paste_code();
        return false;
    }

    var box = document.querySelector('[name=code]');
    var val = box.value;
    var temp = "";
    for(var i=0;i<val.length;i++) {
        if(i == 3 && val[i+1] != '-') {
            temp = val.slice(0, i+1)+'-'+val.slice(i+1);
        } else if(i == 8 && val[i+1] != '-') {
            temp = val.slice(0, i+1)+'-'+val.slice(i+1);
        } else if(i == 13 && val[i+1] != '-') {
            temp = val.slice(0, i+1)+'-'+val.slice(i+1);
        }
    }
    if(temp) box.value = temp;
}

function paste_code() {
    var box = document.querySelector('[name=code]');
    var val = box.value;
    for(var i=0;i<val.length;i++) {
        if(i == 4 && val[i] != '-') {
            val = val.slice(0, i)+'-'+val.slice(i);
        } else if(i == 9 && val[i] != '-') {
            val = val.slice(0, i)+'-'+val.slice(i);
        } else if(i == 14 && val[i] != '-') {
            val = val.slice(0, i)+'-'+val.slice(i);
        }
    }
    if(val) box.value = val;
}

</script>