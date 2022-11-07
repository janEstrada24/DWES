<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
    <?php
        /** 
         * A continuació veuràs el procés complet per 
         * encriptar i desencriptar
         */

        /**
         * Aquí creem la clau de seguretat per encriptar
         * i desencriptar
         */
        $clau  = 'Com mes llarga sigui la cadena o clau per encriptar i desencriptar, 
                  millor, i evidentment, conve que la canviis de tant en tant';

        //El mètode que utilitzarem per encriptar
        $method = 'aes-256-cbc';

        // En podem generar una de diferent utilitzant la funció getIV()
        $iv = base62_descodificar("C9fBxl1EWtYTL1/M8jfstw==");


        $encriptar = function ($cadena) use ($method, $clau, $iv) {
            return openssl_encrypt ($cadena, $method, $clau, false, $iv);
        };

        /**
         * Un cop encriptat el text, aquí el desencriptem amb una
         * altra funció
         */
        $desencriptar = function ($cadena) use ($method, $clau, $iv) {
            $encrypted_data = base62_descodificar($cadena);
            return openssl_decrypt($cadena, $method, $clau, false, $iv);
        };

        /**
         * Obtenir el nom del mètode que hem utilitzat
         */
        $getNomMetode = function () use ($method) {
            return $method;
        }


        /**
         * Altres mètodes que ens podrien funcionar amb base62
         */
        /*function base62_codificar($valor) {
            $resultat = '';
            $base=62;
            $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            do {
                $i = $valor % $base;
                $str = $chars[$i] . $str;
                $valor = ($valor - $i) / $base;
            } while($valor > 0);
            return $resultat;
        }
         
        function base62_descodificar($cadena) {
            $base=62;
            $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitud = strlen($cadena);
            $resultat = 0;
            $arr = array_flip(str_split($chars));
            for($i = 0; $i < $longitud; ++$i) {
                $resultat += $arr[$cadena[$i]] * pow($base, $longitud-$i-1);
            }
            return $resultat;
        }
        */
        /**
         * Generem un valor per IV
         */
        $getIV = function () use ($method) {
            return base62_codificar(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)));
        };

        /**
         * Obtenir el nom del mètode que hem utilitzat
         */
        $getNomMetode = function () use ($method) {
            return $method;
        }
    ?>
</body>
</html>
