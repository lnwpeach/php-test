<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

if(!isset($_GET['code']) || !isset($_GET['scope'])) {
    echo "Unauthorized Page";
    exit();
}

$company_id = $_SESSION['company_id'];
$authCode = $_GET['code'];

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
$client = new Google_Client();
$client->setScopes([Google_Service_Gmail::GMAIL_READONLY, Google_Service_Gmail::GMAIL_SEND]);
$client->setAuthConfig('credentials.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$client->setRedirectUri("https://pchessle.tk/test/google_oauth/get-token.php");

// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

// Check to see if there was an error.
if (array_key_exists('error', $accessToken)) {
    echo "Error<br>";
    echo "<pre>";
    print_r($accessToken);
    echo "</pre>";
    exit();
}

$expire_in = (int)$accessToken['expires_in'];
$gmail_setting = [
    'company_id'        => $company_id,
    'update_dt'         => date('Y-m-d H:i:s'),
    'access_token'      => $accessToken['access_token'],
    'access_expire'     => date('Y-m-d H:i:s', strtotime("+ {$expire_in} second")),
    'refresh_token'     => $accessToken['refresh_token'],
];

echo "<pre>";
print_r($gmail_setting);
echo "</pre>";