<?php
include "dbh_inc.php";
//if post is NOT set with an itemID - add item
if(!isset($_POST['itemID'])) {
	$envelopeID = $_POST['envelopeID'];
	$userID 	= $_POST['userID'];
	$date 		= htmlspecialchars(string)$_POST['date'];
	$details 	= htmlspecialchars(string)$_POST['details'];
	$amount 	= htmlspecialchars(string)$_POST['amount'];
	
	//validate items - convert date to store epoch in db

	$sql = 'INSERT INTO public.transaction (envelopeid, userid, date, details, amount) VALUES (:envelopeID, :userID, :date, :details, :amount)';
	$stmt = $db->prepare($sql);

	//pass values to statement
	$stmt->bindValue(':fName', $envelopeID);
	$stmt->bindValue(':userID', $userID);
	$stmt->bindValue(':date', $date);
	$stmt->bindValue(':details', $details);
	$stmt->bindValue(':amount', $amount);
	
	
	$stmt->execute();

	$id =  $db->lastInsertID('transaction_id_seq');
}
//else if itemID isset: check for type

//if update 

//if delete

