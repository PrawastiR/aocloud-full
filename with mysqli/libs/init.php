<?php
session_start();

function redirectLogin(){
	if(!isset($_SESSION['login'])){
		header('location: index.php');
	}
}

function showMessage(){
	if(isset($_SESSION['message']) && is_array($_SESSION['message'])){
		foreach($_SESSION['message'] as $k=>$err){
			echo '<div class="alert alert-info">'.$err.'</div>';
			unset($_SESSION['message'][$k]);
		}
	}
	if(isset($_SESSION['error']) && is_array($_SESSION['error'])){
		foreach($_SESSION['error'] as $k=>$err){
			echo '<div class="alert alert-danger">'.$err.'</div>';
			unset($_SESSION['error'][$k]);
		}
	}
}
?>