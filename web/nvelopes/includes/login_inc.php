<?php

//if user has clicked submit button run this file
if(isset($_POST['submitLogin'])){
	include_once 'dbh.php';

	$email = $_POST['email'];
	echo $email;
}
elseif (isset($_POST['submitSignup'])){

}
else{
	header("Location: ../login.php");
}