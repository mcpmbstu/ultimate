<?php
/******** parse the main site settings files
**************************************************/
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' ); 

function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}





// return all our data to an AJAX call
//echo json_encode($data); 
$errors = '';  
$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data
$data['success'] = false;

//// assumes $to, $subject, $message have already been defined earlier...
if ( function_exists( 'ot_get_option' ) ) {
  $receiver_address = ot_get_option( 'receiver_address' );
  $cc_address 		= ot_get_option( 'cc_address' );
  $email_subject 	= ot_get_option( 'email_subject' );
}


// step 1 form data
if(isset($_POST['steps_package_name'])){$steps_package_name=$_POST['steps_package_name'];} 
// step 2 form data
if(isset($_POST['step_2_number'])){$step_2_number=$_POST['step_2_number'];} 
if(isset($_POST['step_2_message'])){$step_2_message=$_POST['step_2_message'];} 
if(isset($_POST['recomanded'])){$recomanded=$_POST['recomanded']; $all_recommand = implode (", ", $recomanded); } 
if(isset($_POST['additional'])){$additional=$_POST['additional']; $all_additional = implode (", ", $additional); } 
if(isset($_POST['meals'])){$meals=$_POST['meals']; $all_meals = implode (", ", $meals); } 
// step 3 form data
if(isset($_POST['step_3_night_stay'])){$step_3_night_stay=$_POST['step_3_night_stay'];} 
if(isset($_POST['step_3_night_date'])){$step_3_night_date=$_POST['step_3_night_date'];} 
if(isset($_POST['step_3_many_days'])){$step_3_many_days=$_POST['step_3_many_days'];} 
if(isset($_POST['step_3_text_notes'])){$step_3_text_notes=$_POST['step_3_text_notes'];} 
// step 4 form data
if(isset($_POST['step_4_first_name'])){$step_4_first_name=$_POST['step_4_first_name'];} 
if(isset($_POST['step_4_last_name'])){$step_4_last_name=$_POST['step_4_last_name'];} 
if(isset($_POST['ut_step4_telephone'])){$ut_step4_telephone=$_POST['ut_step4_telephone'];} 
if(isset($_POST['step_4_email'])){$step_4_email=$_POST['step_4_email'];} 

global $wpdb;
	$wpdb->insert( 
	'wp_experienced_builder', 
	array( 
		'steps_package_name'		=> $steps_package_name, 
		'group_size' 				=> $step_2_number,
		'sort_of_adventure'			=> $step_2_message, 
		'recommended_activites'		=> $all_recommand,
		'additional' 				=> $all_additional, 
		'meals' 					=> $all_meals,		
		'trip_date' 				=> $step_3_night_date, 
		'number_of_night_stay' 		=> $step_3_night_stay,
		'flexibility_of_date' 		=> $step_3_many_days,
		'notes'						=>$step_3_text_notes,		
		'first_name' 				=> $step_4_first_name, 
		'last_name' 				=> $step_4_last_name,
		'telephone' 				=> $ut_step4_telephone,
		'email'						=>$step_4_email,
		'status'					=> 0,
		'created'					=>current_time('mysql', 1)
	), 
	array( 
		'%s',
		'%s',
		'%s',
		'%s',
		'%s',
		'%s',
		'%s',
		'%s',
		'%d',
		'%s', 
		'%s',
		'%s',
		'%s',
		'%s',
		'%d',
		'%s' 
	) 
);




		$body  ="<table cellpadding='0' cellspacing='0' style='border-collapse:collapse; border: 1px solid #333; margin: auto; padding: 10px;'>";
		$body .= "<tr><td colspan='2'><h3 style='text-align: center; font-size: 1.3em;'>OWN PERFECT ADVENTURE FORM</h3></td></tr>";
		
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Package Type:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$steps_package_name."</td></tr>";
		
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px; width: 120px;'><strong>Group Size:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_2_number."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Advanture words:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_2_message."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'>Looking For: </td><td style='border:1px solid #333333; padding: 10px;'>".$all_recommand . $all_additional . $all_meals."</td></tr>";
		
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Staying Date:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_3_night_date."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Number of Night:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_3_night_stay."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Flexibility of date:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_3_many_days."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Notes \ Questions:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_3_text_notes."</td></tr>";
		
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>First Name:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_4_first_name."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Last Name:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_4_last_name."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Phone/Mobile:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$ut_step4_telephone."</td></tr>";
		$body .= "<tr><td style='border:1px solid #333333; padding: 10px;'><strong>Sender Email:</strong> </td><td style='border:1px solid #333333; padding: 10px;'>".$step_4_email."</td></tr>";
		$body .= "</table>";


if(IsInjected($step_4_email))
{
    echo "Bad email value!";
    exit;
}else{ 
	
	wp_mail( $receiver_address, "PERFECT ADVENTURE REQUEST", $body);
	$data['success'] = true;  
}

 


$data['message'] = '<h3 style="text-align: center; color: #000;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><br/>Thank you <br />Your message has been sent successfully.</h3>';	
echo json_encode($data);
?>