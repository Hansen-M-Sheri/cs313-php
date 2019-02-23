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

	
}
?>
	
	<title>LOGIN to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav class="navBar navbar-expand-sm bg-dark navbar-dark" >
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="login.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="createEnvelope.php">Create Envelope</a></li>
				<li class="nav-item"><a class="nav-link" href="includes/logout.php.php">Logout</a></li>
				
			</ul>
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
		<?php foreach ($rowsArray as $row) {
			if($row['total'] < $row['warningamount']){
			//set color to be red! if total is below warning amount
			$row['color'] = '#FF6347';
		}?>
				
			<div class="col-md-3 ">
			    <div class="card mb-3 box-shadow" style="background: <?php echo$row['color']?>">
		    		<div class="card-edit">

		    			<a href="editEnvelope.php?envID=<?php echo $row['id']?>"><i class="far fa-edit card-edit"></i></a>
		    		</div>
		          	<h3 class="card-title"><?php echo $row['name']?></h3>
		          	<div class="card-body">
				 		<i class="far fa-envelope fa-5x icon" ></i>
				 	</div>
				 	<h3 class="card-total">$<?php echo $row['total']?></h3>
				    <form action="transactions.php" method="POST">
		            	<input type="hidden" name="envID" value="<?php echo $row['id']?>">
		            	<button type="submit" name="add"class="btn btn-primary">Add transaction</button> 
	        		</form>
		         </div><!--body-->
		       <!--  </div>card -->
		    </div><!--column-->      
		<?php }?>
		</div><!-- Cards -->


<?php include "templates/footer.php"; ?>
