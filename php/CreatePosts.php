<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$mysqli = new mysqli("mysql.eecs.ku.edu", "khrenchir", "ilovecats", "khrenchir");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
	echo "connection failed";
    exit();
}

$query = "SELECT user_id FROM Users";
$username = $_POST['username'];
$content = $_POST['postContent'];
$userExists = FALSE;

//make sure the username/author id is valid and exists
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

$insert = "INSERT INTO Posts (post_id, content, author_id) VALUES ( ";

if( $userExists && $content != NULL && $username != NULL) {

	$mysqli->query($insert."NULL, '$content', '$username' );" );
	echo "Post \"".$content."\" successfully posted by ".$username."!";
	echo "<br> Would you like to post again? <br>";
	echo "<a href=\"../src/CreatePosts.html\" class=\"button\">Create new post</a>";

} else {
	echo "ERROR <br>";
	 if ($username == NULL || $userExists != 1){
		if($username == NULL){
			echo "<br>Username cannot be blank";
		} else if ($userExists != 1) {
			echo "<br>Username does not exist in database";
		}
	}

	if($content == NULL){
			echo "<br>Content cannot be blank";
	}
} 

echo "<br><a href=\"../l5index.html\" class=\"button\">Return to Home</a>";

/* close connection */
$mysqli->close();
?> 
