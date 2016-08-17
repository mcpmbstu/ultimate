<?php
/******** parse the main site settings files
**************************************************/
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
require_once( 'mycaptcha.php');
$errors = ''; 
session_start();

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data



// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array

    //if (empty($_POST['firtName']))
//        $errors['firtName'] = 'Name is required.';
//
//    if (empty($_POST['emailAddress']))
//        $errors['emailAddress'] = 'Email is required.';
//
//    if (empty($_POST['lastName']))
//        $errors['lastName'] = 'Superhero alias is required.';

if(isset($_POST['firtName'])){$firtName=$_POST['firtName'];} 
if(isset($_POST['lastName'])){$lastName=$_POST['lastName'];} 
if(isset($_POST['emailAddress'])){$emailAddress=$_POST['emailAddress'];} 
if(isset($_POST['utPackages'])){$utPackages=$_POST['utPackages'];} 
if(isset($_POST['ut_activity'])){$ut_activity=$_POST['ut_activity'];} 
if(isset($_POST['ut_accommodation'])){$ut_accommodation=$_POST['ut_accommodation'];} 
if(isset($_POST['ut_telephone'])){$ut_telephone=$_POST['ut_telephone'];} 
if(isset($_POST['ut_participant'])){$ut_participant=$_POST['ut_participant'];} 
if(isset($_POST['ut_days'])){$ut_days=$_POST['ut_days'];} 
if(isset($_POST['ut_months'])){$ut_months=$_POST['ut_months'];} 
if(isset($_POST['ut_years'])){$ut_years=$_POST['ut_years'];}
if(isset($_POST['ut_message'])){$ut_message=$_POST['ut_message'];} 
if(isset($_POST['captcha'])){$captcha=$_POST['captcha'];} 

//// assumes $to, $subject, $message have already been defined earlier...
if ( function_exists( 'ot_get_option' ) ) {
  $receiver_address = ot_get_option( 'receiver_address' );
  $cc_address 		= ot_get_option( 'cc_address' );
  $email_subject 	= ot_get_option( 'email_subject' );
}

		
	
	if(empty($_SESSION['captcha'] ) ||
	  strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		//$errors .= "\n The captcha code does not match!";
		$errors['message'] = '<h3 style="text-align: center; color: #000;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><br/><strong>Sorry fail to send!!!</strong> <br /><b>The captcha code does not match!</b>.</h3>';
		
	} 

// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
		
		global $wpdb;	
if(isset($_POST['firtName'])){$firtName=$_POST['firtName'];} 
if(isset($_POST['lastName'])){$lastName=$_POST['lastName'];} 
if(isset($_POST['emailAddress'])){$emailAddress=$_POST['emailAddress'];} 
if(isset($_POST['utPackages'])){$utPackages=$_POST['utPackages'];} 
if(isset($_POST['ut_activity'])){$ut_activity=$_POST['ut_activity'];} 
if(isset($_POST['ut_accommodation'])){$ut_accommodation=$_POST['ut_accommodation'];} 
if(isset($_POST['ut_telephone'])){$ut_telephone=$_POST['ut_telephone'];} 
if(isset($_POST['ut_participant'])){$ut_participant=$_POST['ut_participant'];} 
if(isset($_POST['ut_days'])){$ut_days=$_POST['ut_days'];} 
if(isset($_POST['ut_months'])){$ut_months=$_POST['ut_months'];} 
if(isset($_POST['ut_years'])){$ut_years=$_POST['ut_years'];}
if(isset($_POST['ut_message'])){$ut_message=$_POST['ut_message'];} 
if(isset($_POST['captcha'])){$captcha=$_POST['captcha'];} 

$wpdb->insert( 
	'wp_contact_info', 
	array( 
		'first_name' 			=> $firtName, 
		'last_name' 			=> $lastName,
		'email' 				=> $emailAddress, 
		'telephone' 			=> $ut_telephone,
		'package' 				=> $utPackages, 
		'activity' 				=> $ut_activity,
		'accommodation' 		=> $ut_accommodation, 
		'no_of_participants' 	=> $ut_participant,
		'dates' 				=> $ut_months.'-'.$ut_days.'-'.$ut_years, 
		'message' 				=> $ut_message,
		'status' 				=> 0,
		'date_time'				=>current_time('mysql', 1)
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
		'%s',
		'%s', 
		'%d',
		'%s' 
	) 
);

        // if there are no errors process our form, then return a message

        // DO ALL YOUR FORM PROCESSING HERE
        // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)

        // show a message of success and provide a true success variable
		$eol = "\r\n";
		$headers[] = "Content-Type: text/html; charset=UTF-8".$eol;;
		$headers[] = "From: $firtName $lastName <$receiver_address>".$eol;;
		//$headers[] = "Cc: John Q Codex <jqc@wordpress.org>";
		$headers[] = "Cc: $cc_address".$eol; // note you can just use a simple email address
		$headers[] = "Content-Transfer-Encoding: 7bit".$eol;
$headers[] = "\n";
		
		$body  ="<h3>CONTACT US TO BOOK</h3>";
		$body .= "<p>Name: ".$firtName." ".$lastName."</p>";
		$body .= "<p>Email: ".$emailAddress."</p>";
		$body .= "<p>Package: ".$utPackages."</p>";
		$body .= "<p>Activity: ".$ut_activity."</p>";
		$body .= "<p>Accommodation: ".$ut_accommodation."</p>";
		$body .= "<p>Number of Participants: ".$ut_participant."</p>";
		$body .= "<p>Date: ".$ut_days."-".$ut_months."-".$ut_years."</p>";
		$body .= "<p>Message: ".$ut_message."</p>";
		
		wp_mail( $receiver_address, $email_subject, $body, $headers );
		
        $data['success'] = true;
        $data['message'] = '<h3 style="text-align: center; color: #000;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><br/>Thank you <br />Your message has been sent successfully.</h3>';	
		
    }
	

	
	
	

    // return all our data to an AJAX call
    echo json_encode($data);
	



?>