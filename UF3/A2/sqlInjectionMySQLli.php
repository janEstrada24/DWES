<?php
    $mysqli = new mysqli("localhost","alumne","*********","sqlinj");

	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}

	/* Query and get the results */
	$user = $_GET["user"] ?? "";
	$pass = $_GET["password"] ?? "";

	$query = $mysqli->prepare("SELECT * FROM access WHERE username=? AND password=?");

	$query->bind_param("ss", $user, $pass);
 	$query->execute();

	/* Check results */
	$row = $query -> fetch(MYSQLI_ASSOC);

	if (!$row){
		die("Error authenticating");
	}
	
	$query->close();
	$mysqli->close();
?>