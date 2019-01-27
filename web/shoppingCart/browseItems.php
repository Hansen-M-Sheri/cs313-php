<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Browse Items Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="script.js"></script>


</head>
<body>

	    <!-- Nav bar-->
    <nav class="navbar navbar-expand-lg navbar-light ">
      <a class="navbar-brand" href="browseItems.php"><i class="fas fa-book"></i></a>
      <div class="navbar-cart">
      	<a class="navbar-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
  		<a class="navbar-car" href="cart.php">Cart</a>
  	</div>
    </nav>
    <!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Books.com</h1>
  		
    </div>
    <!-- Cards -->

  <div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title" id="title1">The Holy Temple</h3>
        <h4 class="card-subtitle" id="price1">$15.00</h4>
        <p class="card-text" id="subtitle1">Hardback copy of classic by Boyd K. Packer</p>
        <button type="button" class="btn btn-primary align-self-end"
                onclick="addItem(1, $('#title1').html(),$('#subtitle1').html
                (),$('#price1').html(),1, 'add')">
            Add to Cart</button>
         
      </div> <!--card body-->
    </div> <!-- card -->
  </div> <!--column-->
  <div class="col-sm-4">
    <div class="card" >
      <div class="card-body">
        <h3 class="card-title" id="title2">No Doubt About It</h3>
        <h4 class="card-subtitle" id="price2">$12.00</h4>
        <p class="card-text" id="subtitle2">Hardback version by Sheri Dew</p>
        <button type="button" class="btn btn-primary align-self-end"
                onclick="addItem(2, $('#title2').html(),$('#subtitle2').html
                (),$('#price2').html(),1, 'add')">
            Add to Cart</button>
      </div> <!--card body-->
    </div> <!-- card -->
  </div> <!--column-->
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>

</body>
</html>