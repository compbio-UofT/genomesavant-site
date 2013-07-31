<?php
include '../../db/connect.php';
?>
<?php

$tool = $_GET['tool'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$institution = $_GET['institution'];
$attendees = $_GET['attendees'];

if ($fname == '') {
	print "There was a problem with your registration. Please try again later.";
} else {

	$query = "INSERT INTO  `genomesavant`.`ms_tutorial` (`first` , `last` , `institution` , `email` , `attendees` ) VALUES ( " . "'" . $fname . "'," . "'" . $lname . "'," . "'" . $institution . "'," . "'" . $email . "'," . $attendees . ")";

	print 'Thank you for your request, ' . $fname . '. We will contact you shortly.';

	$result = mysql_query($query);

	$myFile = "Registration.log";
	$fh = fopen($myFile, 'a');
	fwrite($fh, $query . '\n');

	// To send HTML mail, the Content-type header must be set
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Reply-To: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = 'support@savantbrowser.com';
	$subject = $fname . " " . $lname . " requested a " . $tool . " tutorial";
	$message = "<html>" . $fname . " " . $lname . " from " . $institution . " recently registered " . $attendees . " individual(s) for a " . $tool . " tutorial. Contact him/her at " . $email . " </html>";
	// Mail it
	mail($to, $subject, $message, $headers);

}

mysql_close($link);
?>