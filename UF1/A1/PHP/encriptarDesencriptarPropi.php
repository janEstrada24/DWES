<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
<title>Técnica d'encriptament i desencriptament pròpia</title>
</head>

<body>
    <?php
        include "encryptPropi.php";

        $dades = "Informació que desencriptaré mitjançant el meu propi mètode";

        $dadesEncriptades = base_convert($dades,16, 2);
       
        /**
         * I aquí la desencriptem, a més d'esmentar eines que 
         * hem utilitzat
         */ 
        $dadesDesencriptades = base_convert($dadesEncriptades, 2, 32);
        echo "<b>Dades encriptades</b>: ". $dadesEncriptades . "<br><br>";
        echo "<b>Dades desencriptades</b>: ". $dadesDesencriptades . "<br><br>";
        echo "<b>IV o Vector d'Inicialització generat</b>: " . $getIV() . "<br><br>";
        echo "<b>Mètode utilitzat</b>: " . $getNomMetode();
        
    ?>
   
<p>
</p>
</body>
</html>
