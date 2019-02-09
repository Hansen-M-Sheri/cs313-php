<?php 
session_start();
include 'includes/dbh_inc.php';
// include "templates/header.php";
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 
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
	  <ul class="nav nav-pills nav-justified">
	    <li class="active"><a href="#view" data-toggle="tab">View Envelopes</a></li>
	    <li><a href="#create" data-toggle="tab">Create Envelope</a></li>
	    <li><a href="#transactions" data-toggle="tab">Transactions</a></li>
	  </ul>

  <div class="tab-content">
				<div class="tab-pane fade in active"  id="view">
					<p>First para Hi there 
				</div>
				<div class="tab-pane fade"  id="create">
					<p>Second para Hi there 
				</div>
				<div class="tab-pane fade"  id="transactions">
					<p>Third para Hi there 
				</div>
			</div>
</div>

<!-- <script>
$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});
</script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>

</body>
</html>