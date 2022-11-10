<?php 

    /*function llegeix(string $file) : array
    {
        if (file_exists($file) && filesize($file) > 0) {
            $var = json_decode(file_get_contents($file), true);
        } 
        else {
            $var = array();
        }
        return $var;
    }

    function escriu(array $dades, string $file): void
    {
        file_put_contents($file,json_encode($dades, JSON_PRETTY_PRINT));
    }

    function afegirClauIValors(array $array, string $clau, array $valor): array {

        $array[$clau] = $valor;

        return $array;
    }*/

//--------------------------------------------------------------------------------------------------------------------
    $msg = "";
    if (isset($_COOKIE['msg'])) {
        $msg=$_COOKIE['msg'];
        setcookie("msg", null,-1 );
    }
//--------------------------------------------------------------------------------------------------------------------

    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['method'])) {
            
            // Accedim a la base de dades
            try {
                $hostname = "localhost";
                $dbname = "dwes_janestrada_autpdo";
                //$username = "dwes_user";
                $username = "dwes_user";
                $pw = "dwes_pass";
                /*$username = "acces_dades";
                $pw = "patata";*/
                $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");

            } catch (PDOException $e) {
                echo "Problemes per gestionar la base de dades: " . $e->getMessage() . "\n";
                exit;
            }

//-----------------------------------------------------------------------------------------------
            /*$fitxerJSONUsuaris = "users.json";
            $dadesUsuaris = llegeix($fitxerJSONUsuaris);

            $fitxerJSONConnexions = "connexions.json";
            $dadesConnexions = llegeix($fitxerJSONConnexions);*/
//-----------------------------------------------------------------------------------------------
            $es_ok_sign_up = $_POST['method'] == 'signup' 
                    && isset($_POST['nom']) 
                    && isset($_POST['correu']) 
                    && isset($_POST['contrasenya'])
                    /*&& strlen($_POST['nom']) >= 10
                    && strlen($_POST['nom']) <= 15
                    && strlen($_POST['contrasenya']) >= 5
                    && strlen($_POST['contrasenya']) <= 15*/;
                  
            

            // Condicional per quan fem una creacio
            if ($es_ok_sign_up) {
                // Guardem les dades introduides a la sessio
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['correu'] = $_POST['correu'];
                $_SESSION['contrasenya'] = $_POST['contrasenya'];

                $sql="select count(*) as n from usuaris where correu = ?";

                $query = $pdo->prepare($sql);
                $query->execute( array( $_SESSION['correu'] ) );
                //control d'errors
                $e= $query->errorInfo();
                if ($e[0]!='00000') {
                    echo "\nPDO::errorInfo():\n";
                    die("Error accedint a dades: " . $e[2]);
                }

                $resultat= $query->fetch();
                $es_ok_sign_up = ($resultat['n'] == 0 );
            }

            $nom = $_SESSION['nom'];
            $correu = $_SESSION['correu'];
            $contrasenya = $_SESSION['contrasenya'];
            $post = ["correu" => $correu, "contrasenya" => $contrasenya, "nom" => $nom];
            

            if ($es_ok_sign_up) {
                $sql="insert into usuaris values (?,md5(?), ?)";
                $query = $pdo->prepare($sql);
                $query->execute( array( $correu,$contrasenya, $nom ) );

                $sqlConnexions="insert into connexions values (?,?,?,?)";
                $query = $pdo->prepare($sqlConnexions);
                $query->execute( array( $_SERVER["REMOTE_ADDR"], date("Y-m-d H:i:s"), $correu, "signup_correcte") );


                $e= $query->errorInfo();
                if ($e[0]!='00000') {
                echo "\nPDO::errorInfo():\n";
                die("Error accedint a dades: " . $e[2]);
                }

                $_SESSION['dataAutentificacio'] = time();

                setcookie("msg", "Usuari [$correu] insertat correctament." );
                //die( header('Location: ./insert.php'));
                die( header('Location: hola.php'));
            }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------

            

            // Mitjancant la clau (que és el correu), mirem si aquest usuari ja existeix. 
            //if (array_key_exists($correu, $dadesUsuaris)) {
                /**
                 * Afegim les dades de les connexions al fitxer JSON
                 * en aquest i els següents condicionals
                 */

/*
                header('Location: index.php?error=creacio_fallida_usuari_existent', true, 303);
            }*/

            // En cas de que faltin valors per escriure
            elseif ($nom == null && $correu == null && $contrasenya == null) {
                $sqlConnexions="insert into connexions values (?,?,?,?)";
                $query = $pdo->prepare($sqlConnexions);
                $query->execute( array( $_SERVER["REMOTE_ADDR"], date("Y-m-d H:i:s"), $correu, "creacio_fallida") );

                header('Location: index.php?error=creacio_fallida', true, 303);
            }
            elseif ($nom == null) {
                $sqlConnexions="insert into connexions values (?,?,?,?)";
                $query = $pdo->prepare($sqlConnexions);
                $query->execute( array( $_SERVER["REMOTE_ADDR"], date("Y-m-d H:i:s"), $correu, "creacio_fallida_nom_incorrecte") );

                header('Location: index.php?error=creacio_fallida_nom_incorrecte', true, 303);
            }
            elseif ($correu == null) {
                $sqlConnexions="insert into connexions values (?,?,?,?)";
                $query = $pdo->prepare($sqlConnexions);
                $query->execute( array( $_SERVER["REMOTE_ADDR"], date("Y-m-d H:i:s"), $correu, "creacio_fallida_correu_incorrecte") );

                header('Location: index.php?error=creacio_fallida_correu_incorrecte', true, 303);
            }
            elseif ($contrasenya == null) {
                $sqlConnexions="insert into connexions values (?,?,?,?)";
                $query = $pdo->prepare($sqlConnexions);
                $query->execute( array( $_SERVER["REMOTE_ADDR"], date("Y-m-d H:i:s"), $correu, "creacio_fallida_contrasenya_incorrecte") );

                header('Location: index.php?error=creacio_fallida_contrasenya_incorrecte', true, 303);
            }
            
            // En cas de que tot estigui correcte
           // else {
                /**
                 * Si es fa l'autentificacio correcta, iniciem la variable
                 * per obtenir el moment en que s'ha realitzat
                 */ 
                /*$_SESSION['dataAutentificacio'] = time();
                
                header('Location: hola.php', true, 302);
            }*/
                    
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------

            $es_ok_sign_in = $_POST['method'] == 'signup' 
            && isset($_POST['nom']) 
            && isset($_POST['correu']);

            // Condicional per quan iniciem sessio
            if ($_POST['method'] == 'signin' && 
                isset($_POST['correu']) 
                && isset($_POST['contrasenya'])) {
                    //prepare("INSERT INTO test (date1) VALUES (STR_TO_DATE(?,'%d-%m-%y'));");
                    
                    $_SESSION['correu'] = $_POST['correu'];
                    $_SESSION['contrasenya'] = $_POST['contrasenya'];
                    
                    $correu = $_SESSION['correu'];
                    $contrasenya = $_SESSION['contrasenya'];

                    // Condicionals per quan falten dades a inserir
                    if ($correu == null) {
                        header('Location: index.php?error=signin_correu_incorrecte', true, 303);

                    } elseif ($contrasenya == null) {
                        header('Location: index.php?error=signin_contrasenya_incorrecte', true, 303);
                    }

                    /**
                     * Perque un usuari sigui valid, ens hem d'assegurar que 
                     * tant el nom d'usuari com la contrasenya existeixen
                     */ 
                    //elseif (array_key_exists($correu, $dadesUsuaris) && $dadesUsuaris[$correu]["contrasenya"] == $contrasenya) {
                        
                        elseif (array_key_exists($correu, $dadesUsuaris) && $dadesUsuaris[$correu]["contrasenya"] == $contrasenya) {
                        /**
                         * Al igual que el signup, obtenim el moment 
                         * de l'autentificacio quan és correcta
                         */ 
                        $_SESSION['dataAutentificacio'] = time();

                        header('Location: hola.php', true, 302);
                    } 

                    // Condicional per quan intentes inserir un usuari que no existeix
                    else {
                        header('Location: index.php?error=signin_usuari_inexistent', true, 303);
                    }
        
            }

            /**
             * Com que no hem de mantenir l'autentificació activa,
             * eliminem la sessio perquè no es permeti tornar a 
             * accedir a hola.php
             */
            /*elseif ($_POST['method'] == 'logoff' && (isset($_SESSION['correu']))) {
                $_SESSION['correu'] = null;
                $_SESSION['dataAutentificacio'] = null;
                header('Location: index.php', true, 302);
            }*/
        }  
    }
    
?>