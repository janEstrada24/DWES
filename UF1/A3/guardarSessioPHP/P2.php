<?php 
    session_start();

    echo "<h1>Variables de sessions pintats</h1>";
    echo $_SESSION['color'];
    echo "<br>";
    echo $_SESSION['animal'];
    echo "<br>";
    echo $_SESSION['instant'];
?>