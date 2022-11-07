<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Pràctica tipus de variables</title>

</head>

<body>
<?php
/**
 * Practiquem amb una variable de tipus 
 * interger
 */
$i = 12;
$tipus_de_i = gettype( $i );
echo "La variable \$i 
      conté el valor $i 
	  i és del tipus $tipus_de_i <br>";

/**
 * Practiquem amb una variable de tipus 
 * boolean
 */
$b = true;
$tipus_de_b = gettype( $b );
echo "La variable \$b 
    conté el valor $b
    i és del tipus $tipus_de_b <br>";

/**
 * Practiquem amb una variable de tipus 
 * float/double
 */
$f = 5.4;
$tipus_de_f = gettype( $f );
echo "La variable \$f 
    conté el valor $f
    i és del tipus $tipus_de_f <br>";

/**
 * Practiquem amb una variable de tipus 
 * String
 */
$s = "Hola";
$tipus_de_s = gettype( $s );
echo "La variable \$s 
      conté el valor $s 
	  i és del tipus $tipus_de_s <br>";

?>
<p>
</p>
</body>
</html>
