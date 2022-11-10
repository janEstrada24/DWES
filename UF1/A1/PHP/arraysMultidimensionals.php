<?php

    function creaMatriu (int $n) {
        /**
         * Iniciem les variables que utilitzarem,
         * entre elles la matriu que retornarem
         */
        $matriu = array();
        $fila = 0;
        $columna = 0;
        
        /**
         * Amb aquests dos bucles analitzarem les files i,
         * dins d'aquestes, les columnes o caselles per
         * cada fila
         */
        for ($fila = 0; $fila < $n; $fila++) {
            for ($columna = 0; $columna < $n; $columna++) {
                
                /** 
                 * Si el número de files equival al de columnes,
                 * dibuixarem la diagonal que separarà 
                 * el contingut de l'array
                 */
                if ($fila == $columna) {
                    $matriu[$fila][$columna] = "*";
                }
                /**
                 * En cas de que el número de files sigui
                 * inferior al de les columnes, equivaldrà 
                 * a la meitat superior de l'array i per tant,
                 * col·locarem la suma d'aquestes dos variables
                 */
                else if ($fila < $columna) {
                    $matriu[$fila][$columna] = $fila + $columna;
                }
                /**
                 * En cas de que el número de files sigui
                 * major al de les columnes, equivaldrà a la
                 * meitat inferior de l'array i per tant,
                 * col·locarem els números aleatoris
                 */
                else if ($fila > $columna) {
                    $matriu[$fila][$columna] = rand(10,20);
                }
            }
        }
        return $matriu;
    }

    function mostraMatriu($matriu) {
        /**
         * Iniciem la variable on guardarem
         * la taula completa amb l'etiqueta 
         * principal table i amb l'atribut
         * border perquè es vegi bé
         */
        $taula = '<table border="1">';
        
        /**
         * En aquests dos bucles, afegim
         * l'etiqueta <tr> per cada fila
         * analitzada i l'etiqueta <th>
         * per cada columna dins d'aquesta.
         */
        foreach($matriu as $fila) {
            $taula .= "<tr>";
            foreach($fila as $columna) {
                $taula .= "<th>" . $columna . "</th>";
            }
            $taula .= "</tr>";
        }

        /**
         * Tanquem l'etiqueta de la taula
         */
        $taula .= "</table>";
        return $taula;
    }

    function transposaMatriu($matriu) {
        $files = 0;
        $columnes = 0;
        $matriuGirada = array();

        /**
         * Per adaptar-lo tant si la matriu entrada per 
         * paràmetre és quadrada o no, comptarem tant 
         * les files com les columnes d'aquesta
         */
        $files = count($matriu);
        for ($fila = 0; $fila < $files; $fila++) {
            $columnes = count($matriu[$fila]);
            for($columna = 0; $columna < $columnes; $columna++) {
                if ($fila == $columna) {
                    $matriuGirada[$fila][$columna] = "*";
                }
                /**
                 * En aquests dos condicionals s'agafa el valor de la 
                 * matriu entrada per paràmetre i es guarda en la 
                 * posició exactament invertida de la nova que hem creat.
                 * Ho fem girant les files i les columnes d'aquesta.
                 */
                else if ($fila > $columna) {
                    $matriuGirada[$columna][$fila] = $matriu[$fila][$columna];

                }
                else if ($fila < $columna) {
                    $matriuGirada[$columna][$fila] = $matriu[$fila][$columna];

                }
            }
        }
        return $matriuGirada;
    }

    echo "<h1><u>Crear, mostrar i transposar matriu</u></h1>";
    $matriuCreada = creaMatriu(4);
    $matriuInvertida = transposaMatriu($matriuCreada);
    echo "<h2>Matriu mostrada i creada</h2>";
    echo mostraMatriu($matriuCreada);
    echo "<h2>Matriu transposada</h2>";
    echo mostraMatriu($matriuInvertida);
?>