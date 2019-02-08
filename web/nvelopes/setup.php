<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else {
	$envelopeName = " ";
	//query for envelopes and display them
	// echo "test";
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
	// echo $sql;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':userID', $_SESSION['userID']);
	$stmt->execute();
	$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
	// echo "test 2";
	// echo count($rowsArray);
	// foreach ($rowsArray as $row) {
	// 	echo $row['envelopeid'];
	// 	echo $row['total'];
	// 	echo '<br>';
	// }
}
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
				</ul>
				<form action="includes/logout.php" method="post">
					<button type="submit" name="logout">Logout</button>
				</form>
			</div>
		</nav>
	</header>

	<div class="row col-md-8">
		<ul class="nav nav-tab">
			<li><a data-toggle="tab" href="#view" class="btn btn-dark btn-tab">View Envelopes</a></li>
			<li><a data-toggle="tab" href="#create" class="btn btn-dark btn-tab">Create Envelope</a></li>
			<li><a data-toggle="tab" href="#transactions" class="btn btn-dark btn-tab">Transactions</a></li>
		</ul>
		<div class="tab-content" style="">
			<div id="view" class="tab-pane">
				<?php
					foreach ($rowsArray as $row) { ?>
						<div class="row">
					      <div class="col-md-3 ">
					        <div class="card-container">
					        	
					        	<i class="far fa-envelope fa-6x icon" style="background: <?php echo$row['color']?>"></i>
					          <div class="card-body">
					            <h4><?php echo $row['name']?></h4>
					            <h4><?php echo $row['total']?></h4>
					            <!-- <button type="button" class="btn-primary btn-xs" onclick="<?php $envelopeName = $row['name'] ?>"><a href="transactions">+/-</a></button> -->
					          </div><!--body-->
					        </div><!--card-->
				<?php	}
				?>
					<!-- Cards -->
    
      </div><!--column-->
      
      
  </div><!--row-->
					
				</div>
				<div id="create" class="tab-pane fade">
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
			
			<div id="transactions" class="tab-pane fade">
					<form id="transaction"action="includes/envelope_inc.php" method="post" class="form-group col-md-6">
						<center><h2>Transactions</h2></center><br>
						<label for="name">Name of Envelope to Add Transaction</label>
						<input type="text" placeholder="Envelope Name" name="name" class="form-control" required><br>
						
						<input type="submit" name="getTransactions" class="btn btn-primary btn-block">
					</form>	
				</div>
			</div>

	</div>

<?php include "templates/footer.php"; ?>
