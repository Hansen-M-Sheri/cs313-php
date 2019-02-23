<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";

//*********CHECK PERMISSIONS*****************
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else if (isset($_GET['error'])){
	$error = $_GET['error'];
	$errMsg = "";
	if($error == 'ErrorNoID'){
		$errMsg = "Error retrieving envelope id to make transactions, try again later";
	}
}
else { // ****** GET ALL TRANSACTIONS IF ENVELOPEID ISSET**
	if(!isset($_POST['envID']) && !isset($_GET['envID'])){
		header("Location: login.php?login=noEnvelopeID");
		exit();
	}
	else {
		$envelopeID = "";
		
		if(isset($_POST['envID'])){
			$envelopeID = $_POST['envID'];
		}
		else{
			$envelopeID = $_GET['envID'];
		}
		
		$sql = ' SELECT
					 *
					FROM
					 public.transaction
					 WHERE 
					  envelopeID=:envelopeID
					 AND
					  userid=:userid
					 ORDER BY date DESC;';
		 // echo $sql;
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':envelopeID', $envelopeID);
		$stmt->bindValue(':userid', $_SESSION['userID']);
		$stmt->execute();
		$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
		}
	}
	//get envelope name to display
	$sql = 'SELECT name FROM envelope WHERE id=:id';
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':id', $envelopeID);
	$stmt->execute();
	$result = $stmt->fetch();
	$envelopeName = $result[0];

	//get total of envelope
	$sql = ' SELECT
				 SUM (amount) AS total
				FROM
				 public.transaction
				 INNER JOIN public.envelope
				 ON transaction.envelopeid = envelope.id
				 WHERE
				 envelopeid = :envelopeID
				GROUP BY
				 name, envelope.id;';
	// echo $sql;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':envelopeID', $envelopeID);
	$stmt->execute();
	$result = $stmt->fetchALL(PDO::FETCH_ASSOC);
	$total = $result[0]['total'];
?>
<!-- Login form - process with login_inc.php-->
	
	<title>Transactions to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav class="navBar navbar-expand-sm bg-dark navbar-dark" >
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="login.php" >Home</a></li>
				<li class="nav-item"><a class="nav-link" href="setup.php">Envelopes</a></li>
				<li class="nav-item"><a class="nav-link" href="createEnvelope.php">Create Envelopes</a></li>
				<li class="nav-item"><a class="nav-link" href="includes/logout.php">Logout</a></li>
				
			</ul>
		</nav>
	</header>
	 <!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1><?php echo $envelopeName ?> Transactions</h1>
      <h3>View all deposits and withdrawls from one envelope</h3>
  	</div>
  	<?php
  		if(!empty($error)){
  			echo "<div class='error'>".$errMsg."</div>";
  		}?>
  	<div class="container">
			<form class="form-inline" action="includes/insertTransaction_inc.php" method="POST">
				
					<input type="hidden" name="envelopeID" value="<?php echo $envelopeID; ?>">
					<input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
					<label for="date" class="mr-sm-2">Date:</label>
					<input  type="date" name="date" id="date" class="form-control mb-2 mr-sm-2"> 
					<!-- <br> -->
					<label for="details" class="mr-sm-2">Transaction Details:</label>
					<input  type="text" name="details" id="details" placeholder="Transaction details" class="form-control mb-2 mr-sm-2"> 
					<!-- <br> -->
					<label for="amount" class="mr-sm-2">Amount:</label>
					$<input  type="number" min="0.01" step="0.01" name="amount" id="amount" class="form-control mb-2 mr-sm-2" placeholder="0.00"> <!-- <br> -->
					<div class="buttons">
						<input type="submit" name="deposit" value="Deposit"class="btn btn-success mb-2">
						<input type="submit" name="withdrawl" value="Withdrawal"class="btn btn-danger mb-2">
					</div>				
			</form>
			<hr>
			<!-- Print total for envelope -->
			<table class="table table-striped table-bordered">
				<tr>
					<th>Envelope Total</th>
					<th>$<?php echo $total ?></th>
				</tr>
			</table>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Details</th>
						<th>Deposits</th>
						<th>Withdrawals</th>
						<th></th><!-- PUT EDIT/REMOVE OPTION IN THIS COLUMN-->
					</tr>
				</thead>
				
				
				<tbody>
					<?php foreach($rowsArray as $row): ?>
					<tr>
						<td><?php echo $row['date'] ?></td>
						<td><?php echo $row['details'] ?></td>
						<?php if($row['amount'] < 0){ ?>
							<td></td> <!-- Leave blank, no deposit amount-->
							<td><?php echo $row['amount'] ?></td>
							<td>
								<a href="includes/adjustTransaction_inc.php?transactionID=.".<?php echo $row['id']?>><i class="far fa-trash-alt trash"></i></a>
							</td>
						<?php } else { ?>
							<td><?php echo $row['amount'] ?></td>
							<td></td> <!-- Leave blank, no withdrawal amount-->
							<td>
								<?php $href= "includes/adjustTransaction_inc.php?transactionID=$row['id']&envelopeID=$envelopeID";?>
							<a href=<?php echo $href ?><i class="far fa-trash-alt trash"></i></a>
						</td>
						<?php } ?>
					</tr>
					<?php endforeach; ?>
					
				<tbody>
			</table>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Envelope Total</th>
					<th>$<?php echo $total ?></th>
				</tr>
			</table>
			
  		</div><!--column-->
	</div><!--row-->
</div>

<?php include "templates/footer.php"; ?>