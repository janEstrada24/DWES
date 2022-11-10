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
        $fitxerJSONUsuaris = "users.json";
        $dadesUsuaris = llegeix($fitxerJSONUsuaris);

        return $dadesUsuaris[obtenirCorreu()]['nom'];
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
        $resultat = "";

        $correu = obtenirCorreu();

        $fitxerJSONConnexions = "connexions.json";
        $dadesConnexions = llegeix($fitxerJSONConnexions);

        /**
         * Dins del bucle, agafem els accessos d'un usuari en concret
         * i després mirem que sigui el missatge d'un accés correcte
         */
        for ($i = 0; $i < count($dadesConnexions); $i++) {
            if ($dadesConnexions[$i]['user'] == $correu) {
                if ($dadesConnexions[$i]['status'] == "signup_correcte"
                || $dadesConnexions[$i]['status'] == "signin_correcte") {
                    $resultat .= "Connexió des de " . $dadesConnexions[$i]['ip'] . " amb data " . $dadesConnexions[$i]['time'] . "<br>";
                }
            }
        }
        return $resultat;
    }

    /**
     * Llegeix les dades del fitxer. Si el document no existeix torna un array buit.
     *
     * @param string $file
     * @return array
     */
    function llegeix(string $file) : array
    {
        // Obtenim el codi del fitxer
        if (file_exists($file) && filesize($file) > 0) {
            $var = json_decode(file_get_contents($file), true);
        } 
        /**
         * En cas de que el fitxer estigui buit o no hi hagin registres
         * (ho comprovem mitjancant la mida del fitxer), l'iniciarem 
         * com a un array
         */ 
        elseif(file_exists($file) && filesize($file) == 0) {
            $var = array();
        }
        return $var;
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