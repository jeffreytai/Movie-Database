<html>
<head>
<title>Add Movie/Director</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php

    $title = $_GET["movie"];
    $name = $_GET["name"];
    $addSuccess = false;
    $emptyInput = false;

    if (($title != "") && ($name != "")) {
        $db_connection = mysql_connect("localhost","cs143","");
        if (!$db_connection) {
            $error = $mysql_error($db_connection);
            echo "Error in connection, $error";
            exit(1);
        }
        mysql_select_db('CS143');

        $names = explode(" ", $name);
        $movieId = mysql_query("SELECT id FROM Movie WHERE title='$title'");
        $directorId = mysql_query("SELECT id FROM Director WHERE last='$names[1]' AND first='$names[0]'");
        $mid = mysql_fetch_row($movieId);
        $did = mysql_fetch_row($directorId);
        mysql_query("INSERT INTO MovieDirector VALUES($mid[0],$did[0])");

        $addSuccess = true;
        mysql_close($db_connection);
    } else if (($title == "") && ($name == "")) {}
    else {
        $emptyInput = true;
    }
?>


Add new director to movie:<br>
<form method="GET" action="./addMovieDirector.php">
    Movie*:
    <input type="text" name="movie"><br>
    Director's Name (First Last)*:
    <input type="text" name="name"><br>
    <input type="submit" value="Add">
</form>
* indicates required field<br>
<hr>
<?php
    if ($addSuccess == true) {
        echo "<p>Added successfully!</p>";
        echo "<p><a target='main' href='./addMovieActor.php'>Add an actor for the movie</a></p>";
    }
    if ($emptyInput == true) echo "<p>You must enter all required fields.</p>";
?>
</body>

</html>
