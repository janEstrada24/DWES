<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Pràctica Recórrer Array (esports)</title>

</head>

<body>
<?php
// Guardem els noms dels jugadors en els arrays del seu esport
$jugadors_de_lacrosse = array( "Billy Bitter", "Chris Bocklet", "Jeremy Boltus" );
$jugadors_de_pilota_vasca = array( "Iñaki" );
$jugadors_de_futbol = array( "Lionel Messi", "Ter Stegen");
$jugadors_de_tennis = array( "Rafa Nadal" );

/**
 * Creem larray desports per tal de ficar-hi com a clau el nom 
 * de lesport i com a valors els noms dels jugadors
 * */ 
$esports = array();
$esports["Lacrosse"] = $jugadors_de_lacrosse;
$esports["Pilota Vasca"] = $jugadors_de_pilota_vasca;
$esports["Fútbol"] = $jugadors_de_futbol;
$esports["Tennis"] = $jugadors_de_tennis;

/**
 * Amb aquest bucle accedirem a totes les claus (és a dir, esports)
 * de l'array que hem creat anteriorment i on hi hem guardat els noms
 * dels jugadors 
 */
foreach( $esports as $esport => $jugadors ) {
	echo "Els meus jugadors preferits de $esport són <br>";
    /**
     * Per cada volta d'aquest sergon bucle, accedim a una posició de 
     * l'array jugadors, és a dir, al nom del jugador perquè s'acabi 
     * mostrant 
     * */ 
    foreach( $jugadors as $jugador) {
    echo "$jugador<br>";
    }
    echo "<br>";
}
?>

<p>
</p>
</body>
</html>
