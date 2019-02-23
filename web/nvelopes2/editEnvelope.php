<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else if(!isset($_GET['envID'])){
	echo var_dump($_GET);
		// header("Location: setup.php?error=envID");
		// die();
	}
else {
	
	//get current data from field, to pre-populate info to allow user to edit it
	$envelopeName = " ";
	//query for envelopes and display them
	// echo "test";
	$sql = 'SELECT
				 name,
				 description,
				 color,
				 warningamount
				FROM
				 public.envelope
				 WHERE
				 id=:envelopeID';
	// echo $sql;
	$stmt = $db->prepare($sql);
	$stmt->bindValue(':envelopeID', $_GET['envID']);
	$stmt->execute();
	$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
	echo var_dump($rowsArray);
	$envelopName = $rowsArray[0]['name'];
	$description = $rowsArray[0]['description'];
	$color = $rowsArray[0]['color'];
	$warningamount = $rowsArray[0]['warningamount'];
}
?>
	
	<title>Edit Nvelopes</title>
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
      <h1>Edit <?php echo $envelopeName ?> Envelope </h1>
      <h3>Edit the settings for your envelope</h3>
  	</div>
  	<div class="container">
		<form id="createEnvelope"action="includes/editEnvelope_inc.php" method="post" class="form-group col-md-6 col-md-offset-3">
			<input type="hidden" name="envID" value="<?php echo $row['id']?>">
			<label for="desc" value="Envelope Description:">
			<input type="text" value="<?php echo $description ?>" name="desc" class="form-control" required><br>
			<label for="warningamount" value="Warning Amount:">
			<input type="number" value="<?php echo $warningamount ?>" name="warningAmount" class="form-control" required>
			<p>If envelope total drops below warning value, envelope will turn red</p><br>
			<label for="color" value="Envelope Color:">
			<input type="color" value="<?php echo $color ?>" name="color" class="form-control" required>
			<p>Select color for envelope. **If red is selected, warning will not be visible</p><br>
			<input type="submit" name="editEnvelope" class="btn btn-primary btn-block" value="Save Envelope Settings">
		</form>	
			
  </div>
					

<?php include "templates/footer.php"; ?>
