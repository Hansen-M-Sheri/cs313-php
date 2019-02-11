<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";

if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else {
	if(!isset($_POST['envID'])){
		header("Location: login.php?login=noEnvelopeID");
		exit();
	}
	else {
		$envelopeID = $_POST['envID'];
		//query for envelopes and display them
		// echo "test";
		// echo var_dump($_SESSION['userID']);
		// echo var_dump($envelopeID);
		$sql = ' SELECT
					 *
					FROM
					 public.transaction
					 WHERE 
					  envelopeID=:envelopeID
					 AND
					  userid=:userid;';
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
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
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

	<div class="row col-md-8">
		<ul class="nav nav-tab">
			<li><a data-toggle="tab" href="#menu1" class="btn btn-dark btn-tab">Transactions</a></li>
		</ul>
		<div class="tab-content" style="">
			<div id="menu1" class="tab-pane active">
				<!-- ADD A TRANSACTION -->
				<h3>Add a Transaction</h3>
				<div class="form-group">
					
						<input type="hidden" name="envelopeID" value="<?php echo $envelopeID; ?>">
						<input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
						<label for="date">Date</label>
						<input  type="date" name="date" id="date"> 
						<label for="details">Transaction Details</label>
						<input  type="text" name="details" id="details"> 
						<label for="amount">Amount</label>
						$<input  type="number" min="0.01" step="0.01" name="amount" id="amount"> 
						<button type="button" name="addTransaction" class="btn btn-primary btn-block" onclick="addTransaction(<?php echo $envelopeID; ?>, <?php echo $_SESSION['userID']; ?>, $('#date').html(), $('#details').html(), $('#amount').html())"> Add Transaction </button>
					
				</div>
				<tr>
						<th>Date</th>
						<th>Details</th>
						<th>Amount</th>
					</tr>
				<?php foreach($rowsArray as $row): ?>
					
					<tr>
						<td><?php echo $row['date'] ?></td>
						<td><?php echo $row['details'] ?></td>
						<td><?php echo $row['amount'] ?></td>
					</tr>
				<?php endforeach; ?>
      		</div><!--column-->
  	</div><!--row-->
					

			

	</div>

<?php include "templates/footer.php"; ?>