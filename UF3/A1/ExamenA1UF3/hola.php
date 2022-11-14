<?php 
    session_start(); 
    /**
     * Funcions per comprovar prèviament
     * que les dades de sessions que 
     * utilitzarem en aquest document 
     * existeixen
     *
     * @return string
     */
    function obtenirCorreu():string {
        if (isset($_SESSION['correu'])) {
            return $_SESSION['correu'];
        }
    }

    /**
     *
     * @return string
     */
    function obtenirNom():string {

        try {
            $hostname = "localhost";
            $dbname = "dwes_janestrada_autpdo";
            $username = "dwes_user";
            $pw = "dwes_pass";
            $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");

        } catch (PDOException $e) {
            echo "Problemes per gestionar la base de dades: " . $e->getMessage() . "\n";
            exit;
        }

        $nom = "";

        $sql="select nom from usuaris where correu = ?";
        $query = $pdo->prepare($sql);
        $query->execute( array( obtenirCorreu() ) );
        $fila = $query->fetch();

        //eliminem els objectes per alliberar memòria 
        unset($pdo); 
        unset($query);

        return $fila['nom'];

    }


    $tempsActual = time();
    /**
     * Restem el temps de la data actual amb el de 
     * la data de l'autentificació. 
     * Un cop el resultat sigui més gran de 60 (segons),
     * ja no es mantindrà activa.
     */
    if (!isset($_SESSION['dataAutentificacio']) || ($tempsActual - $_SESSION['dataAutentificacio']) > 60) {
        header('Location: index.php', true, 303);
    }


    /**
     * Imprimim les connexions que hem anat fent.
     *
     * @return string
     */
    function imprimirConnexions():string {
        // Accedim a la base de dades
        try {
            $hostname = "localhost";
            $dbname = "dwes_janestrada_autpdo";
            $username = "dwes_user";
            $pw = "dwes_pass";
            $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");

        } catch (PDOException $e) {
            echo "Problemes per gestionar la base de dades: " . $e->getMessage() . "\n";
            exit;
        }

        $correu = obtenirCorreu();

        $sql="select ip, correu, dataAutentificacio, status from connexions where correu = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array( $correu ));

        $e= $query->errorInfo();
        if ($e[0]!='00000') {
          echo "\nPDO::errorInfo():\n";
          die("Error accedint a dades: " . $e[2]);
        }  

        $resultat = "";

        foreach ( $query as $fila ) {
            if ($fila['correu'] == $correu) {
                if ($fila['status'] == "signup_correcte"
                    || $fila['status'] == "signin_correcte") {
                    $resultat .= "Connexió des de " . $fila['ip'] . " amb data " . $fila['dataAutentificacio'] . "<br>";
                }
            }            
        }

        //eliminem els objectes per alliberar memòria 
        unset($pdo); 
        unset($query);
        
        return $resultat;
    }

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Benvingut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">

</head>
<body>
<div class="container noheight" id="container">
    <div class="welcome-container">
        <h1>Benvingut!</h1>
        <div>Hola <?php echo obtenirNom();?>, les teves darreres connexions són:</div>
        <div>
            <?php echo imprimirConnexions();?>
        </div>
        <form action="process.php" method="post">
            <input type="hidden" name="method" value="logoff"/>
            <button type="submit">Tanca la sessió</button>
        </form>
    </div>
</div>
</body>
</html>