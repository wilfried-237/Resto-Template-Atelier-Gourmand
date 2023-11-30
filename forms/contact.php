<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require ('../phpmailer/src/Exception.php');
require ('../phpmailer/src/PHPMailer.php');
require ('../phpmailer/src/SMTP.php');

//SMTP email
if(isset($_POST['action']) && $_POST['action'] == "send_message"){

  $email = 'ateliergourmand@alwaysdata.net';

//Get post entries
$name = $_POST['name'];
$sender_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);



try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-ateliergourmand.alwaysdata.net';  //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $email;                                     //SMTP username
    $mail->Password   = '@waltere237';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email);
    $mail->addAddress($sender_email, $name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    $msg = "Message has been sent";
    
} catch (Exception $e) {
  $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

?>
