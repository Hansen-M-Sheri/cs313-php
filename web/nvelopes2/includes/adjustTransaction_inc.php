<?php
include 'dbh_inc.php';
if(!isset($_GET['transactionID'])){
	echo var_dump($_GET);
	// header("Location: ../transactions.php");
	// die();
}
else {
	// echo var_dump($_GET);
	//remove item from db
	$sql = "DELETE FROM public.transaction WHERE id=:id";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':id', $_GET['transactionID']);
	$stmt->execute();
	//refresh transactions.php
	$envID = $_GET['envelopeID'];
	header("Location: ../transactions.php?envID=$envID");
}