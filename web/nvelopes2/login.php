<?php 
include "templates/header.php";
// Handle any errors
if(isset($_GET['login'])){
	$error = $_GET['login'];
	$errMsg = "";
	if($error == 'email'){
		$errMsg = "Please enter a valid email";
	}
	else if ($error == 'signup'){
		$errMsg = "That email isn't in our system, please signup";
	}
	else if($error == 'error'){
		$errMsg = "Login email or password does not match what we have in our system, please try again";
	}
	else if($error == 'invalidName'){
		$errMsg = "Login email or password does not match what we have in our system, please try again";
	}
}

?>

	
	<title>LOGIN to Nvelopes</title>
	
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
  	<?php
  		if(!empty($error)){
  			echo "<div class='error'>".$errMsg."</div>";
  		}?>
  	
  	<div class="container">
		<form class="form-group col-md-4 col-md-offset-4"action="includes/login_inc.php" method="POST" >
			<center><h2>Login</h2></center><br>
			<input type="text" placeholder="Email" name="email" class="form-control" required><br>
			<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
			<input type="submit" name="submitLogin" class="btn btn-primary btn-block">
		</form>	
	</div>
<?php include "templates/footer.php"; ?>
