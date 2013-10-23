<?php

$con = mysqli_connect("50.63.244.198", "savantusage", "Savant12!", "savantusage");
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//print_r($_POST);

$data = "";

$sep = "|";
$kvpsep = "=>";

foreach ($_POST as $key => $value) {
	$data = $data . $sep . $key . $kvpsep . $value;
}

$additional = "server-time" . $kvpsep . time() . $sep . "client-ip" . $kvpsep . $_SERVER['REMOTE_ADDR'];

// data already starts with a separator so dont need one
$data = $additional . $data;
echo $data;
$file = 'usage.txt';
$fh = fopen($file, 'a');
fwrite($fh, $data . "\n");
fclose($fh);

mysqli_query($con, "INSERT INTO log (msg) VALUES ('" . $data . "')");

mysqli_close($con);
?>