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
        $iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

        /**
         * Enviat com a un paràmetre, encriptem el text mitjançant
         * una funció
         */
        $encriptar = function ($cadena) use ($method, $clau, $iv) {
            return openssl_encrypt ($cadena, $method, $clau, false, $iv);
        };

        /**
         * Un cop encriptat el text, aquí el desencriptem amb una
         * altra funció
         */
        $desencriptar = function ($cadena) use ($method, $clau, $iv) {
            $encrypted_data = base64_decode($cadena);
            return openssl_decrypt($cadena, $method, $clau, false, $iv);
        };

        /**
         * Generem un valor per IV
         */
        $getIV = function () use ($method) {
            return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)));
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
