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
}
?>
	
	<title>Create Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav class="navBar navbar-expand-sm bg-dark navbar-dark" >
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="login.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="setup.php">Envelopes</a></li>
				<li class="nav-item"><a class="nav-link" href="includes/logout.php.php">Logout</a></li>
				
			</ul>
		</nav>
	</header>
	<!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Create </h1>
      <h3>Create a new envelope and start choosing where your money will go</h3>
  	</div>
  	<div class="container">
		<form id="createEnvelope"action="includes/envelope_inc.php" method="post" class="form-group col-md-6 col-md-offset-3">
			<center><h2>Create Envelope</h2></center><br>
			<input type="text" placeholder="Envelope Name" name="name" class="form-control" required><br>
			<input type="text" placeholder="Description" name="desc" class="form-control" required><br>
				
			<input type="number" placeholder="Warning amount ie: 5.00" name="warningAmount" class="form-control" required>
			<p>If envelope total drops below warning value, envelope will turn red</p><br>
			<input type="color" placeholder="" name="color" class="form-control" required>
			<p>Select color for envelope. **If red is selected, warning will not be visible</p><br>
			<input type="submit" name="createEnvelope" class="btn btn-primary btn-block" value="Create Envelope">
		</form>	
			
  </div>
					

<?php include "templates/footer.php"; ?>
