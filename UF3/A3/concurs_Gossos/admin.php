<?php 
    require_once "./classes/Fase.php";
    require_once "./classes/Gos.php";
    
    session_start();
    
    /**
     * Si no existeix una sessio, fem que hagi de fer el login
     */
    if (!isset($_SESSION["nom"])) {
        header("Location: login.php", true, 302);
    }

    /**
     * Segons quin sigui l'error, mostrarem 
     * un missatge diferent
     */
    function mostrarError():string {
        if(isset($_GET["error"])) {
            $msg = match ($_GET['error']) {

                "existing_user" => 'Usuari ja existent',
                "incorrect_name" => 'Nom incorrecte',
                "incorrect_password" => 'Contrasenya incorrecte',
                "incomplete_data" => 'Dades incompletes',
                "invalid_phase_num" => 'Número de fase no vàlid',
                "no_existing_dog" => 'Gos no existent',
                "existing_dog" => 'Gos existent',

                default => 'S\'ha produït un error inesperat',
            };

            if ($msg) {
                return $msg;
            }
            
        } else {
            return "";
        }
    }

    /**
     * Recollim les dades de les fases i 
     * les afegim directament a la pagina
     */
    function mostrarFases():string {
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

        $sql="select * from fases";
        $query = $pdo->prepare($sql);
        $query->execute();
                
        $resultat = "";
        
        while ($registre = $query->fetch()) {
            $fila = new Fase($registre['id'], $registre['dataInici'], $registre['dataFinal']);
            
            $resultat .= '<form class="fase-row" action="processAdmin.php" method="post">
                            Fase <input type="number" name="numFase" value="' . $fila->getNumFase() . '" style="width: 3em">
                            del <input type="date" value="' . $fila->getDataInici() . '" name="dataInici" placeholder="Inici">
                            al <input type="date" value="' . $fila->getDataFinal() . '" name="dataFi" placeholder="Fi">
                            <input type="hidden" name="method" value="changeDate"/>
                            <button type="submit">Modifica</button>
                        </form>';
        }

        return $resultat;   
    }

    /**
     * Fem el mateix que la funcio anterior
     * pero amb els gossos concursants
     */
    function mostrarConcursants():string {
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

        $sql="select * from gossos";
        $query = $pdo->prepare($sql);
        $query->execute();
                
        $resultat = "";
        
        while ($registre = $query->fetch()) {
            $gos = new Gos($registre['nom'], $registre['imatge'], $registre['amo'], $registre['raca'], $registre['vots']);

            $resultat .= '<form action="processAdmin.php" method="post">
                            <input type="text" name="nomGos" placeholder="Nom" value="' . $gos->getNom() . '">
                            <input type="text" name="imatgeGos" placeholder="Amo" value="' . $gos->getImatge() . '">
                            <input type="text" name="amoGos" placeholder="Imatge" value="' . $gos->getAmo() . '">
                            <input type="text" name="racaGos" placeholder="Raça" value="' . $gos->getRaca() . '">
                            <input type="hidden" name="method" value="changeDog"/>
                            <button type="submit">Modifica</button>
                        </form>';
        }

        return $resultat;   
    }
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - Concurs Internacional de Gossos d'Atura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper medium">
        <header>ADMINISTRADOR - Concurs Internacional de Gossos d'Atura</header>
        <div class="admin">
            <div class="admin-row">
                <h1> Resultat parcial: Fase 1 </h1>
                <div class="gossos">
                <img class="dog" alt="Musclo" title="Musclo 15%" src="img/g1.png">
                <img class="dog" alt="Jingo" title="Jingo 45%" src="img/g2.png">
                <img class="dog" alt="Xuia" title="Xuia 4%" src="img/g3.png">
                <img class="dog" alt="Bruc" title="Bruc 3%" src="img/g4.png">
                <img class="dog" alt="Mango" title="Mango 13%" src="img/g5.png">
                <img class="dog" alt="Fluski" title="Fluski 12 %" src="img/g6.png">
                <img class="dog" alt="Fonoll" title="Fonoll 5%" src="img/g7.png">
                <img class="dog" alt="Swing" title="Swing 2%" src="img/g8.png">
                <img class="dog eliminat" alt="Coloma" title="Coloma 1%" src="img/g9.png"></div>
            </div>
            <div class="admin-row">
                <h1 style="color: red;">
                    <?php 
                        echo mostrarError();
                    ?>
                </h1>
                <h1> Nou usuari: </h1>
                <form action="processAdmin.php" method="post">
                    <input type="text" name="nom" placeholder="Nom">
                    <input type="password" name="contrasenya" placeholder="Contrassenya">
                    <input type="hidden" name="method" value="signup"/>
                    <button type="submit">Crea usuari</button>
                </form>
            </div>
            <div class="admin-row">
                <h1> Fases: </h1>
                <?php 
                    echo mostrarFases();
                ?>
            </div>

            <div class="admin-row">
                <h1> Concursants: </h1>
                <?php 
                    echo mostrarConcursants();
                ?>
                <form action="processAdmin.php" method="post">
                    <input type="text" name="nomGos" placeholder="Nom">
                    <input type="text" name="imatgeGos" placeholder="Amo">
                    <input type="text" name="amoGos" placeholder="Imatge">
                    <input type="text" name="racaGos" placeholder="Raça">
                    <input type="hidden" name="method" value="addDog"/>
                    <button type="submit">Afegeix</button>
                </form>
            </div>

            <div class="admin-row">
                <h1> Altres operacions: </h1>
                <form>
                    Esborra els vots de la fase
                    <input type="number" placeholder="Fase" value="">
                    <input type="button" value="Esborra">
                </form>
                <form>
                    Esborra tots els vots
                    <input type="button" value="Esborra">
                </form>

                <form action="processLogin.php" method="post">
                    <input type="hidden" name="method" value="logoff"/>
                    <button type="submit">Tancar sessió</button>
                </form>            
            </div>
        </div>
    </div>

</body>
</html>