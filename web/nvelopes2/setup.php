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

	<div class="row col-md-8">
		<ul class="nav nav-tab">
			<li><a data-toggle="tab" href="#view" class="btn btn-dark btn-tab">View Envelopes</a></li>		
		</ul>
		<div class="tab-content" style="">
			<div id="view" class="tab-pane active">
				<?php
					foreach ($rowsArray as $row) : ?>
						<div class="row">
					      <div class="col-md-3 ">
					        <div class="card-container">
					        	
					        	<i class="far fa-envelope fa-6x icon" style="background: <?php echo$row['color']?>"></i>
					          <div class="card-body">
					            <h4><?php echo $row['name']?></h4>
					            <h4><?php echo $row['total']?></h4>
					            <form action="transactions.php" method="POST">
						            <input type="hidden" name="envID" value="<?php echo $row['id']?>">
						            <button type="submit" name="add"class="btn btn-primary">Add transaction</button> 
						        </form>
					          </div><!--body-->
					        </div><!--card-->
				<?php endforeach;
				?>
					</div><!-- Cards -->
    
      </div><!--column-->
      
      
  </div><!--row-->
</div>
</div>

<?php include "templates/footer.php"; ?>
