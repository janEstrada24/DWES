<?php
	try {
		$hostname = "localhost";
		$dbname = "sqlinj";
		$username = "alumne";
		$pw = "*********";
		$dbh = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	} catch (PDOException $e) {
		echo "Failed to get DB handle: " . $e->getMessage() . "\n";
		exit;
	}

	$user = $_GET["user"] ?? "";
	$pass = $_GET["password"] ?? "";

	try {	
		$sql="select * from access where username= ? AND password= ?";
		$query = $dbh->prepare($sql);
		$query->execute(array( $user, $pass ));
	} catch(PDOExecption $e) { 
	  print "Error!: " . $e->getMessage() . " Desfem</br>"; 
	} 

	unset($dbh);
	unset($query);

?>