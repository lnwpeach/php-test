<?php
require_once __DIR__ . '/vendor/autoload.php';

class Gmail {

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    function getClient($token)
    {
        $client = new Google_Client();

        if(!empty($token)) {
            $client->setAccessToken($token);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                return false;
            }
        }
        return $client;
    }


    /**
    * @param $sender string sender email address
    * @param $to string recipient email address
    * @param $subject string email subject
    * @param $messageText string email text
    * @return Google_Service_Gmail_Message
    */
    function createMessage($sender, $to, $subject, $messageText, $cc="", $attach=[]) {
        $message = new Google_Service_Gmail_Message();

        $boundary = uniqid(rand(), true);
        $rawMessageString = "From: {$sender}\r\n";
        $rawMessageString .= "To: <{$to}>\r\n";
        if($cc) $rawMessageString .= "Cc: {$cc}\r\n";
        $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= 'Content-type: Multipart/Mixed; boundary="' . $boundary . '"' . "\r\n";

        if(!empty($attach)) {
            $filePath = $attach['path'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
            $mimeType = finfo_file($finfo, $filePath);
            $fileName = $attach['name'];
            $fileData = base64_encode(file_get_contents($filePath));
            
            $rawMessageString .= "\r\n--{$boundary}\r\n";
            $rawMessageString .= 'Content-Type: '. $mimeType .'; name="'. $fileName .'";' . "\r\n";            
            $rawMessageString .= 'Content-ID: <' . $sender . '>' . "\r\n";            
            $rawMessageString .= 'Content-Description: ' . $fileName . ';' . "\r\n";
            $rawMessageString .= 'Content-Disposition: attachment; filename="' . $fileName . '"; size=' . filesize($filePath). ';' . "\r\n";
            $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
            $rawMessageString .= chunk_split(base64_encode(file_get_contents($filePath)), 76, "\n") . "\r\n";
        }

        $rawMessageString .= "\r\n--{$boundary}\r\n";
        $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
        // $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
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
    function sendMessage($client, $message) {
        $service = new Google_Service_Gmail($client);
        try {
            $message = $service->users_messages->send('me', $message);
            return true;
        } catch (Exception $e) {
            return false;
        }

        return null;
    }

    function getProfile($client) {
        $service = new Google_Service_Oauth2($client);
        $profile = $service->userinfo->get();
        return $profile;
    }
}