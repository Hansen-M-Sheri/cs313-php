<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'dbh_inc.php';

//if user has clicked submit button run this file
if(isset($_POST['createEnvelope'])){
	$envelopeName = htmlspecialchars($_POST['name']);
	$description = htmlspecialchars($_POST['desc']);
	$warningAmt = htmlspecialchars($_POST['warningAmount']);
	$color		= htmlspecialchars($_POST['color']);
	$balance	= htmlspecialchars($_POST['balance']);
	if(empty($balance)){
		$balance = '0.00';
	}

	if(empty($envelopeName) || empty($description) || empty($warningAmt) || empty($color)){
		header("Location: ../setup.php?envelope=empty");
		exit();
	}
	else {
		//check if name characters are valid
		if(preg_match("/^[a-zA-Z]+$/", $envelopeName) === 0 ){
			header("Location: ../setup.php?envelope=invalidName");
			exit();
		}
		else{
			$sql = 'INSERT INTO public.envelope (name, description,  color, warningamount) VALUES (:name, :description, :color, :warningAmt)';
			$stmt = $db->prepare($sql);

			$stmt->bindValue(':name', $envelopeName);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':warningAmt', $warningAmt);
			$stmt->bindValue(':color', $color);
			$stmt->execute();
			$newItemID =  $db->lastInsertID('envelope_id_seq');
			if($newItemID < 1){
				header("Location: ../setup.php?create=error");
			} else {
				
				//initial insert to make values = 0
				$sql = 'INSERT INTO public.transaction (envelopeid, userid, date, details, amount) VALUES (:envelopeID, :userID, :date, :details, :amount)';
				$stmt = $db->prepare($sql);

				//pass values to statement
				$stmt->bindValue(':envelopeID', $newItemID);
				$stmt->bindValue(':userID', $_SESSION['userID']);
				$stmt->bindValue(':date', date("Y/m/d"));
				$stmt->bindValue(':details', "initialize envelope");
				$stmt->bindValue(':amount', $balance);
				$stmt->execute();
				header("Location: ../setup.php?create=success");
			}
		}
	}
			
}



