<?php 
session_start();
include 'dbh_inc.php';
include "templates/header.php";
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else {
	//query for envelopes and display them
	echo "test";
	$sql = 'SELECT
			 envelopeid,
			 SUM (amount) AS total
			FROM
			 public.transaction
			 WHERE
			 userid=:userID
			GROUP BY
			 envelopeid';
	// echo $sql;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':userID', 1);
	$stmt->execute();
	$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
	echo count($rowsArray);
	foreach ($rowsArray as $row) {
		echo $row['envelopeid'];
		echo $row['total'];
		echo '<br>';
	}
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
				<li><a data-toggle="tab" href="#menu1" class="btn btn-dark btn-tab">View Envelopes</a></li>
				<li><a data-toggle="tab" href="#menu2" class="btn btn-dark btn-tab">Create Envelope</a></li>
			</ul>
			<div class="tab-content" style="">
				<div id="menu1" class="tab-pane">
					<!-- Cards -->
    <div class="row">
      <div class="col-md-3 ">
        <div class="card-container">
        	<i class="far fa-envelope fa-8x icon"></i>
          <div class="card-body">
            <h4>ENVELOPE NAME</h4>
            <h4>TOTAL</h4>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      
      
  </div><!--row-->
					
				</div>
				<div id="menu2" class="tab-pane fade">
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
			</div>

	</div>

<?php include "templates/footer.php"; ?>
