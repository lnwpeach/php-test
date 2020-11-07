<?php
$message        = "รักลุง เวลา ".date('d/m/Y H:i');
$token          = "mtchjp8i10Bskb2hKRviAdOBbLAsCiccuxJWx5Bwyyt";
$message		= empty($message)?"test":$message;

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL 	=> "https://notify-api.line.me/api/notify",
    
    CURLOPT_DNS_CACHE_TIMEOUT   => 10,
    CURLOPT_CONNECTTIMEOUT 	    => 1,
    CURLOPT_TIMEOUT 			=> 1,
    CURLOPT_RETURNTRANSFER 	    => true,
    CURLOPT_ENCODING 			=> "",
    CURLOPT_MAXREDIRS 		    => 10,
    CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST 	    => "POST",
    CURLOPT_POSTFIELDS 		    => "message={$message}",
    CURLOPT_HTTPHEADER 		    => array(
    "authorization: Bearer {$token}",
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
    ),
));
$response = curl_exec($curl);
?>