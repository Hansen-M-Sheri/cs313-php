<?php

//if user has clicked submit button run this file
if(isset($_POST['submit'])){
	include_once 'dbh.php';

	$email = $_POST['email'];
}
elseif (isset($_POST['submitSignup'])){

}
else{
	header("Location: ../")
}