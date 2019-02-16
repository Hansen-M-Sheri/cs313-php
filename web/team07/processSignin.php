<?php
session_start();
include 'dbh.php';
//get the POST from signin
if(isset($_POST['username'])){
	$user = htmlspecialchars($_POST['username']);
	$pwd  = htmlspecialchars($_POST['password']);

	// echo $user;
	//Get password from username in db
	$sql = 'SELECT password FROM team.user WHERE username=:username;';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':username', $user);
	$stmt->execute();
	$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
	if($rowsArray < 1){ 
		$newURL = 'signin.php?error=usernameDB';
		header("Location: $newURL");
		die();
	}
	else {
		//compare user entered pwd against hashed pwd
		$hashedPwdCheck = password_verify($pwd, $rowsArray[0]['password']);
		echo "hashed pwd check";
		// if($hashedPwdCheck == false){
		// 	$newURL = 'signin.php?error=passwordMatch';
		// 	header("Location: $newURL");
		// 		exit();
		// } elseif ($hashedPwdCheck == true) {
			//Log in the user here
			$_SESSION['userID'] = $rowsArray[0]['id'];
			$newURL = 'welcome.php';
			header("Location: $newURL");
			die();
	// }
	}
}




//if match save user to session