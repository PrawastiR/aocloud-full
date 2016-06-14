<?php
$DB = mysqli_connect('localhost', 'root', '');

if (mysqli_connect_errno())
{
  die( "Failed to connect to MySQL: " . mysqli_connect_error() );
}
  
mysqli_select_db($DB, 'pi');

function _e($s){
	global $DB;
	return mysqli_real_escape_string($DB, $s);
}
?>