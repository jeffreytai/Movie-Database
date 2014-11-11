<html>
<head>
<title>Search Movie</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php
	$title = $_GET["movie"];
	if ($title != "") {

	    $db_connection = mysql_connect("localhost","cs143","");
	    mysql_select_db('CS143', $db_connection);

	    $movieInfoQuery = "SELECT company, rating, id FROM Movie WHERE title='$title'";
	    $movieInfo = mysql_query($movieInfoQuery, $db_connection);
	    $row = mysql_fetch_row($movieInfo);
	    $mid = $row[2];

	    echo "<p>-- Show Movie Information --</p>";
	    echo "<p>Title: $title</p>";
	    echo "<p>Company: $row[0]</p>";
	    echo "<p>MPAA Rating: $row[1]</p><br>";

	    echo "<p>-- List of Actors/Actresses --</p>";
	    $actorQuery = "SELECT aid, role FROM MovieActor WHERE mid=$row[2]";
	    $actorList = mysql_query($actorQuery, $db_connection);
	    while ($newActor = mysql_fetch_row($actorList)) {
	    	$nameQuery = "SELECT first, last FROM Actor WHERE id=$newActor[0] LIMIT 1";
	    	$actorName = mysql_query($nameQuery, $db_connection);
	    	$listActor = mysql_fetch_row($actorName);
	    	echo "<p><a target='main' href='./showActorInformation.php?actor=$listActor[0]+$listActor[1]'>$listActor[0] $listActor[1]</a> as $newActor[1]</p>";
	    }

	    echo "<br><p>-- User Review --</p>";
	    $ratingQuery = "SELECT AVG(rating) FROM Review WHERE mid=$mid";
	    $reviewQuery = "SELECT COUNT(name) FROM Review WHERE mid=$mid GROUP BY mid";
	    $avgRating = mysql_query($ratingQuery, $db_connection);
	    $numReviews = mysql_query($reviewQuery, $db_connection);
	    $averageRating = mysql_fetch_row($avgRating);
	    $reviews = mysql_fetch_row($numReviews);
	    if (isset($averageRating[0])) {
	    	echo "<p>Average Score: $averageRating[0] (out of 5)<br>
	    	Number of Reviews: $reviews[0] review(s).</p>";
	    } else {
	    	echo "<p>Average Score: No scores yet<br>
	    	Number of Reviews: No reviews yet.</p>";
	    }
	    echo "<p><a target='main' href='./addMovieComments.php'>ADD A REVIEW!</a></p><br>";

	    $commentQuery = "SELECT comment FROM Review WHERE mid=$mid";
	    $allComments = mysql_query($commentQuery, $db_connection);
	    while ($comment = mysql_fetch_row($allComments)) {
	    	$infoCommentQuery = "SELECT time, name, rating FROM Review WHERE mid=$mid AND comment='$comment[0]' LIMIT 1";
	    	$infoOnComment = mysql_query($infoCommentQuery, $db_connection);
	    	$currentComment = mysql_fetch_row($infoOnComment);
	    	echo "<p>Date/Time: $currentComment[0]<br>
	    	By: $currentComment[1]<br>
	    	Rating: $currentComment[2]<br>
	    	Comment: $comment[0]<br><br></p>";
	    }

	    mysql_close($db_connection);
	}

	echo "<hr>";
?>


Search for a movie:<br>
<form method="GET" action="./showMovieInformation.php">
    <input type="text" name="movie"><br>
    <input type="submit" value="Search">
</form>
<hr>
</body>

</html>