<?php 
    require_once "./classes/User.php";
    require_once "./classes/Fase.php";
    require_once "./classes/Gos.php";

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

            $es_ok_sign_up = isset($_POST['nom']) 
                            && isset($_POST['contrasenya']);

            /**
             * En cas de que es vulgui crear un usuari
             */
            if ($_POST['method'] == 'signup') {
                if ($es_ok_sign_up) {
                    
                    if ($_POST['nom'] != null && $_POST['contrasenya'] != null) {

                        $_SESSION['nom'] = $_POST['nom'];
                        $_SESSION['contrasenya'] = $_POST['contrasenya'];
                        
                        $usuari = new User($_POST['nom'],$_POST['contrasenya']);
                        
                        $sql="select * from usuaris where nom = ?";
                        $query = $pdo->prepare($sql);
                        $query->execute(array($usuari->getNom()));
                        
                        $fila = $query->rowCount();

                        if ($fila == 1) {
                            header('Location: admin.php?error=existing_user', true, 303);
                        } 
                        else if ($fila == 0) {
                            $sql="insert into usuaris values (?,md5(?))";
                            $query = $pdo->prepare($sql);
                            $query->execute(array($usuari->getNom(),$usuari->getContrasenya()));
                            header("Location: admin.php", true, 302);
                        }

                    } else {
                        header('Location: admin.php?error=incomplete_data', true, 303);
                    }
                }   
            }

            /**
             * En cas de que es vulgui canviar la data de les fases
             */
            if ($_POST['method'] == "changeDate") {
                $es_ok = isset($_POST['dataInici']) 
                        && isset($_POST['dataFi'])
                        && isset($_POST['numFase']);

                if ($es_ok) {
                    $_SESSION['numFase'] = $_POST['numFase'];
                    $_SESSION['dataInici'] = $_POST['dataInici'];
                    $_SESSION['dataFi'] = $_POST['dataFi'];

                    $fase = new Fase($_POST['numFase'], $_POST['dataInici'], $_POST['dataFi']);

                    if ($_SESSION['numFase'] < 1 || $_SESSION['numFase'] > 8) {
                        header('Location: admin.php?error=invalid_phase_num', true, 303);
                    } else {
                        $sql="update fases set dataInici=?, dataFinal=? where id=?;";
                        $query = $pdo->prepare($sql);
                        $query->execute(array($fase->getDataInici(),$fase->getDataFinal(),$fase->getNumFase()));

                        header("Location: admin.php", true, 302);
                    }
                }
            }

            $es_ok_dog = isset($_POST['nomGos']) 
                        && isset($_POST['imatgeGos'])
                        && isset($_POST['amoGos'])
                        && isset($_POST['racaGos']);

            /**
             * En cas de que es vulgui modificar un gos
             */
            if ($_POST['method'] == "changeDog") {
                if ($es_ok_dog) {

                    $_SESSION['nomGos'] = $_POST['nomGos'];
                    $_SESSION['imatgeGos'] = $_POST['imatgeGos'];
                    $_SESSION['amoGos'] = $_POST['amoGos'];
                    $_SESSION['racaGos'] = $_POST['racaGos'];

                    if ($_POST['nomGos'] == null || $_POST['imatgeGos'] == null
                        || $_POST['amoGos'] == null || $_POST['racaGos'] == null) {

                        header('Location: admin.php?error=incomplete_data', true, 303);
                    
                    } else {
                        $gos = new Gos($_SESSION['nomGos'], $_SESSION['imatgeGos'], $_SESSION['amoGos'], $_SESSION['racaGos'], 0);

                        $sql="select * from gossos where nom=?;";
                        $query = $pdo->prepare($sql);
                        $query->execute(array($gos->getNom()));
                        $fila = $query->rowCount();

                        if ($fila == 0) {
                            header('Location: admin.php?error=no_existing_dog', true, 303);
                        } else {
                            $sql="update gossos set nom=?, imatge=?, amo=?, raca=? where nom=?;";
                            $query = $pdo->prepare($sql);
                            $query->execute(array($gos->getNom(),$gos->getImatge(),$gos->getAmo(),$gos->getRaca(),$gos->getNom()));
                            header("Location: admin.php", true, 302);
                        }
        
                    }
                    
                }
            }
            
            /**
             * En cas de que es vulgui crear un gos
             */
            if ($_POST['method'] == "addDog") {
                if ($es_ok_dog) {
                    $_SESSION['nomGos'] = $_POST['nomGos'];
                    $_SESSION['imatgeGos'] = $_POST['imatgeGos'];
                    $_SESSION['amoGos'] = $_POST['amoGos'];
                    $_SESSION['racaGos'] = $_POST['racaGos'];

                    $gos = new Gos($_SESSION['nomGos'], $_SESSION['imatgeGos'], $_SESSION['amoGos'], $_SESSION['racaGos'], 0);
                    
                    if ($gos->getNom() == null || $gos->getImatge() == null
                    || $gos->getAmo() == null || $gos->getRaca() == null) {
                        header('Location: admin.php?error=incomplete_data', true, 303);
                    } else {

                        $sql="select * from gossos where nom=?;";
                        $query = $pdo->prepare($sql);
                        $query->execute(array($gos->getNom()));
                        $fila = $query->rowCount();

                        if ($fila == 1) {
                            header('Location: admin.php?error=existing_dog', true, 303);
                        } else {
                            $sql="insert into gossos (nom, imatge, amo, raca, vots) VALUES (?, ?, ?, ?, ?);";
                            $query = $pdo->prepare($sql);
                            $query->execute(array($gos->getNom(),$gos->getImatge(),$gos->getAmo(),$gos->getRaca(),$gos->getPunts()));
                            header("Location: admin.php", true, 302);
                        }
                    }
                }
            }
        }
    }
?>