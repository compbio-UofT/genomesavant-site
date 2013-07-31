<?php
include '../../db/connect.php';

$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$institution = $_GET['institution'];

if ($fname == '') {
	print "There was a problem with your submission. Please try again.";
} else {

	$query = "INSERT INTO  `genomesavant`.`ms_tutorial` (`first` , `last` , `institution` , `email` , `attendees` ) VALUES ( " . "'" . $fname . "'," . "'" . $lname . "'," . "'" . $institution . "'," . "'" . $email . "',-1)";

	print 'Thank you for your request, ' . $fname . '. We will contact you when the portal is made available.';

	$result = mysql_query($query);

	$myFile = "BetaRegistration.log";
	$fh = fopen($myFile, 'a');
	fwrite($fh, $query . '\n');

	// SEND AN EMAIL TO US
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Reply-To: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = 'support@savantbrowser.com';
	$subject = $fname . " " . $lname . " requested access to the public MedSavant portal";
	$message = 
		"<html>" 
		. $fname . " " . $lname 
		. " from " . $institution . " recently requested access to the public MedSavant portal.<br><br>"
		. "Contact him/her at " . $email . " </html>";
	// Mail it
	mail($to, $subject, $message, $headers);
	
	
	// SEND AN EMAIL TO USER
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Reply-To: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = $email;
	$subject = "MedSavant Public Portal Access";
	$message = 
		"<html>Thank you for your interest in MedSavant. We are currently rebuilding the portal and will notify you with credentials when it becomes available.</html>";
	// Mail it
	mail($to, $subject, $message, $headers);
	
}

mysql_close($link);
?>
