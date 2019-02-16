<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'dbh_inc.php';

//if user has clicked submit button run this file
if(isset($_POST['submitLogin'])){
	

	$email = htmlspecialchars($_POST['email']);
	$pwd = $_POST['pwd'];

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
				if($hashedPwdCheck == false){
					header("Location: ../login.php?login=error");
						exit();
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['userID'] = $rowsArray[0]['id'];
					$_SESSION['fName'] = $rowsArray[0]['fname'];
					$_SESSION['lName'] = $rowsArray[0]['lname'];
					$_SESSION['email'] = $rowsArray[0]['email'];
					//send to setup page
					header("Location: ../setup.php");
				}
				

			}
		}
	}

}	
else{
	header("Location: ../login.php");
}