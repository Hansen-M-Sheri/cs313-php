<?php 
include 'dbh_inc.php';

//if post is NOT set with an itemID - add item
if(isset($_POST['envelopeID'])) {
	$envelopeID = $_POST['envelopeID'];
	$userID 	= $_POST['userID'];
	$date 		= htmlspecialchars($_POST['date']);
	$details 	= htmlspecialchars($_POST['details']);
	$amount 	= htmlspecialchars($_POST['amount']);
	
	if(isset($_POST['deposit'])){
		$amount = abs($amount); //take absolute value of item
	}
	else {
		$amount*= -1; //make value negative
	}

	$sql = 'INSERT INTO public.transaction (envelopeid, userid, date, details, amount) VALUES (:envelopeID, :userID, :date, :details, :amount)';
	$stmt = $db->prepare($sql);

	//pass values to statement
	$stmt->bindValue(':envelopeID', $envelopeID);
	$stmt->bindValue(':userID', $userID);
	$stmt->bindValue(':date', $date);
	$stmt->bindValue(':details', $details);
	$stmt->bindValue(':amount', $amount);
	
	
	$stmt->execute();

	// $id =  $db->lastInsertID('transaction_id_seq');
	$newPage = "../transactions.php?envID=$envelopeID";
	// echo $newPage;
	header("Location: $newPage");
	die();
}
else {
	header("Location: ../transactions.php?envID=ErrorNoID");
	die();
}
//else if itemID isset: check for type

//if update 

//if delete