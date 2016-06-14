<?php
require_once('libs/init.php');

if(isset($_POST['email']) && isset($_POST['password'])){
	require_once 'libs/Connection.php';
	$query = mysqli_query($DB, 'SELECT * FROM user WHERE email = "'._e($_POST['email']).'" 
	AND password = "'._e(md5($_POST['password'])).'"');
	
	$user = mysqli_fetch_object($query);
	if($user){
		$_SESSION['login'] = $user->id;
		header('location: dashboard.php');
		exit();
	}elsE{
		$_SESSION['error'][] = "User tidak ditemukan. silahkan register untuk bergabung";
	}
	
	header('location: index.php');
}

header('location: index.php');
?>