<?php
session_start();

//get user data from sessions if set
if(isset($_POST['username'])){
	$username = $_POST['username'];
}
else {
	// if not redirect to signin page
	$newURL = 'signin.php';
	header ("Location: $newURL");
	die();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>WELCOME</title>
</head>
<body>
	<h3 Welcome <?php $username ?></h3>
</body>
</html>