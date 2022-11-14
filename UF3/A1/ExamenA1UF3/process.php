<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['method'])) {
            
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
            
            $es_ok_sign_up = isset($_POST['nom']) 
                            && isset($_POST['correu']) 
                            && isset($_POST['contrasenya']);
        
            if ($_POST['method'] == 'signup' ) {
                    
                // Condicional per quan fem una creacio
                if ($es_ok_sign_up) {
                    // Guardem les dades introduides a la sessio
                    $_SESSION['nom'] = $_POST['nom'];
                    $_SESSION['correu'] = $_POST['correu'];
                    $_SESSION['contrasenya'] = $_POST['contrasenya'];

                    $sql="select count(*) as n from usuaris where correu = ?";
                    $query = $pdo->prepare($sql);
                    $query->execute(array( $_SESSION['correu'] ));

                    $numeroFiles = 0;
                    $numeroFiles = $query->rowCount();

                    $nom = $_SESSION['nom'];
                    $correu = $_SESSION['correu'];
                    $contrasenya = $_SESSION['contrasenya'];

                    $e= $query->errorInfo();
                    if ($e[0]!='00000') {
                        echo "\nPDO::errorInfo():\n";
                        die("Error accedint a dades: " . $e[2]);
                    }
                    $resultat= $query->fetch();
                    $es_ok_sign_up = ($resultat['n'] == 0 );
                }
                      

                // En cas de que faltin valors per escriure
                if($_SESSION['nom'] == null && $_SESSION['correu'] == null && $_SESSION['contrasenya'] == null ) {
                    $sqlConnexions="insert into connexions values (?,?,?,?)";
                    $query = $pdo->prepare($sqlConnexions);
                    $query->execute( array( $_SERVER["REMOTE_ADDR"], $_SESSION['correu'], date("Y-m-d H:i:s"), "creacio_fallida") );

                    header('Location: index.php?error=creacio_fallida', true, 303);
                }
                elseif ($_SESSION['nom'] == null) {
                    $sqlConnexions="insert into connexions values (?,?,?,?)";
                    $query = $pdo->prepare($sqlConnexions);
                    $query->execute( array( $_SERVER["REMOTE_ADDR"], $_SESSION['correu'], date("Y-m-d H:i:s"), "creacio_fallida_nom_incorrecte") );

                    header('Location: index.php?error=creacio_fallida_nom_incorrecte', true, 303);
                }
                elseif ($_SESSION['correu'] == null || !str_contains($_SESSION['correu'], "@")) {
                    $sqlConnexions="insert into connexions values (?,?,?,?)";
                    $query = $pdo->prepare($sqlConnexions);
                    $query->execute( array( $_SERVER["REMOTE_ADDR"], $_SESSION['correu'], date("Y-m-d H:i:s"), "creacio_fallida_correu_incorrecte") );

                    header('Location: index.php?error=creacio_fallida_correu_incorrecte', true, 303);
                }
                elseif ($_SESSION['contrasenya'] == null) {
                    $sqlConnexions="insert into connexions values (?,?,?,?)";
                    $query = $pdo->prepare($sqlConnexions);
                    $query->execute( array( $_SERVER["REMOTE_ADDR"], $_SESSION['correu'], date("Y-m-d H:i:s"), "creacio_fallida_contrasenya_incorrecte") );

                    header('Location: index.php?error=creacio_fallida_contrasenya_incorrecte', true, 303);
                } 

                // En cas de que sigui correcte i contingui el simbol del correu
                elseif ($es_ok_sign_up && str_contains($_SESSION['correu'], "@")) {
                        
                        $sql="insert into usuaris values (?,md5(?),?)";
                        $query = $pdo->prepare($sql);
                        $query->execute(array($correu,$contrasenya, $nom));

                        // En aquest i els seguents condicionals insertem les dades de les connexions
                        $sqlConnexions="insert into connexions values (?,?,?,?)";
                        $query = $pdo->prepare($sqlConnexions);
                        $query->execute( array( $_SERVER["REMOTE_ADDR"], $correu, date("Y-m-d H:i:s"), "signup_correcte") );


                        $_SESSION['dataAutentificacio'] = time();

                        setcookie("msg", "Usuari [$correu] insertat correctament." );
                        die( header('Location: hola.php'));
                        

                }
                // Quan intentem crear un usuari que ja existeix
                elseif (!$es_ok_sign_up) {
                    $sqlConnexions="insert into connexions values (?,?,?,?)";
                    $query = $pdo->prepare($sqlConnexions);
                    $query->execute( array( $_SERVER["REMOTE_ADDR"], $_SESSION['correu'], date("Y-m-d H:i:s"), "creacio_fallida_usuari_existent") );
                    header('Location: index.php?error=creacio_fallida_usuari_existent', true, 303);
                }
            }
                    

            elseif ($_POST['method'] == 'signin') {

                $es_ok_sign_in = isset($_POST['correu']) 
                                 && isset($_POST['contrasenya']);

                     
                // Condicional per quan iniciem sessio
                if ($es_ok_sign_in) {
            
                    $_SESSION['correu'] = $_POST['correu'];
                    $_SESSION['contrasenya'] = $_POST['contrasenya'];
                    
                    $correu = $_SESSION['correu'];
                    $contrasenya = $_SESSION['contrasenya'];
                    

                    $sql="select * from usuaris where correu = ? AND contrasenya = md5(?) ";
                    
                    // comparem el correu i les contrasenyes tenint-les ja encriptades
                    $query = $pdo->prepare($sql);
                    
                    $query->execute(array($correu, $contrasenya));
                    
                    // Comptem si hem obtingut una fila que verifica si existeix l'usuari o no
                    $fila = $query->rowCount();

                    if ($fila == 1 && $correu != null && $contrasenya != null) {
                        /**
                         * Al igual que el signup, obtenim el moment 
                         * de l'autentificacio quan és correcte
                         */ 
                        $_SESSION['dataAutentificacio'] = time();

                        $sqlConnexions="insert into connexions values (?,?,?,?)";
                        $query = $pdo->prepare($sqlConnexions);
                        $query->execute( array( $_SERVER["REMOTE_ADDR"], $correu, date("Y-m-d H:i:s"), "signin_correcte") );

                        header('Location: hola.php', true, 302);
                    }
                    
                    // Condicionals per quan falten dades a inserir
                    elseif ($_SESSION['correu'] == null) {
                        $sqlConnexions="insert into connexions values (?,?,?,?)";
                        $query = $pdo->prepare($sqlConnexions);
                        $query->execute( array( $_SERVER["REMOTE_ADDR"], $correu, date("Y-m-d H:i:s"), "signin_correu_incorrecte") );
                        
                        header('Location: index.php?error=signin_correu_incorrecte', true, 303);

                    } elseif ($_SESSION['contrasenya'] == null) {
                        $sqlConnexions="insert into connexions values (?,?,?,?)";
                        $query = $pdo->prepare($sqlConnexions);
                        $query->execute( array( $_SERVER["REMOTE_ADDR"], $correu, date("Y-m-d H:i:s"), "signin_contrasenya_incorrecte") );

                        header('Location: index.php?error=signin_contrasenya_incorrecte', true, 303);
                    }
                    // Condicional per quan intentes inserir un usuari que no existeix
                    elseif ($fila == 0) {
                        $sqlConnexions="insert into connexions values (?,?,?,?)";
                        $query = $pdo->prepare($sqlConnexions);
                        $query->execute( array( $_SERVER["REMOTE_ADDR"], $correu, date("Y-m-d H:i:s"), "signin_usuari_inexistent") );
                        
                        header('Location: index.php?error=signin_usuari_inexistent', true, 303);
                    } 

                }

            }
                
        
            /**
             * Com que no hem de mantenir l'autentificació activa,
             * eliminem la sessio perquè no es permeti tornar a 
             * accedir a hola.php
             */
            elseif ($_POST['method'] == 'logoff' && isset($_SESSION['correu'])) {
                $sqlConnexions="insert into connexions values (?,?,?,?)";
                $query = $pdo->prepare($sqlConnexions);
                $query->execute( array( $_SERVER["REMOTE_ADDR"], $_SESSION['correu'], date("Y-m-d H:i:s"), "logoff") );

                $_SESSION['correu'] = null;
                $_SESSION['dataAutentificacio'] = null;
                header('Location: index.php', true, 302);
            }
            
            //eliminem els objectes per alliberar memòria 
            unset($pdo);
            unset($query);
        }  
    }
    
?>