<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else {
	//query for envelopes and display them
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

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':userID', $_SESSION['userID']);
	$stmt->execute();
	$rowsArray = $stmt->fetchALL(PDO::FETCH_ASSOC);
 }
?>

	<title>Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<!--HEADER-->
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
	<!-- MAIN SECTION-->
	<div class="container">
  <h2>Nvelopes</h2>
  <p>Simple Budgeting Web App</p>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#view">View Envelopes</a></li>
    <li><a href="#create">Create Envelope</a></li>
    <li><a href="#transactions">Transactions</a></li>
  </ul>

  <div class="tab-content">
    <div id="view" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>View all your budget envelopes here with their totals.</p>
      <?php
      //create dynamic display of query results of envelopes
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
    </div>
    <div id="create" class="tab-pane fade">
      <h3>Create Envelope</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="transactions" class="tab-pane fade">
      <h3>Transactions</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});
</script>