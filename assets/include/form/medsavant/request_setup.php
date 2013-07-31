<?php
include '../../db/connect.php';

$type = $_GET['type'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$institution = $_GET['institution'];
$description = $_GET['description'];
$local_storage = $_GET['local_storage'];

if ($fname == '') {
	print "There was a problem with your registration. Please try again.";
} else {

	$query = "INSERT INTO  `genomesavant`.`ms_tutorial` (`first` , `last` , `institution` , `email` , `attendees` ) VALUES ( " . "'" . $fname . "'," . "'" . $lname . "'," . "'" . $institution . "'," . "'" . $email . "',-1)";

	print 'Thank you for your request, ' . $fname . '. We will contact you shortly.';

	$result = mysql_query($query);

	$myFile = "BetaRegistration.log";
	$fh = fopen($myFile, 'a');
	fwrite($fh, $query . '\n');

	// SEND AN EMAIL TO US
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Reply-To: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = 'support@savantbrowser.com';
	$subject = $fname . " " . $lname . " requested a private MedSavant installation";
	$message = 
		"<html>" 
		. $fname . " " . $lname 
		. " from " . $institution . " recently requested a private MedSavant installation."
		. "<br><h4>Brief description</h4>"
		. $description
		. "<br><br>"
		. "Data will be stored locally? " . $local_storage . "<br><br>"
		. "Contact him/her at " . $email . " </html>";
	// Mail it
	mail($to, $subject, $message, $headers);

	// SEND AN EMAIL TO THE REGISTRANT
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From: support@savantbrowser.com' . "\r\n" . $headers .= 'Reply-To: support@savantbrowser.com' . "\r\n" . $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = $email;
	$subject = "MedSavant Registration Follow-up";

	$message = "<html>Hi " . $fname . ",<br/><br/>";
	$message .= "Thanks for registering for MedSavant. We'll notify you when a full public release becomes available.<br/>";
	$message .= "<br/>";
	$message .= "Best,<br/>";
	$message .= "The MedSavant Development Team</html>";

	mail($to, $subject, $message, $headers);

}

mysql_close($link);
?>
