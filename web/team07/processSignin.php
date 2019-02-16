<?php
session_start();
include 'dbh.php';
//get the POST from signin
if(isset($_POST['username'])){
	$user = htmlspecialchars($_POST['username']);
	$pwd  = htmlspecialchars($_POST['password']);

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
		echo var_dump($rowsArray);
		$pwd = $rowsArray[0];
		echo $pwd;
	}
}




//if match save user to session