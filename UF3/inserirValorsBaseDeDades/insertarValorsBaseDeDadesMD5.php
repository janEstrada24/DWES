<?php

$usuari = "";
$msg = "";
if (isset($_COOKIE['msg'])) {
    $msg=$_COOKIE['msg'];
    setcookie("msg", null,-1 );
}

$es_post = ($_SERVER['REQUEST_METHOD'] == 'POST');
if ( $es_post ) {

  try {
    $hostname = "localhost:3306";
    $dbname = "gringottsdb";
    $username = "dwes_user@localhost";
    $pw = "dwes_pass";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }

  $es_ok = isset( $_POST['usuari'] ) &&
           isset( $_POST['passwd'] ) &&
           strlen( $_POST['usuari'] ) >= 5 &&
           strlen( $_POST['usuari'] ) <= 10 &&
           strlen( $_POST['passwd'] ) >= 5 &&
           strlen( $_POST['passwd'] ) <= 15;

  //comprovo que no estigui repetit aquest usuari.
  if ( $es_ok ) {
      $usuari= $_POST['usuari'];
      $sql="select count(*) as n from goblins where goblin_name = ?";
      $query = $pdo->prepare($sql);
      $query->execute( array( $usuari ) );

      //control d'errors
      $e= $query->errorInfo();
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);
      }

      $resultat= $query->fetch();
      $es_ok = ($resultat['n'] == 0 );
  }

  if ($es_ok) {
    //inserció i redirect
    $usuari= $_POST['usuari'];
    $passwd= $_POST['passwd'];
    $sql="insert into goblins values (?,md5(?), null)";
    $query = $pdo->prepare($sql);
    $query->execute( array( $usuari,$passwd ) );

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
      die("Error accedint a dades: " . $e[2]);
    }

    

    setcookie("msg", "Usuari [$usuari] insertat correctament." );
    die( header('Location: ./insert.php'));

  } else {
    //missatge d'error.
    if (isset($_POST['usuari'])) $usuari= $_POST['usuari'];
    $msg="Comprova que has introduit correctament usuari i password i que no està repetit";
  }

}

?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>Inserció</title>
</head>
<body>

<div>
    <?php echo $msg ?>
</div>

<form name="login"
      action=""
      method="post"
      accept-charset="utf-8">
  <ul>
    <li><label for="usuari">Usuari:</label>
    <input type="text" value="<?php echo $usuari; ?>"
           name="usuari" placeholder="usuari" required></li>

    <li><label for="passwd">Password:</label>
    <input type="password"
           name="passwd" placeholder="passwd" required></li>

    <input type="submit" value="Calcula"></li>
  </ul>
</form>

</body>
</html>