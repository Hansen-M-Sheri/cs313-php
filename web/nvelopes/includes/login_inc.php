<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'dbh_inc.php';

//if user has clicked submit button run this file
if(isset($_POST['submitLogin'])){
	

	$email = htmlspecialchars($_POST['email']);
	$pwd = htmlspecialchars($_POST['pwd']);

	//Error handling
	//Check for empty fields
	if(empty($email) || empty($pwd)){
		header("Location: ../login.php?login=empty");
	}
	else{
		//check if input characters are valid
		//if(!preg_match("/^[a-zA-Z]*$", $firstName))
		//check if email is valid
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: ../login.php?login=email");
			exit();
		}
		else{
			//verify email exists in db
			$stmt = $db->prepare('SELECT id, fName, lName, email, password FROM public.user WHERE email=:email');
			$stmt->bindValue(':email', $email);
			$stmt->execute();
			$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC); //this returns array
			echo print_r($rowsArray);
			if(count($rowsArray)  < 1){ //not found
				header("Location: ../login.php?login=signup");
				exit();
			}
			else {
				//compare password
				//dehash password
				$hashedPwdCheck = password_verify($pwd, $rowsArray[0]['password']);
				// if($hashedPwdCheck == false){
				// 	header("Location: ../login.php?login=error");
				// 		exit();
				// } elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['userID'] = $rowsArray[0]['id'];
					$_SESSION['fName'] = $rowsArray[0]['fname'];
					$_SESSION['lName'] = $rowsArray[0]['lname'];
					$_SESSION['email'] = $rowsArray[0]['email'];
					//send to setup page
					header("Location: ../setup.php");
				// }
				

			}
		}
	}

}
elseif (isset($_POST['submitSignup'])){

	$fName = htmlspecialchars($_POST['fName']);
	$lName = htmlspecialchars($_POST['lName']);
	$email = htmlspecialchars($_POST['email']);
	$pwd   = htmlspecialchars($_POST['pwd']);
	// $secret1 = htmlspecialchars($_POST['pwd']);
	// $secret2 = htmlspecialchars($_POST['pwd']);
	$secret1 = "secret 1";
	$secret2 = "secret 2";

	//Error handling
	//Check for empty fields
	if(empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($secret1) || empty($secret2)){
		header("Location: ../login.php?login=empty");
		exit();
	}
	else{
		//check if input characters are valid
		if(preg_match("/^[a-zA-Z]+$/", $fName) === 0 || preg_match("/^[a-zA-Z]+$/", $lName) === 0){
			header("Location: ../login.php?login=invalidName");
			exit();
		}
		else{
			//check if email is valid 
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../login.php?login=email");
				exit();
			}
			else {
				
				//verify email exists in db
				$stmt = $db->prepare('SELECT email FROM public.user WHERE email=:email');
				$stmt->bindValue(':email', $email);
				$stmt->execute();
				$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
				if (count($rowsArray) > 0 ){
					header("Location: ../login.php?signup=userTaken");
					exit();
				} 
				else {
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//insert user into database
					$sql = 'INSERT INTO public.user (fName, lName, email, password, secretquestion1answer, secretquestion2answer) VALUES (:fName, :lName, :email, :hashedPwd, :secret1, :secret2)';
					$stmt = $db->prepare($sql);

					//pass values to statement
					$stmt->bindValue(':fName', $fName);
					$stmt->bindValue(':lName', $lName);
					$stmt->bindValue(':email', $email);
					$stmt->bindValue(':hashedPwd', $hashedPwd);
					$stmt->bindValue(':secret1', $secret1);
					$stmt->bindValue(':secret2', $secret2);
					
					$stmt->execute();

					$id =  $db->lastInsertID('user_id_seq');
					//store id in sessions 
					$_SESSION['userID'] = $id;
					header("Location: ../setup.php");
					exit();

				}
				// foreach ($rows as $key => $value) {
				// 	# code...
				// }
				// echo var_dump($rows);

			}
		}
	}
}
		
else{
	header("Location: ../login.php");
}