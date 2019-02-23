<?php
include 'dbh_inc.php';
if (isset($_POST['submitSignup'])){

	$fName = htmlspecialchars($_POST['fName']);
	$lName = htmlspecialchars($_POST['lName']);
	$email = htmlspecialchars($_POST['email']);
	$pwd   = $_POST['pwd'];
	// $secret1 = htmlspecialchars($_POST['pwd']);
	// $secret2 = htmlspecialchars($_POST['pwd']);
	$secret1 = "secret 1";
	$secret2 = "secret 2";

	//Error handling
	//Check for empty fields
	if(empty($fName) || empty($lName) || empty($email) || empty($pwd) || empty($secret1) || empty($secret2)){
		header("Location: ../signup.php?signup=empty");
		exit();
	}
	else{
		//check if input characters are valid
		if(preg_match("/^[a-zA-Z]+$/", $fName) === 0 || preg_match("/^[a-zA-Z]+$/", $lName) === 0){
			header("Location: ../signup.php?signup=invalidName");
			exit();
		}
		else{
			//check if email is valid 
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../signup.php?signup=email");
				exit();
			}
			else {
				
				//verify email exists in db
				$stmt = $db->prepare('SELECT email FROM public.user WHERE email=:email');
				$stmt->bindValue(':email', $email);
				$stmt->execute();
				$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
				if (count($rowsArray) > 0 ){
					header("Location: ../signup.php?signup=userTaken");
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