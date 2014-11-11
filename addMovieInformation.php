<html>
<head>
<title>Add Movie Information</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php

    $title = $_GET["title"];
    $company = $_GET["company"];
    $year = $_GET["year"];
    $mpaa = $_GET["mpaarating"];
    $addSuccess = false;
    $emptyInput = false;

    if (($title != "") && ($company != "") && ($year != "")) {
        $db_connection = mysql_connect("localhost","cs143","");
        if (!$db_connection) {
            $error = $mysql_error($db_connection);
            echo "Error in connection, $error";
            exit(1);
        }
        mysql_select_db('CS143');

        $genreArray = array();
        $genre_Action = $_GET["genre_Action"];
        if ($genre_Action != "") array_push($genreArray, $genre_Action);
        $genre_Adventure = $_GET["genre_Adventure"];
        if ($genre_Adventure != "") array_push($genreArray, $genre_Adventure);
        $genre_Animation = $_GET["genre_Animation"];
        if ($genre_Animation != "") array_push($genreArray, $genre_Animation);
        $genre_Comedy = $_GET["genre_Comedy"];
        if ($genre_Comedy != "") array_push($genreArray, $genre_Comedy);
        $genre_Crime = $_GET["genre_Crime"];
        if ($genre_Crime != "") array_push($genreArray, $genre_Crime);
        $genre_Documentary = $_GET["genre_Documentary"];
        if ($genre_Documentary != "") array_push($genreArray, $genre_Documentary);
        $genre_Drama = $_GET["genre_Drama"];
        if ($genre_Drama != "") array_push($genreArray, $genre_Drama);
        $genre_Family = $_GET["genre_Family"];
        if ($genre_Family != "") array_push($genreArray, $genre_Family);
        $genre_Fantasy = $_GET["genre_Fantasy"];
        if ($genre_Fantasy != "") array_push($genreArray, $genre_Fantasy);
        $genre_Horror = $_GET["genre_Horror"];
        if ($genre_Horror != "") array_push($genreArray, $genre_Horror);
        $genre_Musical = $_GET["genre_Musical"];
        if ($genre_Musical != "") array_push($genreArray, $genre_Musical);
        $genre_Mystery = $_GET["genre_Mystery"];
        if ($genre_Mystery != "") array_push($genreArray, $genre_Mystery);
        $genre_Romance = $_GET["genre_Romance"];
        if ($genre_Romance != "") array_push($genreArray, $genre_Romance);
        $genre_SciFi = $_GET["genre_SciFi"];
        if ($genre_SciFi != "") array_push($genreArray, $genre_SciFi);
        $genre_Short = $_GET["genre_Short"];
        if ($genre_Short != "") array_push($genreArray, $genre_Short);
        $genre_Thriller = $_GET["genre_Thriller"];
        if ($genre_Thriller != "") array_push($genreArray, $genre_Thriller);
        $genre_War = $_GET["genre_War"];
        if ($genre_War != "") array_push($genreArray, $genre_War);
        $genre_Western = $_GET["genre_Western"];
        if ($genre_Western != "") array_push($genreArray, $genre_Western);

        $highestID = mysql_query("SELECT id FROM MaxMovieID");
        $numRow = mysql_fetch_row($highestID);
        $id = $numRow[0];
        $id = $id + 1;

        mysql_query("INSERT INTO Movie VALUES($id,'$title',$year,'$mpaa','$company')");
        for ($i=0;$i<count($genreArray);$i++) {
            mysql_query("INSERT INTO MovieGenre VALUES($id,'$genreArray[$i]')");
        }
        mysql_query("UPDATE MaxMovieID SET id=$id");

        $addSuccess = true;

        mysql_close($db_connection);
    } else if (($title == "") && ($company == "") && ($year == "")) {}
    else {
        $emptyInput = true;
    }
?>

Add new movie:<br>
<form method="GET" action="./addMovieInformation.php">
    Title*:
    <input type="text" name="title"><br>
    Company*:
    <input type="text" name="company"><br>
    Year*:
    <input type="text" name="year"><br>
    MPAA Rating:
    <select name="mpaarating">
        <option value="G">G</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13</option>
        <option value="R">R</option>
        <option value="NC-17">NC-17</option>
    </select><br>
    Genre:
    <input type="checkbox" name="genre_Action" value="Action">Action
    <input type="checkbox" name="genre_Adventure" value="Adventure">Adventure
    <input type="checkbox" name="genre_Animation" value="Animation">Animation
    <input type="checkbox" name="genre_Comedy" value="Comedy">Comedy
    <input type="checkbox" name="genre_Crime" value="Crime">Crime
    <input type="checkbox" name="genre_Documentary" value="Documentary">Documentary
    <input type="checkbox" name="genre_Drama" value="Drama">Drama
    <input type="checkbox" name="genre_Family" value="Family">Family
    <input type="checkbox" name="genre_Fantasy" value="Fantasy">Fantasy
    <input type="checkbox" name="genre_Horror" value="Horror">Horror
    <input type="checkbox" name="genre_Musical" value="Musical">Musical
    <input type="checkbox" name="genre_Mystery"value="Mystery">Mystery
    <input type="checkbox" name="genre_Romance" value="Romance">Romance
    <input type="checkbox" name="genre_SciFi" value="Sci-Fi">Sci-Fi
    <input type="checkbox" name="genre_Short" value="Short">Short
    <input type="checkbox" name="genre_Thriller" value="Thriller">Thriller
    <input type="checkbox" name="genre_War" value="War">War
    <input type="checkbox" name="genre_Western" value="Western">Western
    <br>   
    <input type="submit" value="Add">
</form>
* indicates required field<br>
<hr>

<?php
    if ($addSuccess == true) {
        echo "<p>Added successfully!</p>";
        echo "<p><a target='main' href='./addMovieDirector.php'>Add the director for the movie</a></p>";
        echo "<p><a target='main' href='./addMovieActor.php'>Add an actor for the movie</a></p>";
    }
    if ($emptyInput == true) {
        echo "<p>You must enter all required fields.</p>";
    }

?>

</body>

</html>