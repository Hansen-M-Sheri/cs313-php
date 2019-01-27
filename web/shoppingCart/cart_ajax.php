<?php
session_start();
//var_dump($_SESSION);
//if post is set create the cart and store in sessions
	if($_POST['action']== "deleteCart"){
		unset($_SESSION['cart']);
		session_destroy();
	}
	if(isset($_POST['id'])) {
		$id = $_POST['id'];

		//check flag for remove, delete all, or add
		if($_POST['action'] == "deleteItem"){
//			echo "before delete";
//			echo var_dump($_SESSION['cart'][$id]);
			unset($_SESSION['cart'][$id]);
//			echo "after delete";
//			echo var_dump($_SESSION['cart'][$id]);
		}
		elseif ($_POST['action'] == "deleteCart"){
			unset($_SESSION['cart']);
		}
		else {
			//create cartArray & store array of items inside of it w/ id being key
			$qty = $_POST['qty'];
			//check to see if item exists in cart
			if (!empty($_SESSION['cart'][$id])) {
				//if yes, add qty to session qty
				$_SESSION['cart'][$id]['qty'] += $qty;
			} else {
				//if no, add to session cart
				$_SESSION['cart'][$id] = array(
					'title' => $_POST['title'],
					'subtitle' => $_POST['subtitle'],
					'price' => $_POST['price'],
					'qty' => $_POST['qty']

				);
			}
		}
	}



	?>

