<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";

//*********CHECK PERMISSIONS*****************
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
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
	// echo var_dump(count($rowsArray));
?>
<!-- Login form - process with login_inc.php-->
	
	<title>Transactions to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav class="navBar navbar-expand-sm bg-dark navbar-dark" >
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="login.php active">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="setup.php">Envelopes</a></li>
				<li class="nav-item"><a class="nav-link" href="createEnvelope.php">Create Envelopes</a></li>
				<li class="nav-item"><a class="nav-link" href="includes/logout.php">Logout</a></li>
				
			</ul>
		</nav>
	</header>
	 <!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Transactions</h1>
      <h3>View all deposits and withdrawls from one envelope</h3>
  	</div>
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
					$<input  type="number" min="0.01" step="0.01" name="amount" id="amount" class="form-control mb-2 mr-sm-2"> <!-- <br> -->
					<div class="buttons">
						<input type="submit" name="Deposit" value="Deposit"class="btn btn-success mb-2">
						<input type="submit" name="Withdrawl" value="Withdrawl"class="btn btn-danger mb-2">
					</div>
					<!-- <button type="button" name="addTransaction" class="btn btn-primary btn-block" onclick="addTransaction(<?php echo $envelopeID; ?>, <?php echo $_SESSION['userID']; ?>, $('#date').html(), $('#details').html(), $('#amount').html(),'add')"> Add Transaction </button> -->
				
			</form>
			<hr>
			<h3>Transaction List</h3>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Details</th>
						<th>Deposits</th>
						<th>Withdrawls</th>
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
						<?php } else { ?>
							<td><?php echo $row['amount'] ?></td>
							<td></td> <!-- Leave blank, no withdrawl amount-->
							<td>
							<!-- <a href="adjustTransaction_inc.php?type=edit"><i class="far fa-edit"></i></a> -->
							<a href="adjustTransaction_inc.php?type=remove.".<?php echo $row['id']?>><i class="far fa-trash-alt"></i></a>
						</td>
						<?php } ?>
						<!-- ADD ICONS TO ALLOW FOR EDITS/REMOVING TRANSACTIONS-->
						
					</tr>
					<?php endforeach; ?>
				<tbody>
			</table>
			
  		</div><!--column-->
	</div><!--row-->
				

		

</div>

	<script>
		function addTransaction(envelopeID, userID, date, details, amount, type) {
	$.post('includes/ajax_inc.php',
		{"envelopeID": envelopeID, "userID": userID, "date": date, "details":details, "amount": amount, "type": type},
			function (returnedData) {
				console.log(returnedData);

		}, 'json');
	}
	</script>

<?php include "templates/footer.php"; ?>