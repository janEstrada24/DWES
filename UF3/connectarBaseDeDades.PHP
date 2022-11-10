<?php
    //connexió dins block try-catch:
    //  prova d'executar el contingut del try
    //  si falla executa el catch

    try {
        $hostname = "localhost";
        $dbname = "acces_dades";
        $username = "u_acces_dades";
        $pw = "i";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }
  
    //preparem la consulta i l'executem
    $query = $pdo->prepare("select i, a FROM prova");
    $query->execute();

    //comprovo errors:
    $e= $query->errorInfo();
    if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);
    }  

    //itero
    foreach ($query as $row) {
        echo $row['i']." - " . $row['a']. "<br/>";
    }

    //eliminem els objectes per alliberar memòria 
    unset($pdo); 
    unset($query)
 
?>