<?php include "templates/header.php";?>
<!-- Login form - process with login_inc.php-->
	
	<title>LOGIN to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav>
			<div class="navBar">
				<ul>
					<li><a href="signup.php">Home</a></li>
					<li><a href="signup.php">Signup</a></li>
					
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
  	<div class="container">
		<form class="form-group col-md-6"action="includes/login_inc.php" method="POST" >
			<center><h2>Login</h2></center><br>
			<input type="text" placeholder="Email" name="email" class="form-control" required><br>
			<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
			<input type="submit" name="submitLogin" class="btn btn-primary btn-block">
		</form>	
	</div>
<?php include "templates/footer.php"; ?>
