<?php
$if(!isset($_POST['Submit'])){
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
')
	$stmt->bindValue(':book', $book);
	$stmt->bindValue(':chapter', $chapter);
	$stmt->bindValue(':verse', $verse);
	$stmt->bindValue(':content', $content);
	$stmt->execute();
	$itemID = $db->lastInsertID('Scripture_id_seq');
	//insert into 
	foreach($topics as $topic){
		'SELECT ID FROM Topic WHERE name=$topic';
		$stmt = $db->prepare('INSERT INTO ScripturesXTopic(book,chapter,verse,content)
			VALUES(
			    :book,
			    :chapter,
			    :verse,
			    :content
			);
	')
	}
}