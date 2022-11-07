<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Pràctica Recórrer Array</title>

</head>

<body>
<?php

foreach( $_SERVER as $clau => $valor ) {
	/**
	 * Accedim a l'array $_SERVER i d'aquesta manera obtindrem 
	 * totes les seves claus juntament amb els seus valors
	 */
	echo "El valor de la clau [$clau] és [$valor]<br><br>";
}

?>

<p>
</p>
</body>
</html>
