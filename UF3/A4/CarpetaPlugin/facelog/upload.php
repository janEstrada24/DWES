<?php

require_once __DIR__ . '/../../../wp-load.php';

/** Sets up the WordPress Environment. */
define('WP_USE_THEMES', false); /* Disable WP theme for this file (optional) */

//TODO: Cal implementar la funcionalitat

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "Puja") {

            /**
             * Ens assegurem de que l usuari ha ficat els valors minims en el formulari
             * 
             * En el cas de la imatge, conve que fiquem FILES en comptes de POST ja que
             * es tracta d'un fitxer
             */ 
            $es_ok_load = isset($_POST['today']) && $_POST['today'] != null
                          || isset($_POST['date']) && $_POST['date'] != null
                          && isset($_FILES['imageupload']) && $_FILES['imageupload'] != null;

            if ($es_ok_load) {
                global $wpdb;
                
                if (isset($_POST['today'])) {
                    $date = date("Y-m-d");
                } else if (isset($_POST['date'])) {
                    $date = $_POST['date'];
                }

                $table = $wpdb->prefix.'logs_facelog';
                $user = wp_get_current_user()->user_login;
                $imageToUpload = $_FILES['imageupload'];

                $target_dir = "uploads/tmp/";
                $imageFileType = strtolower(pathinfo($target_dir. basename($imageToUpload["name"]),PATHINFO_EXTENSION));
                $imageUploadURL = $target_dir . basename($imageToUpload["name"]);

                // Creem una copia de la imatge per penjar-la al directori /uploads/tmp
                move_uploaded_file($imageToUpload["tmp_name"], $imageUploadURL);

                // Inserim el registre a la base de dades
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
                    && $imageToUpload["size"] > 5000000) {

                    $data = array('user_log' => $user, 'image_log' => $imageUploadURL, 'date_log' => $date);
                    $format = array('%s','%s','%d');
                    $wpdb->insert($table,$data,$format);
                } else {

                }
                
            } else {

            }
        }
    }
}
