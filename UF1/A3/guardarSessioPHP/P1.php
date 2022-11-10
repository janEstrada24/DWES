<?php 

    session_start();

    $_SESSION['color']  = 'verd';
    $_SESSION['animal'] = 'gat';
    $_SESSION['instant']   = time();
    echo '<h1>Variables sessió instanciades</h1>';

?>