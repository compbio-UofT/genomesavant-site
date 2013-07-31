<?php

$tool = $_POST['tool'];
$exception = $_POST['exception'];
$name = $_POST['name'];
$email = $_POST['email'];
$institution = $_POST['institution'];
$problem = $_POST['problem'];
$clientinfo = $_POST['clientinfo'];

if ($name == '' || $tool == '' || $email == '' || $institution == '' || $problem == '') {
	print "There was a problem with your report. Please try again.";
	/*print $tool . "<br>";
	print $name . "<br>";
	print $email . "<br>";
	print $institution . "<br>";
	print $problem . "<br>";*/
} else {
	print 'Thank you for your report, ' . $name . '. We will address this as soon as possible.';

	// To send HTML mail, the Content-type header must be set
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Reply-To: no-reply@savantbrowser.com' . "\r\n" . $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = 'support@savantbrowser.com';
	$subject = $name . " reported a bug in " . $tool;
	$message = "<html>" . $name . " from " . $institution . " recently reported a bug in " . $tool . ". Contact him/her at " . $email . "<br/><br/><b>Description of problem:</b><br/>" . $problem . "<br/><br/><b>Exception:</b><br/>" . $exception . "<br/><br/><b>Client-information:</b><br/>" . $clientinfo . "</html>";
	// Mail it
	mail($to, $subject, $message, $headers);

}

?>
