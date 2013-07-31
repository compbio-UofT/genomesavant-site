
<?php 
$link = mysql_connect('genomesavant.db.7053764.hostedresource.com', 'genomesavant', 'Savant12'); 
if (!$link) {
    die('Could not connect: ' . mysql_error()); 
} else {
	mysql_select_db(ms_tutorial);
}
?> 
