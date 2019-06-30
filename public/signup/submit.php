<?php

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
mail("ryanrapini@gmail.com","New Signup for JAMMS",$message);

response(true, "");

