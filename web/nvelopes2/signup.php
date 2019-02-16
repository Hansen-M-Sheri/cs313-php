<?php 

?>
<!-- SIGN UP page - Home page is here -->

<!-- Nav bar to HOME = signup, Login button-->
<form class="form-group col-md-6" action="includes/login_inc.php" method="POST">
	<center><h2>Signup</h2></center><br>
	<input type="text" placeholder="First Name" name="fName" class="form-control" required><br>
	<input type="text" placeholder="Last Name" name="lName" class="form-control" required> <br>
	<input type="email" placeholder="Email" name="email" class="form-control" required><br>
	<input type="password" placeholder="Password" name="pwd" class="form-control" required><br>
	<input type="submit" name="submitSignup" class="btn btn-success btn-block">
</form>