<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css' />"; 

$mysqli = new mysqli("mysql.eecs.ku.edu", "khrenchir", "ilovecats", "khrenchir");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
	echo "connection failed";
    exit();
}

$query = "SELECT user_id FROM Users";
$username = $_POST['username'];
$userExists = FALSE;

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
		
		//case insensitive!! 
		if(strcasecmp($row["user_id"], $username) == 0) {
			$userExists = TRUE;
		} 
    }

    /* free result set */
    $result->free();
} 

if( $userExists ) {
	echo "<br>Sorry, this username is already taken. ";
} else if ($username == NULL){
	echo "Username cannot be blank";
} else {
	echo "<br>Username available! ";

	$mysqli->query("INSERT INTO Users (user_id) VALUES ('$username');");

	echo "User ".$username." created successfully. Would you like to start posting? <br>";
	echo "<a href=\"../src/CreatePosts.html\" class=\"button\">Create new post</a><br>";
	echo "<a href=\"../l5index.html\" class=\"button\">Return to Home</a>";
}

/* close connection */
$mysqli->close();
?> 
