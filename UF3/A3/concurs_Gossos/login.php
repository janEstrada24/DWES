<?php 
    session_start();
    
    /**
     * Si existeix una sessio, fem que directament vagi
     * a la pagina d'administracio
     */
    if (isset($_SESSION["nom"])) {
        header("Location: admin.php", true, 302);
    }

    /**
     * Segons quin error hi hagi durant el login,
     * mostrarem un missatge diferent
     */
    function mostrarError():string {
        if(isset($_GET["error"])) {
            $msg = match ($_GET['error']) {

                "no_existing_user" => 'Usuari inexistent',
                "incorrect_name" => 'Nom incorrecte',
                "incorrect_password" => 'Contrasenya incorrecte',

                default => 'S\'ha produït un error inesperat',
            };

            if ($msg) {
                return $msg;
            }
            
        } else {
            return "";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div>
            <p style="color: red;">
                <?php 
                    echo mostrarError();
                ?>
            </p>
        </div><br>
        <div class="loginRow">
        <form action="processLogin.php" method="post">
            <h1>Inicia la sessió</h1>
            <span>introdueix les teves credencials</span>
            <input type="text" name="nom" placeholder="Nom" />
            <input type="password" name="contrasenya" placeholder="Contrasenya" />
            <input type="hidden" name="method" value="signin"/>
            <button type="submit">Inicia la sessió</button>
        </form>
        </div>
        
    </div>
</body>
</html>