 <?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<link rel='stylesheet' type='text/css' href='../css/style.css' />"; 
echo "<title>View Users </title>";
echo "<h1> List of all users</h1>"; 

$mysqli = new mysqli("mysql.eecs.ku.edu", "khrenchir", "ilovecats", "khrenchir");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
	echo "connection failed";
    exit();
}

$query = "SELECT user_id FROM Users";


	echo'<table><tr>';
if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
			echo '<tr><td> ';
		echo $row["user_id"];
			echo '</td></tr> ';
    }

    /* free result set */
    $result->free();
} 
	echo'</tr></table>';

	echo " <br>";
	echo "<a href=\"../src/AdminHome.html\" class=\"button\">Return to Admin Home</a>";

/* close connection */
$mysqli->close();
?> 
