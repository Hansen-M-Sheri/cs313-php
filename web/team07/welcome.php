<?php
session_start();
// echo $_SESSION['username'];
$username = "";
// get user data from sessions if set
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
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
	<h3 Welcome <?php echo $username; ?></h3>
</body>
</html>