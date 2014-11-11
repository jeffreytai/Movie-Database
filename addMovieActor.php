<html>
<head>
<title>Add Movie/Actor</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php

    $title = $_GET["movie"];
    $name = $_GET["name"];
    $role = $_GET["role"];
    $addSuccess = false;
    $emptyInput = false;

    if (($title != "") && ($name != "") && ($role != "") ) {
        $db_connection = mysql_connect("localhost","cs143","");
        if (!$db_connection) {
            $error = $mysql_error($db_connection);
            echo "Error in connection, $error";
            exit(1);
        }
        mysql_select_db('CS143');

        $names = explode(" ", $name);

        $movieId = mysql_query("SELECT id FROM Movie WHERE title='$title'");
        $actorId = mysql_query("SELECT id FROM Actor WHERE last='$names[1]' AND first='$names[0]'");
        $mid = mysql_fetch_row($movieId);
        $aid = mysql_fetch_row($actorId);
        mysql_query("INSERT INTO MovieActor VALUES($mid[0],$aid[0],'$role')");

        $addSuccess = true;

        mysql_close($db_connection);
    } else if (($title == "") && ($name == "") && ($role == "")) {}
    else $emptyInput = true;
?>


Add new actor in a movie:<br>
<form method="GET" action="./addMovieActor.php">
    Movie*:
    <input type="text" name="movie"><br>
    Actor's Name (First Last)*:
    <input type="text" name="name"><br>
    Role*:
    <input type="text" name="role"><br>
    <input type="submit" value="Add">
</form>
* indicates required field<br>
<hr>
<?php
    if ($addSuccess == true) {
        echo "<p>Added successfully!</p>";
        echo "<p><a target='main' href='./addMovieDirector.php'>Add the director for the movie</a></p>";
    }
    if ($emptyInput == true) {
        echo "<p>You must enter all required fields.</p>";
    }
?>
</body>

</html>