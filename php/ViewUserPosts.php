 <?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css' />"; 
echo "<title>View User Posts </title>";

$mysqli = new mysqli("mysql.eecs.ku.edu", "khrenchir", "ilovecats", "khrenchir");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
	echo "connection failed";
    exit();
}

$username = $_POST['poster'];
echo "<h1> Posts from ".$username."</h1>";

$postId = array();
$postContent = array();
$query = "SELECT Posts.author_id, Posts.post_id, Posts.content FROM Users INNER JOIN Posts ON Users.user_id=Posts.author_id ORDER BY Posts.post_id";
$length = 0;
if ($result = $mysqli->query($query)) {

    /* fetch associative array */

	while ($row = $result->fetch_assoc()) {
		if(strcasecmp($row["author_id"], $username) == 0 ) {
			$postContent[$length] = $row["content"];
			$postId[$length] = $row["post_id"];
			$length++;
		}
	}


    /* free result set */
    $result->free();
} 


$arrlength = count($postId);
if($arrlength != 0)  {
	echo "<table><tr><th>Post Id</th><th>Post Content</th></tr>";
	for($x = 0; $x < $arrlength; $x++) {
		echo "<tr><td>".$postId[$x]."</td>";
		echo "<td>".$postContent[$x]."</td></tr>";
	}
	echo "</table>";
} else {
	echo "This user has not made any posts yet.";
}

	echo " <br>";
	echo "<a href=\"../src/AdminHome.html\" class=\"button\">Return to Admin Home</a>";
/* close connection */
$mysqli->close();
?>  
