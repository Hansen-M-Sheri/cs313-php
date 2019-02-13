<?php
require("dbh.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Scripture and Topic List</title>
</head>
<body>

<div>
	<h1>
		<?php

		try{
			$statement = $db->prepare('SELECT id, book, chapter, verse, content FROM Scriptures');
			$statement->execute();
			while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				echo '</p>';
				echo '<strong>'.$row['book'].''.$row['chapter'].':';
				echo $row['verse'] . '</strong>' . ' - ' . $row['content'];
				echo '<br />';
				echo 'Topics: ';
			}
		}
		catch (Exception $ex)
		{
			echo "Error displaying. Details: $ex";
			die();

		}
		?>
</body>
</html>