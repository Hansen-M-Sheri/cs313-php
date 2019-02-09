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
    <div id="view" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>View all your budget envelopes here with their totals.</p>
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

<!-- <script>
$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});
</script> -->