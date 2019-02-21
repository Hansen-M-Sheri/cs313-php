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
	// echo "GET: ";
// 	echo $_GET;
	//query for envelopes and display them
	// echo "test";
	$sql = ' SELECT
				 envelope.id,
				 color,
				 name,
				 warningamount,
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
	
	foreach ($rowsArray as $row) {
		if($row['total'] < $row['warningamount']){
		//set color to be red!
		$row['color'] = '#FF6347';
		}
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
					<li><a href="signup.php">Home</a></li>
					<li><a href="createEnvelope.php">Create Envelopes</a></li>
					<li><a href="includes/logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
	</header>

	 <!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Envelopes</h1>
      <h3>View envelopes and current totals</h3>
      <h5>Any envelopes with total below warning amount will be red</h5>
  </div>
    </div>
		<div class="row">
		<?php foreach ($rowsArray as $row) : ?>
				
			<div class="col-md-4 ">
			    <div class="card mb-4 box-shadow" style="background: <?php echo$row['color']?>">
		          	<h3 class="card-title"><?php echo $row['name']?></h3>
		          	<div class="card-body">
				 		<i class="far fa-envelope fa-5x icon" ></i>
				 	</div>
				    <form action="transactions.php" method="POST">
		            	<input type="hidden" name="envID" value="<?php echo $row['id']?>">
		            	<button type="submit" name="add"class="btn btn-primary">Add transaction</button> 
	        		</form>
		         </div><!--body-->
		       <!--  </div>card -->
		    </div><!--column-->      
		<?php endforeach;?>
		</div><!-- Cards -->


<?php include "templates/footer.php"; ?>
