<!-- SIGN UP page - Home page is here -->
<?php 
include "templates/header.php";
// Handle any errors
if(isset($_GET['signup'])){
	$error = $_GET['signup'];
	$errMsg = "";
	if($error == 'empty'){
		$errMsg = "All fields must be entered to signup";
	}
	else if ($error == 'invalidName'){
		$errMsg = "Please enter a valid name using letters a - z";
	}
	else if ($error == 'email'){
		$errMsg = "Please enter a valid email";
	}
	else if ($error == 'userTaken'){
		$errMsg = "That email already exists, please login";
	}
}
?>
	
	<title>Sign up for Nvelopes</title>
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
  	<?php
  		if(!empty($error)){
  			echo "<div class='error'>".$errMsg."</div>";
  		}?>
  	<div class="container">
		<form class="form-group col-md-6 col-md-offset-3" action="includes/signup_inc.php" method="POST">
			<center><h2>Signup</h2></center><br>
			<input type="text" placeholder="First Name" name="fName" class="form-control" required><br>
			<input type="text" placeholder="Last Name" name="lName" class="form-control" required> <br>
			<input type="email" placeholder="Email" name="email" class="form-control" required><br>
			<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
			<input type="submit" name="submitSignup" class="btn btn-success btn-block">
		</form>
	</div>
<?php include "templates/footer.php"; ?>

