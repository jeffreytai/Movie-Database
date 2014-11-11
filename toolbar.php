<html>
<head>
	<meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="jquery-latest.min.js" type="text/javascript"></script>
	<script src="menu.js"></script>
	<title>Navigation</title>
</head>

<body style="background-color: #ce8f31">
<ul id="nav">
    <li><a class="hsubs" href="#">Add New Content</a>
        <ul class="subs">
            <li><a target="main" href="./addActorDirector.php">Actor/Director</a></li>
            <li><a target="main" href="./addMovieInformation.php">Movie Information</a></li>
            <li><a target="main" href="./addMovieComments.php">Movie Comments</a></li>
            <li><a target="main" href="./addMovieActor.php">Movie/Actor Relation</a></li>
            <li><a target="main" href="./addMovieDirector.php">Movie/Director Relation</a></li>
        </ul>
    </li>
    <li><a class="hsubs" href="#">Browsing Content</a>
        <ul class="subs">
            <li><a target="main" href="./showActorInformation.php">Actor Information</a></li>
            <li><a target="main" href="./showMovieInformation.php">Movie Information</a></li>
        </ul>
    </li>
    <li><a class="hsubs" href="#">Search Interface</a>
        <ul class="subs">
            <li><a target="main" href="./search.php">Actor/Movie</a></li>
        </ul>
    </li>
    <div id="lavalamp"></div>
</ul>

</body>

</html>