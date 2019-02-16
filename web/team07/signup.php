<?php
//if GET['error'] isset - handle here

//errors have message in red and red asterisks next to boxes
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>
	<form action="processSignup.php" method="post">
		<input type="text" name="username" placeholder="Username">
		<!-- Check password fields match, and is 7 char & 1 num -->
		<input type="password" name="password" placeholder="Password">
		<input type="password" name="passwordVerify" placeholder="Verify Password">
		<input type="submit" value="Sign Up">
	</form>

</body>
</html>