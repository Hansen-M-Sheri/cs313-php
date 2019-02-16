<?php
include 'dbh.php';
//Get post values for username & password
if(isset($_POST['username'])){
	$user = htmlspecialchars($_POST['username']);
	$pwd  = htmlspecialchars($_POST['password']);
	$pwdVerify = htmlspecialchars($_POST['passwordVerify']);

	//stretch 1 - do password fields match, if not return error
	if($pwd != $pwdVerify){
		$newURL = 'signup.php?error=passwordMatch';
		header("Location: $newURL");
		die();
	}
	else {
		//stretch 2 - password must be 7 characters & have a number or error

		//hash password 
		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		//insert user to db
		$sql = 'INSERT INTO team.user (username, password) VALUES (:username, :pwd);';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':username', $user);
		$stmt->bindValue(':pwd', $hashedPwd);
		$stmt->execute();
		// $userID = $db->lastInsertID('user_id_seq');
		// if($userID < 1) { //failed insert
		// 	$newURL = 'signup.php?error=dbInputUser';
		// 	header("Location: $newURL");
		// 	die();
		// }
		// else {
			$newURL = 'signin.php';
			header("Location: $newURL");
			die();
		// }
	}
}
else {
	$newURL = 'signup.php?error=noUsername';
	header("Location: $newURL");
	die();
}









//redirect to sign-in page

