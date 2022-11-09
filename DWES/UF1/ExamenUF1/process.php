<?php 
    /**
     * Llegeix les dades del fitxer. Si el document no existeix 
     * o està buit (ho comprovem mitjançant la mida del fitxer)
     * torna un array buit.
     *
     * @param string $file
     * @return array
     */
    function llegeix(string $file) : array
    {
        if (file_exists($file) && filesize($file) > 0) {
            $var = json_decode(file_get_contents($file), true);
        } 
        else {
            $var = array();
        }
        return $var;
    }

    /**
     * Guarda les dades a un fitxer
     *
     * @param array $dades
     * @param string $file
     */
    function escriu(array $dades, string $file): void
    {
        file_put_contents($file,json_encode($dades, JSON_PRETTY_PRINT));
    }

    /**
     * Funció per sumar el contingut de l'array
     * amb les dades entrades tenint el correu 
     * com a clau
     * 
     * @param array $array
     * @param string $clau
     * @param array $valor
     */
    function afegirClauIValors(array $array, string $clau, array $valor): array {

        $array[$clau] = $valor;

        return $array;
    }

    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['method'])) {
            
            $fitxerJSONUsuaris = "users.json";
            $dadesUsuaris = llegeix($fitxerJSONUsuaris);

            $fitxerJSONConnexions = "connexions.json";
            $dadesConnexions = llegeix($fitxerJSONConnexions);

            // Condicional per quan fem una creacio
            if ($_POST['method'] == 'signup' 
                && isset($_POST['nom']) 
                && isset($_POST['correu']) 
                && isset($_POST['contrasenya'])) {
                
                
                // Guardem les dades introduides a la sessio
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['correu'] = $_POST['correu'];
                $_SESSION['contrasenya'] = $_POST['contrasenya'];

                $nom = $_SESSION['nom'];
                $correu = $_SESSION['correu'];
                $contrasenya = $_SESSION['contrasenya'];
                $post = ["correu" => $correu, "contrasenya" => $contrasenya, "nom" => $nom];

                // Mitjancant la clau (que és el correu), mirem si aquest usuari ja existeix. 
                if (array_key_exists($correu, $dadesUsuaris)) {
                    /**
                     * Afegim les dades de les connexions al fitxer JSON
                     * en aquest i els següents condicionals
                     */
                    $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "creacio_fallida_usuari_existent"];
                    array_push($dadesConnexions, $registreConnexio);
                    escriu($dadesConnexions, $fitxerJSONConnexions);

                    header('Location: index.php?error=creacio_fallida_usuari_existent', true, 303);
                } 

                // En cas de que faltin valors per escriure
                elseif ($nom == null && $correu == null && $contrasenya == null) {
                    $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "creacio_fallida"];
                    array_push($dadesConnexions, $registreConnexio);
                    escriu($dadesConnexions, $fitxerJSONConnexions);

                    header('Location: index.php?error=creacio_fallida', true, 303);
                }
                elseif ($nom == null) {
                    $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "creacio_fallida_nom_incorrecte"];
                    array_push($dadesConnexions, $registreConnexio);
                    escriu($dadesConnexions, $fitxerJSONConnexions);

                    header('Location: index.php?error=creacio_fallida_nom_incorrecte', true, 303);
                }
                elseif ($correu == null) {
                    $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "creacio_fallida_correu_incorrecte"];
                    array_push($dadesConnexions, $registreConnexio);
                    escriu($dadesConnexions, $fitxerJSONConnexions);

                    header('Location: index.php?error=creacio_fallida_correu_incorrecte', true, 303);
                }
                elseif ($contrasenya == null) {
                    $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "creacio_fallida_contrasenya_incorrecte"];
                    array_push($dadesConnexions, $registreConnexio);
                    escriu($dadesConnexions, $fitxerJSONConnexions);

                    header('Location: index.php?error=creacio_fallida_contrasenya_incorrecte', true, 303);
                }
                
                // En cas de que tot estigui correcte
                else {
                    $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "signup_correcte"];
                    array_push($dadesConnexions, $registreConnexio);
                    escriu($dadesConnexions, $fitxerJSONConnexions);

                    /**
                     * Fusionem les dades que hem inserit amb les que
                     * ja hi havien abans al fitxer JSON, tenint en 
                     * compte el correu com a clau
                     */
                    $dadesUsuaris = afegirClauIValors($dadesUsuaris,$correu,$post);
                    escriu($dadesUsuaris, $fitxerJSONUsuaris);

                    /**
                     * Si es fa l'autentificacio correcta, iniciem la variable
                     * per obtenir el moment en que s'ha realitzat
                     */ 
                    $_SESSION['dataAutentificacio'] = time();
                    
                    header('Location: hola.php', true, 302);
                }
                    
            }

            // Condicional per quan iniciem sessio
            elseif ($_POST['method'] == 'signin' && 
                    isset($_POST['correu']) 
                    && isset($_POST['contrasenya'])) {
                
                    $_SESSION['correu'] = $_POST['correu'];
                    $_SESSION['contrasenya'] = $_POST['contrasenya'];
                    
                    $correu = $_SESSION['correu'];
                    $contrasenya = $_SESSION['contrasenya'];

                    // Condicionals per quan falten dades a inserir
                    if ($correu == null) {
                        $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "signin_correu_incorrecte"];
                        array_push($dadesConnexions, $registreConnexio);
                        escriu($dadesConnexions, $fitxerJSONConnexions);

                        header('Location: index.php?error=signin_correu_incorrecte', true, 303);

                    } elseif ($contrasenya == null) {
                        $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "signin_contrasenya_incorrecte"];
                        array_push($dadesConnexions, $registreConnexio);
                        escriu($dadesConnexions, $fitxerJSONConnexions);

                        header('Location: index.php?error=signin_contrasenya_incorrecte', true, 303);
                    }

                    /**
                     * Perque un usuari sigui valid, ens hem d'assegurar que 
                     * tant el nom d'usuari com la contrasenya existeixen
                     */ 
                    elseif (array_key_exists($correu, $dadesUsuaris) && $dadesUsuaris[$correu]["contrasenya"] == $contrasenya) {
                        $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "signin_correcte"];
                        array_push($dadesConnexions, $registreConnexio);
                        escriu($dadesConnexions, $fitxerJSONConnexions);

                        /**
                         * Al igual que el signup, obtenim el moment 
                         * de l'autentificacio quan és correcta
                         */ 
                        $_SESSION['dataAutentificacio'] = time();

                        header('Location: hola.php', true, 302);
                    } 

                    // Condicional per quan intentes inserir un usuari que no existeix
                    else {
                        $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "signin_usuari_inexistent"];
                        array_push($dadesConnexions, $registreConnexio);
                        escriu($dadesConnexions, $fitxerJSONConnexions);

                        header('Location: index.php?error=signin_usuari_inexistent', true, 303);
                    }
        
            }

            /**
             * Com que no hem de mantenir l'autentificació activa,
             * eliminem la sessio perquè no es permeti tornar a 
             * accedir a hola.php
             */
            elseif ($_POST['method'] == 'logoff' && (isset($_SESSION['correu']))) {
                $fitxerJSONConnexions = "connexions.json";
                $dadesConnexions = llegeix($fitxerJSONConnexions);
                $correu = $_SESSION['correu'];


                $registreConnexio = ["ip" => $_SERVER["REMOTE_ADDR"], "user" => $correu, "time" => date("Y-m-d H:i:s"), "status" => "logoff"];
                array_push($dadesConnexions, $registreConnexio);
                escriu($dadesConnexions, $fitxerJSONConnexions);

                $_SESSION['correu'] = null;
                $_SESSION['dataAutentificacio'] = null;
                header('Location: index.php', true, 302);
            }
        }  
    }
    
?>