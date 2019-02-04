<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'dbh_inc.php';

//if user has clicked submit button run this file
if(isset($_POST['createEnvelope'])){
	$envelopeName = htmlspecialchars($_POST['name']);
	$description = htmlspecialchars($_POST['description']);
	$warningAmt = htmlspecialchars($_POST['warningamount']);
	$color		= htmlspecialchars($_POST['color']);

	if(empty($envelopeName) || empty($description) || empty($warningAmt) || empty($color)){
		header("Location: ../login.php?envelope=empty");
		exit();
	}
	else {
		//check if name characters are valid
		if(preg_match("/^[a-zA-Z]+$/", $envelopeName) === 0 ){
			header("Location: ../login.php?envelope=invalidName");
			exit();
		}
		else{
			$sql = 'INSERT INTO public.envelope (name, description, warningamount, color) VALUES (:name, :description, :warningAmt, :color)';
			$stmt = $db->prepare($sql);

			$stmt->bindValue(':name', $envelopeName);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':warningamount', $warningAmt);
			$stmt->bindValue(':color', $color);
			$stmt->execute();
			echo $db->lastInsertID('envelope_id_seq');
}



