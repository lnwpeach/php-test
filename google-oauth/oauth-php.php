<?php
require __DIR__ . '/vendor/autoload.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    $client->setScopes(Google_Service_Gmail::GMAIL_SEND);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    $client->setRedirectUri("https://pchessle.tk/test/google-oauth/get-token.php");

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);

/**
* @param $sender string sender email address
* @param $to string recipient email address
* @param $subject string email subject
* @param $messageText string email text
* @return Google_Service_Gmail_Message
*/
function createMessage($sender, $to, $subject, $messageText, $attach="") {
    $message = new Google_Service_Gmail_Message();

    $boundary = uniqid(rand(), true);
    $rawMessageString = "From: <{$sender}>\r\n";
    $rawMessageString .= "To: <{$to}>\r\n";
    $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
    $rawMessageString .= "MIME-Version: 1.0\r\n";

    $filePath = 'composer.json';
    $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
    $mimeType = finfo_file($finfo, $filePath);
    $fileName = 'composer.json';
    $fileData = base64_encode(file_get_contents($filePath));
    
    $rawMessageString .= 'Content-type: Multipart/Mixed; boundary="' . $boundary . '"' . "\r\n";
    $rawMessageString .= "\r\n--{$boundary}\r\n";
    $rawMessageString .= 'Content-Type: '. $mimeType .'; name="'. $fileName .'";' . "\r\n";            
    $rawMessageString .= 'Content-ID: <' . $sender . '>' . "\r\n";            
    $rawMessageString .= 'Content-Description: ' . $fileName . ';' . "\r\n";
    $rawMessageString .= 'Content-Disposition: attachment; filename="' . $fileName . '"; size=' . filesize($filePath). ';' . "\r\n";
    $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
    $rawMessageString .= chunk_split(base64_encode(file_get_contents($filePath)), 76, "\n") . "\r\n";

    $rawMessageString .= "\r\n--{$boundary}\r\n";
    $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
    $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
    $rawMessageString .= "{$messageText}\r\n";


    $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
    $message->setRaw($rawMessage);
    return $message;
}

/**
* @param $service Google_Service_Gmail an authorized Gmail API service instance.
* @param $userId string User's email address or "me"
* @param $message Google_Service_Gmail_Message
* @return null|Google_Service_Gmail_Message
*/
function sendMessage($service, $userId, $message) {
    try {
        $message = $service->users_messages->send($userId, $message);
        print 'Message with ID: ' . $message->getId() . ' sent.';
        return $message;
    } catch (Exception $e) {
        print 'An error occurred: ' . $e->getMessage();
    }

    return null;
}

$sender = "pichayuth.c@gmail.com";
$to = "gun.burimjit@gmail.com";
$subject = "Test";
$messageText = "Test gmail api <b>BOLD</b>";
$message = createMessage($sender, $to, $subject, $messageText);
sendMessage($service, 'me', $message);