
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Test Page</title>
		
	</head>
	<body >
		<div >
			<?php
				$mysqli = new mysqli("mysql.eecs.ku.edu", "khrenchir", "ilovecats", "khrenchir");

				/* check connection */
				if ($mysqli->connect_errno) {
   					 printf("Connect failed: %s\n", $mysqli->connect_error);
    				 exit();
				}

				$query = "SELECT password FROM LOGIN";

				if ($result = $mysqli->query($query)) {

   				 	/* fetch associative array */
    				while ($row = $result->fetch_assoc()) {
        				//printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
        				echo "<br /><br /><br />";
        				echo $row["password"];
        				
    				}

    				/* free result set */
    				$result->free();
				}

				/* close connection */
				$mysqli->close();
			?>
		</div>
	</body>
</html>

