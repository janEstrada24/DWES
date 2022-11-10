<?php 
    session_start();
    $tempsActual = time();

    /**
     * Mentre l'autentificació porti menys d'un
     * minut estant activa, es redireccionarà a
     * hola.php, resant la data actual amb la data
     * d'autentificació.
     */
    if (isset($_SESSION['dataAutentificacio'])) {
        if (($tempsActual - $_SESSION['dataAutentificacio']) <= 60) {
            header('Location: hola.php', true, 302);
        }
    }

    /**
     * Obtenim l'error mitjançant el mètode GET
     * i el passem a majúscules
     * 
     * @return string
     */
    function mostrarError():string {
        if(isset($_GET["error"])) {
            return strtoupper($_GET["error"]);
        } else {
            return "";
        }
    }

    /**
     * Per definir l'estil dels missatges
     * d'error quan aquests es mostrin
     * 
     * @return string
     */
    function estilError():string {
        $error = mostrarError();

        // Estil pels errors relacionats amb l'acces incorrecte
        if ($error == "SIGNIN_USUARI_INEXISTENT" 
            || $error == "SIGNIN_CORREU_INCORRECTE" 
            || $error == "SIGNIN_CONTRASENYA_INCORRECTE") {

            // Utilitzem el color taronja ja que és el de la secció d'autentificacions
            return 'style="color:#FFFFFF; 
                    background-color:#FF4B2B;
                    border: 1px solid;
                    border-radius: 45px;
                    border-color:#FF4B2B;"';
        } 
        
        // Estil pels errors relacionats amb la creacio fallida
        else if($error == "CREACIO_FALLIDA_USUARI_EXISTENT"
                || $error == "CREACIO_FALLIDA_CORREU_INCORRECTE" 
                || $error == "CREACIO_FALLIDA_CONTRASENYA_INCORRECTE" 
                || $error == "CREACIO_FALLIDA_NOM_INCORRECTE" 
                || $error == "CREACIO_FALLIDA" ) {

            // Utilitzem el color magenta ja que és el de la secció de creacio d'usuaris
            return 'style="color:#FFFFFF; 
                    background-color:#FF416C;
                    border: 1px solid;
                    border-radius: 45px;
                    border-color:#FF416C;"';
        } 
        
        // No retornem res si no hi ha cap error
        else {
            return "";
        }
    }
?> 

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Accés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div <?php echo estilError(); ?>>
        <p style="margin-right: 40px;
                  margin-left: 40px;
                  margin-top: 8px;
                  margin-bottom: 8px;
                  " >
                <?php 
                    echo mostrarError();
                ?>
        </p>
    </div><br>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="process.php" method="post">
                <h1>Inicia la sessió</h1>
                <span>introdueix les teves credencials</span>
                <input type="email" name="correu" placeholder="Correu electronic" />
                <input type="password" name="contrasenya" placeholder="Contrasenya" />
                <input type="hidden" name="method" value="signin"/>
                <button type="submit">Inicia la sessió</button>
            </form>
        </div>
        <div class="form-container sign-up-container">
            <form action="process.php" method="post">
                <h1>Registra't</h1>
                <span>crea un compte d'usuari</span>
                <input type="text" name="nom" placeholder="Nom" />
                <input type="email" name="correu" placeholder="Correu electronic" />
                <input type="password" name="contrasenya" placeholder="Contrasenya" />
                <input type="hidden" name="method" value="signup"/>
                <button type="submit">Registra't</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Ja tens un compte?</h1>
                    <p>Introdueix les teves dades per connectar-nos de nou</p>
                    <button class="ghost" name="method" id="signIn">Inicia la sessió</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Primera vegada per aquí?</h1>
                    <p>Introdueix les teves dades i crea un nou compte d'usuari</p>
                    <button class="ghost" name="signUp" id="signUp">Registra't</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</html>