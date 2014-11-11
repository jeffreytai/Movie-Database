<html>
<head>
<title>Add Actor/Director</title>
<style type="text/css">
@import url(styles.css);
</style>
</head>

<body style="background-color: #ffc3a0">

<?php
    $identity = $_GET["identity"];
    $name = $_GET["name"];
    $sex = $_GET["sex"];
    $dob = $_GET["dob"];
    $dod = $_GET["dod"];
    $addSuccess = false;
    $emptyInput = false;

    if (($name != "") && ($dob != "")) {
        $names = explode(" ",$name);

        $db_connection = mysql_connect("localhost","cs143","");
        mysql_select_db('CS143', $db_connection);

        $query = "SELECT id FROM MaxPersonID";
        $highestID = mysql_query($query, $db_connection);
        $numRow = mysql_fetch_row($highestID);
        $id = $numRow[0];
        $id = $id + 1;
        if ($identity == "Actor") {
            if ($dod == "") $query = mysql_query("INSERT INTO Actor VALUES($id,'$names[1]','$names[0]','$sex','$dob', NULL)");
            else $query = mysql_query("INSERT INTO Actor VALUES($id,'$names[1]','$names[0]','$sex','$dob','$dod')");
        } else if ($identity == "Director") {
            if ($dod == "") $query = mysql_query("INSERT INTO Director VALUES($id, '$names[1]', '$names[0]', '$dob', NULL)");
            else $query = mysql_query("INSERT INTO Director VALUES($id, '$names[1]', '$names[0]', '$dob', '$dod')");
        } else if ($identity == "Both") {
            if ($dod == "") {
                $query1 = mysql_query("INSERT INTO Actor VALUES($id,'$names[1]','$names[0]','$sex','$dob', NULL)");
                $query2 = mysql_query("INSERT INTO Director VALUES($id, '$names[1]', '$names[0]', '$dob', NULL)");
            } else {
                $query1 = mysql_query("INSERT INTO Actor VALUES($id,'$names[1]','$names[0]','$sex','$dob', NULL)");
                $query2 = mysql_query("INSERT INTO Director VALUES($id, '$names[1]', '$names[0]', '$dob', NULL)");
            }
        }

        $query = "UPDATE MaxPersonID SET id=$id";
        mysql_query($query, $db_connection);

        $addSuccess = true;

        mysql_close($db_connection);
    } else if (($name == "") && ($dob == "")) { }
    else {
        $emptyInput = true;
    }
?>

Add new actor/director:<br>
<form method="GET" action="./addActorDirector.php">
    Identity:
    <input type="radio" checked="true" value="Actor" name="identity">
    Actor
    <input type="radio" value="Director" name="identity">
    Director
    <input type="radio" value="Both" name="identity">
    Both
    <br>
    <hr>
    Name (First Last)*:
    <input type="text" maxlength="20" name="name"><br>
    Sex:
    <input type="radio" checked="true" value="Male" name="sex">
    Male
    <input type="radio" value="Female" name="sex">
    Female<br>
    Date Of Birth (YYYYMMDD)*:
    <input type="text" name="dob"><br>
    Date of Death (YYYYMMDD) -Leave blank if still alive today-:
    <input type="text" name="dod"><br>
    <input type="submit" value="Add">
</form>
* indicates required field<br>
<hr>

<?php
    if ($addSuccess == true) {
        echo "<p>Added successfully!</p>";
    }
    if ($emptyInput == true) {
        echo "<p>You must enter all required fields.</p>";
    }
?>

</body>

</html>