<!DOCTYPE html>
<html lang="ca">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Calculadora</title>
</head>
<body>
    
    <div class="container">
        <form name="calc" class="calculator" method="post">
            <input type="text" name="contingut" class="value" readonly value="<?php echo pintarContingut(); ?>" />
            <span class="extra"><input type ="submit" name="num" value="("></span>
            <span class="extra"><input type ="submit" name="num" value=")"></span>
            <span class="extra"><input type ="submit" name="funcio" value="SIN"></span>
            <span class="extra"><input type ="submit" name="funcio" value="COS"></span>
            <span class="num clear"><input type ="submit" name="clear" value="C"></span>
            <span class="num"><input type ="submit" name="num" value="/"></span>
            <span class="num"><input type ="submit" name="num" value="*"></span>
            <span class="num"><input type ="submit" name="num" value="7"></span>
            <span class="num"><input type ="submit" name="num" value="8"></span>
            <span class="num"><input type ="submit" name="num" value="9"></span>
            <span class="num"><input type ="submit" name="num" value="-"></span>
            <span class="num"><input type ="submit" name="num" value="4"></span>
            <span class="num"><input type ="submit" name="num" value="5"></span>
            <span class="num"><input type ="submit" name="num" value="6"></span>
            <span class="num plus"><input type ="submit" name="num" value="+"></span>
            <span class="num"><input type ="submit" name="num" value="1"></span>
            <span class="num"><input type ="submit" name="num" value="2"></span>
            <span class="num"><input type ="submit" name="num" value="3"></span>
            <span class="num"><input type ="submit" name="num" value="0"></span>
            <span class="num"><input type ="submit" name="num" value="00"></span>
            <span class="num"><input type ="submit" name="num" value="."></span>
            <span class="num equal"><input type ="submit" name="equal" value="="></span>
        </form>
    </div>
    
    <?php
        
        function pintarContingut() {
            /**
             * Inicialitzem la variable que ens donarà el resultat
             */
            $resultat = "";

            /**
             * Fiquem l'isset perquè la calculadora
             * no peti.
             * L'isset del num i operator és per
             * verificar que els valors passats
             * per paràmetre existeixen i no
             * ens donin error
             */

            /**
             * Condicional que retorna el valor obtingut a la pantalla
             */
            if (isset($_POST['contingut']) && isset($_POST['equal'])) {
                $resultat = $_POST['contingut'];
                /**
                 * Evaluem els errors que hi puguin 
                 * haver en el resultat
                 */
                return errors($resultat);
            } 
            
            /**
             * Condicional que va acumulant números i operadors mentre
             * no es doni clic a la tecla =
             */
            if (isset($_POST['contingut']) && isset($_POST['num'])) {
                $resultat = $_POST['contingut'];
                $resultat .= $_POST['num'];
            }

            /**
             * Condicional que col·loca un parèntesis en cas que utilitzem
             * una funció SIN o COS
             */
            if (isset($_POST['contingut']) && isset($_POST['funcio'])) {
                $resultat = $_POST['contingut'];
                $resultat .= $_POST['funcio'] . '(';
            }

            /**
             * Condicional que esborra el contingut de la pantalla
             */
			if (isset($_POST['contingut']) && isset($_POST['clear'])) {
                $resultat = "";
            }

            return $resultat;
        }

        /**
         * Funció per comprovar els errors de la calculadora
         */
        function errors($resultat) {
            try {
                /**
                 * Fem que es facin els càlculs de la cadena
                 * passada per pantalla
                 */
                $resultat = eval('return ' . $resultat . ';');
                return $resultat;

                /**
                 * Fem que mostri INF en cas de que vulguis fer
                 * una divisió entre 0
                 */
            } catch (DivisionByZeroError) {
                return "INF";

                /**
                 * Si es troba qualsevol error, retornarem
                 * un missatge d'error
                 */
            } catch (Error $e) {
                return "ERROR";
            }
        }
    ?>

</body>