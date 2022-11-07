<?php

    function factorialNumero($numero) {
        /**
         * Iniciem la variable factorial
         * i el comptador amb 1 ja que sinó 
         * el resultat seria sempre 0
         */
        $factorial = 1;
        for ($i = 1; $i <= $numero; $i++) {
            $factorial = $factorial * $i;
        }
        return $factorial;
    }

    function factorialArray($arrayNumeros) {
        /**
         * Hem de saber primer si el paràmetre
         * és un array per fer el procés
         */
        if (is_array($arrayNumeros)){
            $arrayFactorials = array();
            for ($i = 0; $i < count($arrayNumeros); $i++) {
                /**
                 * Hem de saber primer si el valor de
                 * la casella és un número per fer el
                 * procés
                 */
                if (is_numeric($arrayNumeros[$i])) {
                    /**
                     * Apliquem la funció creada anteriorment
                     * per cada valor de cada casella
                     */
                    $arrayFactorials[$i] = factorialNumero($arrayNumeros[$i]);
                } else {
                    return false;
                }
            }
            return $arrayFactorials;
        } else {
            return false;
        }
    }

    /**
     * Amb aquest mètode, podem passar
     * un array a String separant els
     * valors per espais
     */
    function arrayToString($array) {
        $cadenaArray = "[ ";
        foreach( $array as $valor ) {
            $cadenaArray .= $valor . " ";
        }
        $cadenaArray .= "]";
        return $cadenaArray;
    }

    echo "<h1><u>Factorial d'un array</u></h1>";
    $arrayInicial = array(0, 8, 10, 12);
    $arrayFactorialNumeros = factorialArray($arrayInicial);
    echo "<h2>Array de números</h2>";
    echo var_dump($arrayInicial);
    echo "<h2>Array de números (convertit a String)</h2>";
    echo arrayToString($arrayInicial);
    echo "<h2>Array de factorials</h2>";
    echo var_dump($arrayFactorialNumeros);
    echo "<h2>Array de factorials (convertit a String)</h2>";
    echo arrayToString($arrayFactorialNumeros);
?>