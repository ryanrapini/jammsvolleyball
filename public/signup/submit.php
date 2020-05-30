<?php

require('../../config.php');

$safePost = filter_input_array(INPUT_POST, [
	'name' => FILTER_SANITIZE_STRING,
	'email' => FILTER_SANITIZE_EMAIL,
	'phone' => FILTER_SANITIZE_STRING,
	'skilllevel' => FILTER_SANITIZE_STRING,
	'interest_leagues' => FILTER_VALIDATE_BOOLEAN,
	'interest_tournament' => FILTER_VALIDATE_BOOLEAN,
	'interest_sub' => FILTER_VALIDATE_BOOLEAN,
]);

$message = interestform($safePost);

function interestform($safePost){
	$message = "New Future Player Signup:\n\n";
	$message .= "Player Name: " . $safePost['name'] . "\n";
	$message .= "Player Email: " . $safePost['email'] . "\n";
	$message .= "Player Phone: " . $safePost['phone'] . "\n";
	$message .= "Skill Level: " . $safePost['skilllevel'] . "\n";
	$message .= "Interests: " .  "\n";
	if($safePost['interest_leagues']){
		$message .= "Future Leagues" .  "\n";
	}
	if($safePost['interest_tournament']){
		$message .= "Future Tournaments" .  "\n";
	}
	if($safePost['interest_sub']){
		$message .= "Subbing" .  "\n";
	}
	$message .= "IP Address: " . getenv("REMOTE_ADDR") ."\n";
	if(isset($_SERVER['HTTP_USER_AGENT'])){
		$message .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
	}
	return $message;
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
	$message .= "IP Address: " . getenv("REMOTE_ADDR") ."\n";
	if(isset($_SERVER['HTTP_USER_AGENT'])){
		$message .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
	}
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
	$message .= "IP Address: " . getenv("REMOTE_ADDR") ."\n";
	if(isset($_SERVER['HTTP_USER_AGENT'])){
		$message .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
	}
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

