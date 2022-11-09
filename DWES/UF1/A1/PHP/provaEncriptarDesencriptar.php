<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
        /**
         * Implementem el fitxer php que conté totes les funcions
         * i eines necessaries per realitzar el procés 
         * encriptar/desencriptar
         */ 
        include "encrypt.php";

        // La informació o dades de prova que utilitzarem
        $dades = "Informació important que haurem de tractar";
        
        
        // Aquí encriptem la informació
        $dadesEncriptades = $encriptar($dades);
       
        /**
         * I aquí la desencriptem, a més d'esmentar eines que 
         * hem utilitzat
         */ 
        $dadesDesencriptades = $desencriptar($dadesEncriptades);
        echo "<b>Dades encriptades</b>: ". $dadesEncriptades . "<br><br>";
        echo "<b>Dades desencriptades</b>: ". $dadesDesencriptades . "<br><br>";
        echo "<b>IV o Vector d'Inicialització generat</b>: " . $getIV() . "<br><br>";
        echo "<b>Mètode utilitzat</b>: " . $getNomMetode();

    ?>
<p>
</p>
</body>
</html>
