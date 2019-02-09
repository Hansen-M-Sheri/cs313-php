<?php 
session_start();
include 'includes/dbh_inc.php';
// include "templates/header.php";
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else {
	//query for envelopes and display them
	$sql = ' SELECT
	envelope.id,
	color,
	name,
	SUM (amount) AS total
	FROM
	public.transaction
	INNER JOIN public.envelope
	ON transaction.envelopeid = envelope.id
	WHERE
	userid = :userID
	GROUP BY
	name, envelope.id;';

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':userID', $_SESSION['userID']);
	$stmt->execute();
	$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<title>Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<!--HEADER-->
	<header>
		<nav>
			<div class="navBar">
				<ul>
					<li><a href="login.php">Home</a></li>
				</ul>
				<form action="includes/logout.php" method="post">
					<button type="submit" name="logout">Logout</button>
				</form>
			</div>
		</nav>
	</header>
	<!-- MAIN SECTION-->
	<div class="container">
		<h2>Nvelopes</h2>
		<p>Simple Budgeting Web App</p>
		<ul class="nav nav-pills nav-justified">
			<li class="active"><a href="#view" data-toggle="tab">View Envelopes</a></li>
			<li><a href="#create" data-toggle="tab">Create Envelope</a></li>
			<li><a href="#transactions" data-toggle="tab">Transactions</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade in active"  id="view">
				<div 
				<?php foreach ($rowsArray as $row): ?>>
					<div class="card">
					          <div class="card-body">
					            <h4><?php echo $row['name']?></h4>
					            <h4><?php echo $row['total']?></h4>
					          
					          </div><!--body-->
					 </div>     
					        
				<?php endforeach; ?>
				</div>
				<div class="tab-pane fade"  id="create">
					<form id="createEnvelope"action="includes/envelope_inc.php" method="post" class="form-group col-md-6">
						<center><h2>Create Envelope</h2></center><br>
						<input type="text" placeholder="Envelope Name" name="name" class="form-control" required><br>
						<input type="text" placeholder="Description" name="desc" class="form-control" required><br>
						
						<input type="number" placeholder="Warning amount ie: 5.00" name="warningAmount" class="form-control" required>
						<p>If envelope total drops below warning value, envelope will turn red</p><br>
						<input type="color" placeholder="" name="color" class="form-control" required>
						<p>Select color for envelope. **</p><br>
						<input type="submit" name="createEnvelope" class="btn btn-primary btn-block">
					</form> 
					</div>
					<div class="tab-pane fade"  id="transactions">
						<form id="transaction"action="includes/envelope_inc.php" method="post" class="form-group col-md-6">
						<center><h2>Transactions</h2></center><br>
						<label for="name">Name of Envelope to Add Transaction</label>
						<input type="text" placeholder="Envelope Name" name="name" class="form-control" required><br>
						
						<input type="submit" name="getTransactions" class="btn btn-primary btn-block">
					</form>	
						</div>
					</div>
				</div>

				<?php include "templates/footer.php"?>