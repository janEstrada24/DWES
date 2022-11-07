<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Exemple de formulari</title>

</head>
<pre>
<body>
    <?php
        /**
         * Mostrem el valor de $_REQUEST
         */
        print_r($_REQUEST);
        echo "<br><br>";

        /**
         * Analitzem els valors de totes els camps
         * i mostrem el seu valor sense mostrar
         * també la clau
         */
        foreach ($_REQUEST as $clau => $valor) {
            echo "El valor de <b>$clau</b> és: <br>";

            if (is_array($valor)) {
                foreach ($valor as $casella) {
                    echo "$casella | ";
                }
            } else {
                echo "$valor";
            }
            echo "<br>";
        }
    ?>
</body>
</pre>
</html>