<?php
include "cart_ajax.php";
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Cart.php</title>
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

			<button type="button" class="btn btn-info">
				<a class="navbar-car" href="checkout.php">Checkout</a></button>
		</div>
	</nav>
		<div class="content" >
		<table class="table table-striped">
			<th>Title</th>
			<th>Description</th>
			<th>Price</th>
			<th>Qty</th>
			<th></th>
			<?php
			if(empty($_SESSION['cart'])) { ?>
				<tr>
					<td></td>
					<td>Cart Is Empty</td>
				</tr>
				<?php
				}
				else{

				foreach($_SESSION['cart'] as $item){
					if($item['qty'] <= 0){
						break;
					}

			?>

			<tr>
				<td>
					<span id="title"><?php echo $item['title'] ?></span>
				</td>
				<td>
					<span id="subtitle"><?php echo $item['subtitle'] ?></span>
				</td>
				<td>
					<span id="price"><?php echo $item['price'] ?></span>
				</td>
				<td>
					<span id="qty"><?php echo $item['qty'] ?></span>
				</td>
				<td>
					<!--<button type="button" class="btn btn-danger btn-sm"
							onclick="addItem(<?php echo $item?>, $('#title1').html(),$
							('#subtitle1').html(),$('#price1').html(),1, 'deleteItem')">
						Remove</button>-->
					<button type="button" class="btn btn-danger btn-sm"
							onclick="removeItem(<?php echo $item?>, 'deleteItem')">
						Remove</button>
				</td>

			</tr>
			<?php }
				} //end $item ?>
<!--			--><?php // endforeach; //end $id?>

		</table>
			<button type="button" class="btn btn-danger btn-sm" onclick="deleteCart('deleteCart')">DELETE CART</button>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	</body>
	</html>