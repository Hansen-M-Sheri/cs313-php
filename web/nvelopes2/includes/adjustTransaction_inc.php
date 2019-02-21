<?php
if(!isset($_GET['type'])){
	header("Location: ../transactions.php");
	die();
}
else {
	if($_GET['type'] == 'edit'){
		//update the form?  This will be harder - do it last

	}
	else if($_GET['type'] == 'remove'){
		//delete from db 
	}
}