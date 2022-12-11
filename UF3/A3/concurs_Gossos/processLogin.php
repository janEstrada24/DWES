<?php 
    require_once "./classes/User.php";

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['method'])) {
            
            try {
                $hostname = "localhost";
                $dbname = "dwes_janestrada_concurs_gossos";
                $username = "dwes_user";
                $pw = "dwes_pass";
                $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
            } catch (PDOException $e) {
                echo "Problemes per gestionar la base de dades: " . $e->getMessage() . "\n";
                exit;
            }

            /**
             * En cas de que es vulgui iniciar sessio
             */
            if ($_POST['method'] == "signin") {

                $es_ok = isset($_POST['nom']) 
                        && isset($_POST['contrasenya']);

                if ($es_ok) {
                    $usuari = new User($_POST['nom'], $_POST['contrasenya']);

                    $sql="select * from usuaris where nom = ? AND contrasenya = md5(?)";
                    $query = $pdo->prepare($sql);
                    $query->execute(array($usuari->getNom(), $usuari->getContrasenya()));
                    $fila = $query->rowCount();
                    
                    
                    if ($usuari->getNom() == null) {
                        header('Location: login.php?error=incorrect_name', true, 303);
                    }
                    else if ($usuari->getContrasenya() == null) {                        
                        header('Location: login.php?error=incorrect_password', true, 303);
                    } 
                    elseif ($fila == 0) {
                        header('Location: login.php?error=no_existing_user', true, 303);
                    }
                    else {
                        /**
                         * Fem que es crei la sessio
                         * si el login es correcte
                         */
                        $_SESSION['nom'] = $_POST['nom'];
                        $_SESSION['contrasenya'] = $_POST['contrasenya'];
                    
                        header('Location: admin.php', true, 302);
                    } 
                }
            }

            /**
             * En cas de que es tanqui la sessio
             */
            if ($_POST['method'] == "logoff" && isset($_SESSION['nom']) && isset($_SESSION['contrasenya'])) {
                
                /**
                 * Ens carreguem el nom i la contrasenya
                 * enviats a la sessio
                 */
                $_SESSION['nom'] = null;
                $_SESSION['contrasenya'] = null;
                header('Location: index.php', true, 302);
            }
            
        }

    }
?>