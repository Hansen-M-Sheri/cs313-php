<?php
if(!isset($_POST['Submit'])){
	header("Location: team06.php");
	exit();
}
else {
	$book = $_POST['book'];
	$chapter = $_POST['chapter'];
	$verse = $_POST['verse'];
	$content = $_POST['content'];
	$topics = $_POST['topic'];

	//insert scripture 
	$stmt = $db->prepare('INSERT INTO Scriptures(book,chapter,verse,content)
		VALUES(
		    :book,
		    :chapter,
		    :verse,
		    :content
		);
');
	$stmt->bindValue(':book', $book);
	$stmt->bindValue(':chapter', $chapter);
	$stmt->bindValue(':verse', $verse);
	$stmt->bindValue(':content', $content);
	$stmt->execute();
	$itemID = $db->lastInsertID('Scripture_id_seq');
	if(!$itemID > 1 ){
		header("Location: team06.php?id=$itemID");
		exit();
	}
	//insert into 
	foreach($topics as $topic){
		 $db->query("INSERT INTO Scriptures_to_Topic(Scriptures_id,Topic_id)
                VALUES($itemID,$topic);");
	
	}
}

?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>Team 06</title>
        <style type="text/css">
            body{
                font-size: 1em;
            }
            ul{
                list-style-type: none;
            }
            .scripture{
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h1>Scriptures</h1>

        <?php

        foreach($db->query("SELECT * FROM Topic;") as $row)
        {
            echo "<div>";
            echo "<h2>".$row[name]."</h2>";

            foreach($db->query("SELECT Scriptures_to_Topic.Scriptures_id,
                                Scriptures.book,Scriptures.chapter,
                                Scriptures.verse,Scriptures.content
                                FROM Scriptures_to_Topic
                                JOIN Scriptures
                                ON Scriptures_to_Topic.Scriptures_id = Scriptures.ID
                                WHERE Scriptures_to_Topic.Topic_id = $row[id];") as $scriptur)
            {
                echo "<p>";
                //scripture
                echo "<span class='scripture'>";
                echo $scriptur[book]." ".$scriptur[chapter].":".$scriptur[verse]." - ";
                echo "</span>";
                echo "&quot;".$scriptur[content]."&quot;";
                echo "</p>";

            }
        }

        ?>

    </body>
</html>
