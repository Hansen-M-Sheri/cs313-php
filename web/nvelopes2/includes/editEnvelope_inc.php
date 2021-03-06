<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'dbh_inc.php';

//if user has clicked submit button run this file
if(isset($_POST['editEnvelope'])){
	$id = $_POST['envID'];
	$description = htmlspecialchars($_POST['desc']);
	$warningAmt = htmlspecialchars($_POST['warningAmount']);
	$color		= htmlspecialchars($_POST['color']);

	if(empty($id) || empty($description) || empty($warningAmt) || empty($color)){
		header("Location: ../editEnvelope.php?envelope=empty");
		exit();
	}
	else {
		$sql = 'UPDATE public.envelope SET description=:description, warningamount=:warningAmt, color=:color WHERE id=:id;';
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':description', $description);
		$stmt->bindValue(':warningAmt', $warningAmt);
		$stmt->bindValue(':color', $color);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		//redirect to envelope page
		header("Location: ../setup.php?update=success");

	}			
}
else {
	header("Location: ../setup.php?update=accidental");
	die();
}



