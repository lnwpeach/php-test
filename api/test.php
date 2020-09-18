<?php
    $revise['aaa'] = 'test & aaa';

    $origin		= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}";
    $url   	    = $origin."/test/api/end-point/test-api.php";

    $json = json_encode($revise,JSON_UNESCAPED_UNICODE);
    $json = urlencode($json);

    $curl = curl_init();

    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $strCookie = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';

    session_write_close();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "json={$json}",
        
        CURLOPT_USERAGENT => $useragent,
        CURLOPT_COOKIE => $strCookie,
        
        CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
        "Origin: {$origin}"
        ),
    ));

    $response 	= curl_exec($curl);
    $err 		= curl_error($curl);

    curl_close($curl);

    $res = json_decode($response,true);

    echo "<pre>";
    print_r($res);
?>