<html>
<head>
<title>Add Movie Comments</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php

    $name = $_GET["name"];
    $movie = $_GET["movie"];
    $rating = $_GET["rating"];
    $comment = $_GET["comment"];
    $addSuccess = false;
    $emptyInput = false;

    if (($name != "") && ($movie != "") && ($comment != "")) {
        $db_connection = mysql_connect("localhost","cs143","");
        if (!$db_connection) {
            $error = $mysql_error($db_connection);
            echo "Error in connection, $error";
            exit(1);
        }
        mysql_select_db('CS143');

        $movieQuery = "SELECT id FROM Movie WHERE title='$movie'";

        $movieId = mysql_query($movieQuery, $db_connection);
        $mid = mysql_fetch_row($movieId);
        
        mysql_query("INSERT INTO Review VALUES('$name',CURRENT_TIMESTAMP,$mid[0],$rating,'$comment')");
        
        $addSuccess = true;

        mysql_close($db_connection);
    } else if (($name == "") && ($movie == "") && ($comment == "")) {}
    else {
        $emptyInput = true;
    }
?>

Add comments to movie:<br>
<form method="GET" action="./addMovieComments.php">
	Name*:
	<input type="text" name="name"><br>
    Movie*:
    <input type="text" name="movie"><br>
    Rating (5 being the highest):
    <select name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select><br>
    Comment*:<br>
    <textarea name="comment" cols="60" rows="8"></textarea><br>
    <input type="submit" value="Add">
</form>
* indicates required field<br>
<hr>

<?php
    if ($addSuccess == true) {
        echo "<p>Added successfully!</p>";
        echo "<p><a target='main' href='./addMovieComments.php'>Add another comment</a></p>";
        echo "<p><a target='main' href='./showMovieInformation.php'>Search up movie information</a></p>";
    }
    if ($emptyInput == true) {
        echo "<p>You must enter all required fields.</p>";
    }
?>
</body>

</html>