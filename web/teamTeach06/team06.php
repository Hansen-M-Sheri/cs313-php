<?php
 error_reporting(E_ALL);
  ini_set('display_errors', 1);
//include db connect file
include 'dbh.php';
	//get list of topics store in array
	$sql = "SELECT name FROM Topic";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$returnArray = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="#" method="post" class="myForm">
		<input type="text" name="book" placeholder="Book">
		<input type="text" name="chapter" placeholder="Chapter">
		<input type="text" name="verse" placeholder="Verse">
		<input type="textarea" name="content" placeholder="Content">
		<?php

              foreach($db->query('SELECT * FROM Topic;') as $row)
                {

                    echo "<li>";
                    //scripture
                    echo "<input type='checkbox' name='topic[]' value='".$row[id]."'/>";
                    echo $row[name];
                    echo "</li>";

                }

            ?>		
            <input type="submit" value="Add Scripture">
	</form>

</body>
</html>