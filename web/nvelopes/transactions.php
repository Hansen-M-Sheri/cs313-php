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
	echo var_dump(count($rowsArray));
?>
	
	<title>LOGIN to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	
</head>
<body>
	<header>
		<nav>
			<div class="navBar">
				<ul>
					<li><a href="login.php">Home</a></li>
					<li><a href="setup.php">Envelopes</a></li>
				</ul>
				<form action="includes/logout.php" method="post">
					<button type="submit" name="logout">Logout</button>
				</form>
			</div>
		</nav>
	</header>

	<div class="row col-md-8">
		<ul class="nav nav-tab">
			<li><a data-toggle="tab" href="#menu1" class="btn btn-dark btn-tab">Transactions</a></li>
		</ul>
		<div class="tab-content" style="">
			<div id="menu1" class="tab-pane active">
				<!-- ADD A TRANSACTION -->
				<h3>Add a Transaction</h3>
				<form class="form-inline" action="includes/insertTransaction_inc.php" method="POST">
					
						<input type="hidden" name="envelopeID" value="<?php echo $envelopeID; ?>">
						<input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
						<label for="date">Date</label>
						<input  type="date" name="date" id="date"> 
						<br>
						<label for="details">Transaction Details</label>
						<input  type="text" name="details" id="details"> 
						<br>
						<label for="amount">Amount</label>
						$<input  type="number" min="0.01" step="0.01" name="amount" id="amount"> <br>
						<input type="submit" name="submitLogin" class="btn btn-primary btn-block">
						<!-- <button type="button" name="addTransaction" class="btn btn-primary btn-block" onclick="addTransaction(<?php echo $envelopeID; ?>, <?php echo $_SESSION['userID']; ?>, $('#date').html(), $('#details').html(), $('#amount').html(),'add')"> Add Transaction </button> -->
					
				</form>
				<hr>
				<h3>Transaction List</h3>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Date</th>
							<th>Details</th>
							<th>Amount</th>
						</tr>
					</thead>
					
					
					<tbody>
						<?php foreach($rowsArray as $row): ?>
						<tr>
							<td><?php echo $row['date'] ?></td>
							<td><?php echo $row['details'] ?></td>
							<td><?php echo $row['amount'] ?></td>
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