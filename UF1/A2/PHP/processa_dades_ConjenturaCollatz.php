<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<pre>
<body>
    <?php
        /**
         * Obtenim el número entrat en el formulari
         */
        $numero = $_POST["n"];

        /**
         * Ens assegurem de que el número sigui superior a 1
         * abans de fer la Conjentura Collatz
         */
        if ($numero < 1) {
            echo "No es permeten números més petits de 1.";
        } else {
            echo "La seqüència de $numero és <br>";
            $iteracions = 0;
            $contingutIteracions = "{";
            $arrayNumeros = array();

            /**
             * A més de fer les operacions necessàries, també´
             * acumularem els números resultants en un array
             * per després obtenir el seu valor màxim.
             */
            while ($numero != 1) {
                if ($numero % 2 == 0) {
                    $numero = $numero / 2;
                    $arrayNumeros[$iteracions] = $numero;
                    $contingutIteracions .= $numero . ",";
                    $iteracions++;
                } else {
                    $numero = 3 * $numero + 1;
                    $arrayNumeros[$iteracions] = $numero;
                    $contingutIteracions .= $numero . ",";
                    $iteracions++;
                }
            }

            /**
             * Fiquem les dades demanades a l'enunciat
             */
            $contingutIteracions .= "}";
            echo $contingutIteracions . "<br>";
            echo "després de $iteracions iteracions i arribant a un màxim de ";
            echo max($arrayNumeros);
        }
    ?>
</body>
</pre>
</html>