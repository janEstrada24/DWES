<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Pràctica Encriptació Strings</title>

</head>

<body>
<?php
 
// Aquí tenim les dos cadenes amb les que treballarem
$sp = "kfhxivrozziuortghrvxrrkcrozxlwflrh";
$mr = " hv ovxozwozv vj o vfrfjvivfj h vmzvlo e hrxvhlmov oz ozx.vw z xve hv loqvn il hv lmnlg izxvwrhrvml ,hv b lh mv,rhhv mf w zrxvlrh.m";

/**
 * Aquí mostrem encriptada i desencriptada la
 * primera cadena
 */
echo "<b>Cadena original</b> <br>";
echo $sp;
echo "<br>";
echo "<b>Cadena desencriptada</b> <br>";
echo decrypt($sp);
echo "<br><br>";

/**
 * Aquí mostrem encriptada i desencriptada la
 * segona cadena
 */
echo "<b>Cadena original</b> <br>";
echo $mr;
echo "<br>";
echo "<b>Cadena desencriptada</b> <br>";
echo decrypt($mr);

/**
 * Creem la funció decrypt on hi passem per paràmetre l'string
 */
function decrypt($str) {
	/**
	 * Variable amb la que indicarem que agafem trossos
	 * de la cadena de 3 en 3
	 */
	$mida = 3;

	/**
	 * Les variables del primer bucle
	 */
	$comptador = 0;
	$arrayFragmentat = array();
	$cadenaRevertida = "";

	/**
	 * Les variables del segon bucle
	 */
	$segonComptador = 0;
	$cadenaFinal= "";
	$posicio = 0;

	/**
	 * Aquí guardem la cadena dins d'un array i el 
	 * particionem de tres en tres
	 */
	$arrayFragmentat = str_split ($str, $mida);
	
	/**
	 * En aquest bucle, per cada tros que es recorre, es reverteix
	 * i els trossos revertits es van acumulant en una nova variable
	 * anomenada $cadenaRevertida
	 */
	for ($comptador = 0; $comptador < count($arrayFragmentat); $comptador++) {
		$cadenaRevertida .= strrev($arrayFragmentat[$comptador]) ;
	}
	
	/**
	 * Un cop revertida la cadena, substituïm els caràcters alfabètics
	 * trobats pel seu oposat en aquest segon bucle
	 */
	for ($segonComptador = 0; $segonComptador < strlen($cadenaRevertida); $segonComptador++) {
		/**
		 * En una nova variable anomenada $posicio obtenim el número
		 * del caràcter dins la taula ASCII
		 */
		$posicio = ord($cadenaRevertida[$segonComptador]);

		/**
		 * En cas de que aquest número estigui entre el 97 i el 122,
		 * és a dir, sigui [a-z], el substituïm pel seu oposat, 
		 * transformem el número obtingut de la taula ASCII en el 
		 * caràcter corresponent i una nova variable anomenada 
		 * $cadenaFinal els va acumulant. 
		 */
		if ($posicio >= 97 | $posicio <= 122) {
			$posicioObtinguda = 122 - (ord($cadenaRevertida[$segonComptador]) - 97);
			$cadenaFinal .= chr($posicioObtinguda);
		} 
		
		/**
		 * En cas contrari, simplement es mantenen els caràcters i 
		 * també es van acumulant a la nova variable
		 */
		else {
			$posicioObtinguda = ord($cadenaRevertida[$segonComptador]);
			$cadenaFinal .= chr($posicioObtinguda);
		}
	}
	
	/**
	 * Finalment, retornem la cadena obtinguda
	 */
	return $cadenaFinal;
}

?>

<p>
</p>
</body>
</html>
