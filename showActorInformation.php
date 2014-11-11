<html>
<head>
<title>Search Actor</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php
	$actor = $_GET["actor"];
	if ($actor != "") {
		$db_connection = mysql_connect("localhost","cs143","");
	    mysql_select_db('CS143', $db_connection);
	    $name = explode(" ",$actor);
	    $actorQuery = "SELECT id from Actor WHERE first='$name[0]' AND last='$name[1]'";
	    $actorId = mysql_query($actorQuery, $db_connection);
	    $aid = mysql_fetch_row($actorId);
	    echo "<p>$actor acted in the following movies:</p>";
	    $roleQuery = "SELECT role, mid FROM MovieActor WHERE aid=$aid[0]";
	    $rolesInMovies = mysql_query($roleQuery, $db_connection);
	    while ($row = mysql_fetch_row($rolesInMovies)) {
	    	$movieQuery = "SELECT title FROM Movie WHERE id=$row[1]";
	    	$movieTitle = mysql_query($movieQuery, $db_connection);
	    	$nr = mysql_fetch_row($movieTitle);
	    	echo "<p>Acted as $row[0] in <a target='main' href='./showMovieInformation.php?movie=$nr[0]'>'$nr[0]'</a></p>";
	    }
	    mysql_close($db_connection);
	}
?>


Search for an actor:<br>
<form method="GET" action="./showActorInformation.php">
    <input type="text" name="actor"><br>
    <input type="submit" value="Search">
</form>
<hr>
</body>

</html>