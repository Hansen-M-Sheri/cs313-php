<!-- SIGN UP page - Home page is here -->
<?php include "templates/header.php";?>
<!-- Login form - process with login_inc.php-->
	
	<title>Sign up for Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav class="navBar navbar-expand-sm bg-dark navbar-dark" >
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>				
			</ul>
		</nav>
	</header>
<!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Sign up</h1>
      <h3>Sign up and start saving money now!</h3>
  	</div>
  	<div class="container">
		<form class="form-group col-md-6" action="includes/login_inc.php" method="POST">
			<center><h2>Signup</h2></center><br>
			<input type="text" placeholder="First Name" name="fName" class="form-control" required><br>
			<input type="text" placeholder="Last Name" name="lName" class="form-control" required> <br>
			<input type="email" placeholder="Email" name="email" class="form-control" required><br>
			<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
			<input type="submit" name="submitSignup" class="btn btn-success btn-block">
		</form>
	</div>
<?php include "templates/footer.php"; ?>

