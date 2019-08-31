<?php

require('../../config.php');

$safePost = filter_input_array(INPUT_POST, [
	'formtype' => FILTER_SANITIZE_STRING,
	'name' => FILTER_SANITIZE_STRING,
	'email' => FILTER_SANITIZE_EMAIL,
	'phone' => FILTER_SANITIZE_STRING,
	'teamname' => FILTER_SANITIZE_STRING,
	'weekday' => FILTER_SANITIZE_STRING,
	'skilllevel' => FILTER_SANITIZE_STRING,
	'notes' => FILTER_SANITIZE_STRING,
	'checkbox' => FILTER_VALIDATE_BOOLEAN ,

]);

if(empty($safePost["formtype"])){
	response(false, "Invalid form type");
}

$message = "";

if($_POST["formtype"] === "full"){
	if($safePost['checkbox'] != 1){
		response(false, "You must check the box");
	}
	$message = fullform($safePost);
} 
else if($_POST["formtype"] === "individual"){
	$message = individualform($safePost);
} 
else {
	response(false, "Invalid form type");
}

function fullform($safePost) {
	$message = "New Team Signup:\n\n";
	$message .= "Captain Name: " . $safePost['name'] . "\n";
	$message .= "Captain Email: " . $safePost['email'] . "\n";
	$message .= "Captain Phone: " . $safePost['phone'] . "\n";
	$message .= "Team Name: " . $safePost['teamname'] . "\n";
	$message .= "Day of the Week: " . $safePost['weekday'] . "\n";
	$message .= "Skill Level: " . $safePost['skilllevel'] . "\n";
	$message .= "Additional Notes: " . $safePost['notes'] . "\n";
	return $message;
}

function individualform($safePost) {
	$message = "New Individual Player Signup:\n\n";
	$message .= "Player Name: " . $safePost['name'] . "\n";
	$message .= "Player Email: " . $safePost['email'] . "\n";
	$message .= "Player Phone: " . $safePost['phone'] . "\n";
	$message .= "Day of the Week: " . $safePost['weekday'] . "\n";
	$message .= "Skill Level: " . $safePost['skilllevel'] . "\n";
	$message .= "Additional Notes: " . $safePost['notes'] . "\n";
	return $message;
}

function response($status, $message){
	if($status){
		echo "true";
		die();
	}
	else {
		echo $message;
		die();
	}
}

if ($message === "") {
	response(false, "Failed to generate message");
}

// require("../php/sendgrid/sendgrid-php.php");
// $email = new \SendGrid\Mail\Mail();
// $email->setFrom("mail@jammsvolleyball.com", "JAMMS Volleyball");
// $email->setSubject("New Signup for JAMMS");
// $email->addTo("ryanrapini@gmail.com", "Ryan Rapini");
// $email->addContent(
//     "text/plain", $message
// );

// $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
// try {
//     $response = $sendgrid->send($email);
//     response(true, "");
// } catch (Exception $e) {
//     response(false, $e->getMessage());
// }

// Using Awesome https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../php/phpmailer/src/Exception.php';
require '../php/phpmailer/src/PHPMailer.php';
require '../php/phpmailer/src/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = getenv('SMTP_EMAIL');   // SMTP username
$mail->Password = getenv('SMTP_PASS');                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

$mail->From = 'director@jammsvolleyball.com';
$mail->FromName = 'League Director';
$mail->addAddress('ryanrapini@gmail.com');                 // Add a recipient

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

$mail->Subject = 'New Signup for JAMMS';
$mail->Body    = $message;

if(!$mail->send()) {
	response(false, 'Mailer Error: ' . $mail->ErrorInfo);
} else {
    response(true, "");
}

