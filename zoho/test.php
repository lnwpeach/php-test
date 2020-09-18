<?php
$client_id = "1000.2THHBR42N3GOA6Y8XM4K4M485IV8YR";
$client_secret = "f32f8200a4ac9bc27c7fd6f2547d9179a54ce2fa22";
$redirect_uri = "http://localhost/test/zoho/test.php?id=1";

$zoho_url = "https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.modules.ALL&client_id={$client_id}&response_type=code&access_type=offline&redirect_uri={$redirect_uri}";
echo "<a href='{$zoho_url}' target='_blank'>{$zoho_url}</a>";

if(isset($_GET['code'])) {
    // $revise = array("client_id"=>$client_id,"client_secret"=>$client_secret,"redirect_uri"=>$redirect_uri,"code"=>$_GET['code'],"grant_type"=>"authorization_code"); 
    // $url = "https://accounts.zoho.com/oauth/v2/token";
    // $revise = http_build_query($revise);

    // $curl = curl_init();

    // session_write_close();

    // curl_setopt_array($curl, array(
    //     CURLOPT_URL => $url,
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 30,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_POSTFIELDS => $revise,
    // ));

    // $response 	= curl_exec($curl);
    // $err 		= curl_error($curl);

    // curl_close($curl);

    // $res = json_decode($response,true);

    // echo "<pre>";
    // print_r($res);
    // exit();

    // time 2020-09-16 13:16
    // [access_token] => 1000.f81edcd219575f15ff4709c72c8fba28.eed79b54abccf6ca072423bee34cc9c6
    // [refresh_token] => 1000.3c5ba4a9b73361a03ffe34804a538877.7c82b3419682dfdf0cadc59803b1a5ac

    $access_token = "1000.f81edcd219575f15ff4709c72c8fba28.eed79b54abccf6ca072423bee34cc9c6";

    $curl = curl_init();

    session_write_close();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.zohoapis.com/crm/v2/Sales_Orders",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Zoho-oauthtoken ".$access_token,
        ),
    ));

    $response 	= curl_exec($curl);
    $err 		= curl_error($curl);

    curl_close($curl);

    $res = json_decode($response,true);

    echo "<pre>";
    print_r($res);
}

?>