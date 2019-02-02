<?php include "templates/header.php";?>
	
	<title>LOGIN to Nvelopes</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="row col-md-8">
			<ul class="nav nav-tab">
				<li><a data-toggle="tab" href="#menu1" class="btn btn-dark btn-tab">Login</a></li>
				<li><a data-toggle="tab" href="#menu2" class="btn btn-dark btn-tab">Signup</a></li>
			</ul>
			<div class="tab-content" style="">
				<div id="menu1" class="tab-pane fade">
					<form class="form-group col-md-6"action="includes/login_inc.php" method="POST" >
						<center><h2>Login</h2></center><br>
						<input type="text" placeholder="Email" name="email" class="form-control" required><br>
						<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
						<input type="submit" name="submitLogin" class="btn btn-primary btn-block">
					</form>	
					<center><a href="#">Forgot Password</a></center>
				</div>
				<div id="menu2" class="tab-pane fade">
					<form class="form-group col-md-6" action="includes/signup_inc.php" method="POST">
						<center><h2>Signup</h2></center><br>
						<input type="text" placeholder="First Name" name="fName" class="form-control" required><br>
						<input type="text" placeholder="Last Name" name="lName" class="form-control" required> <br>
						<input type="email" placeholder="Email" name="email" class="form-control" required><br>
						<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
						<input type="submit" name="submitSignup" class="btn btn-success btn-block">
					</form>
				</div>
			</div>

	</div>

<?php include "templates/footer.php"; ?>
