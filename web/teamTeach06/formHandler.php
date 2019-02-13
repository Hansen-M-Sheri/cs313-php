<?php
include('dbh.php');
	echo var_dump($_POST);
	$book = $_POST['book'];
	$chapter = $_POST['chapter'];
	$verse = $_POST['verse'];
	$content = $_POST['content'];
	$topics = $_POST['topic'];

try
{
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
	echo <br>;
	echo $itemID:
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
catch (Exception $ex)
{
	echo "Error with db. Details: $ex";
	die();

}

//redirect to new page to show the topics
header("Location: showTopics.php");
die();
?>

