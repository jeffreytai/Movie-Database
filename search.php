<html>
<head>
<title>Search Actor/Movie</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php
	$keyword = $_GET["keyword"];
	if ($keyword != "") {
		$db_connection = mysql_connect("localhost","cs143","");
	    mysql_select_db('CS143', $db_connection);

	    if (preg_match('/\s/',$keyword) == 1) {
	    	// contains a space character so two words were inputted
	    	$names = explode(" ",$keyword);
	    	$queryNames = "SELECT first, last
	    					FROM Actor
	    					WHERE (first LIKE '%$names[0]%')
	    						AND (last LIKE '%$names[1]%')";
	    	$queryMovies = "SELECT title
	    					FROM Movie
	    					WHERE (title LIKE '%$names[0]%')
	    						AND (title LIKE '%$names[1]%')";
	    	$containedInName = mysql_query($queryNames, $db_connection);
	    	echo "Searching match records in Actor database...<br>";
	    	if (mysql_num_rows($containedInName) != 0) {
	    		// some actors (first or last name) that contain both the first and last name
	    		while ($row = mysql_fetch_row($containedInName)) {
	    			$actorDOBQuery = "SELECT dob FROM Actor WHERE first='$row[0]' AND last='$row[1]'";
	    			$actorDOB = mysql_query($actorDOBQuery, $db_connection);
	    			$dob = mysql_fetch_row($actorDOB);
	    			echo "Actor: <a target='main' href='./showActorInformation.php?actor=$row[0]+$row[1]'>$row[0] $row[1]</a> ($dob[0])<br>";
	    		}
	    	} else {
	    		echo "No matches found in Actor database.<br>";
	    	}
	    	echo "<br><br>";
	    	$containedInMovie = mysql_query($queryMovies, $db_connection);
	    	echo "Searching match records in Movie database...<br>";
	    	if (mysql_num_rows($containedInMovie) != 0) {
	    		// some movies that contain the keyword
	    		while ($row = mysql_fetch_row($containedInMovie)) {
	    			$movieYearQuery = "SELECT year FROM Movie WHERE title='$row[0]'";
	    			$movieYear = mysql_query($movieYearQuery, $db_connection);
	    			$year = mysql_fetch_row($movieYear);
	    			echo "Movie: <a target='main' href='./showMovieInformation.php?movie=$row[0]'>$row[0]</a> ($year[0])<br>";
	    		}
	    	} else {
	    		echo "No matches found in Movie database.<br>";
	    	}

	    } else if (preg_match('/\s/', $keyword) == 0) {
	    	// only one word was inputted
	    	$queryNames = "SELECT first, last
	    					FROM Actor
	    					WHERE (first LIKE '%$keyword%')
	    						OR (last LIKE '%$keyword%')";
	    	$queryMovies = "SELECT title
	    					FROM Movie
	    					WHERE title LIKE '%$keyword%'";
	    	$containedInName = mysql_query($queryNames, $db_connection);
	    	echo "Searching match records in Actor database...<br>";
	    	if (mysql_num_rows($containedInName) != 0) {
	    		// some actors contain the name keyword
	    		while ($row = mysql_fetch_row($containedInName)) {
	    			$actorDOBQuery = "SELECT dob FROM Actor WHERE first='$row[0]' AND last='$row[1]'";
	    			$actorDOB = mysql_query($actorDOBQuery, $db_connection);
	    			$dob = mysql_fetch_row($actorDOB);
	    			echo "Actor: <a target='main' href='./showActorInformation.php?actor=$row[0]+$row[1]'>$row[0] $row[1]</a> ($dob[0])<br>";
	    		}
	    	} else {
	    		echo "No matches found in the Actor database.<br>";
	    	}
	    	echo "<br>";
	    	$containedInMovie = mysql_query($queryMovies, $db_connection);
	    	echo "<p>Searching match records in Movie database...</p>";
	    	if (mysql_num_rows($containedInMovie) != 0) {
	    		// some movies contain the name keyword
	    		while ($row = mysql_fetch_row($containedInMovie)) {
	    			$movieYearQuery = "SELECT year FROM Movie WHERE title='$row[0]'";
	    			$movieYear = mysql_query($movieYearQuery, $db_connection);
	    			$year = mysql_fetch_row($movieYear);
	    			echo "Movie: <a target='main' href='./showMovieInformation.php?movie=$row[0]'>$row[0]</a> ($year[0])<br>";
	    		}
	    	} else {
	    		echo "No matches found in the Movie database.<br>";
	    	}
	    } else {}

	    echo "<br><hr>";

	    mysql_close($db_connection);
	}
?>

Search for actors/movies
<form method="GET" action="./search.php">
Search:
<input type="text" name="keyword">
<input type="submit" value="Search">
</form>
<hr>
</body>

</html>