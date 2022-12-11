<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Accés</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <form action="sqlInjection.php" method="post">
        <h1>Inicia la sessió</h1>
        <span>introdueix les teves credencials</span>
        <input type="email" name="correu" placeholder="Correu electronic" />
        <input type="password" name="contrasenya" placeholder="Contrasenya" />
        <input type="hidden" name="method" value="signin"/>
        <button type="submit">Inicia la sessió</button>
    </form>
</body>
</html>