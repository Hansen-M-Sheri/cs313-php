<?php
if(!isset($_GET['transactionID'])){
	header("Location: ../transactions.php");
	die();
}
else {
	//remove item from db
	$sql = "DELETE FROM public.transaction WHERE id=:id";
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':id', $_GET['transactionID']);
}