<?php 

  try {
    $hostname = "localhost:3306";
    $dbname = "acces_dades";
    $username = "dwes_user";
    $pw = "dwes_pass";
    $dbh = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
  
  try {
  	echo "Comença la inserció<br>";
	//cadascun d'aquests interrogants serà substituit per un paràmetre.
  	$stmt = $dbh->prepare("INSERT INTO prova (i, a) VALUES(?,?)"); 
	//a l'execució de la sentència li passem els paràmetres amb un array 
    $stmt->execute( array('13', 'caco')); 
    echo "Insertat!"; 
  } catch(PDOExecption $e) { 
    print "Error!: " . $e->getMessage() . " Desfem</br>"; 
  } 
   
?> 