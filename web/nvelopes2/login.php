<?php include "templates/header.php";?>
<!-- Login form - process with login_inc.php-->
	
	<title>LOGIN to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<header>
		<nav class="navBar navbar-expand-sm bg-dark navbar-dark" >
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
				
			</ul>
		</nav>
	</header>
	 <!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Nvelopes Budgeting App</h1>
      
      
  	</div>
  	<div class="container">
		<form class="form-group col-md-4 col-md-offset-4"action="includes/login_inc.php" method="POST" >
			<center><h2>Login</h2></center><br>
			<input type="text" placeholder="Email" name="email" class="form-control" required><br>
			<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
			<input type="submit" name="submitLogin" class="btn btn-primary btn-block">
		</form>	
	</div>
<?php include "templates/footer.php"; ?>
