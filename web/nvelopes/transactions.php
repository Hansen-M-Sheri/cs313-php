<?php 
session_start();
include 'includes/dbh_inc.php';
include "templates/header.php";
if(!isset($_SESSION['userID'])){
	header("Location: login.php?login=noAuth");
	exit();
}
else {
	if(!isset$_POST['envID']){
		header("Location: login.php?login=noEnvelopeID");
		exit();
	}
	else {
		$envelopeID = $_POST['envID'];
		//query for envelopes and display them
		// echo "test";
		$sql = ' SELECT
					 *
					FROM
					 public.transaction
					 WHERE 
					  envelopeID = :envelopeID
					 AND
					  userid = :userID';
		// echo $sql;
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':envelopeID', $envelopeID);
		$stmt->bindValue(':userid', $_SESSION['userID']);
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
			<li><a data-toggle="tab" href="#menu1" class="btn btn-dark btn-tab">Transactions</a></li>
		</ul>
		<div class="tab-content" style="">
			<div id="menu1" class="tab-pane active">
				<?php foreach($rowsArray as $row): ?>
					<th>
						<td>Date</td>
						<td>Details</td>
						<td>Amount</td>
					</th>
					<tr>
						<td><?php $row['date'] ?></td>
						<td><?php $row['details'] ?></td>
						<td><?php $row['amount'] ?></td>
					</tr>
				<?php endforeach; ?>
      		</div><!--column-->
  	</div><!--row-->
					

			

	</div>

<?php include "templates/footer.php"; ?>