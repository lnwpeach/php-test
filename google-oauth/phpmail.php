<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require 'vendor/autoload.php';

$content = "PHPMailer GMail XOAUTH2 SMTP test";
$attach = __DIR__.'/../engine-invoice/pdf-a3/pdf-a3-invoice.pdf';


$cc = "csemail@uat.etax.teda.th";
// $cc = "csemail@etax.teda.th";

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Set AuthType to use XOAUTH2
$mail->AuthType = 'XOAUTH2';

//Fill in authentication details here
//Either the gmail account owner, or the user that gave consent
$email = 'pichayuth.c@gmail.com';
$clientId = '12242211159-i2vo8ot586440flv34vv14pcl7r2i1un.apps.googleusercontent.com';
$clientSecret = 'qQ7M0LihQ7Ac99rLSuJgPe8S';

//Obtained by configuring and running get_oauth_token.php
//after setting up an app in Google Developer Console.
$refreshToken = '1//0g43qak52vUuyCgYIARAAGBASNwF-L9IrsZAmzbn41FDtgqE7UWtvmCvw977GcgX5shSUNlAW-iYmzXhfM0eGxUHNNPVP0qVY0kc';

//Create a new OAuth2 provider instance
$provider = new Google(
    [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]
);

//Pass the OAuth provider instance to PHPMailer
$mail->setOAuth(
    new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    )
);


// $mail->From = 'ammypooh.cl@gmail.com';
// $mail->FromName = $_SESSION["channel_name"];
$mail->setFrom($email, 'Peach');
$mail->addAddress("gun.burimjit@gmail.com");                 	// Add a recipient
// $mail->addCC($cc);
// $mail->addAttachment($attach);         				// Add attachments

$mail->isHTML(true);  
$mail->Subject = $data["subject"];
$mail->Body    = $content;

if(!$mail->send()) {
	$answer['message'] =  'Mailer Error: ' . $mail->ErrorInfo;
	exit(json_encode($answer));
}

// $pdo2->query("update invoice set sent_etax = sent_etax + 1 where company_id='{$_SESSION["company_id"]}' and invoice_id = '{$id}'");
// $email->counter();
// insertLog($pdo2,$_POST['json']);

//-- Answer array
$answer["success"] = 1;
$answer["message"] = "Send Invoice";
//-- push answer in term of json
exit(json_encode($answer));
?>
