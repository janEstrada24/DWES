<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['textIntroduit'] = $_POST['textIntroduit'];
        $_SESSION['lletraPrincipal'] = $_POST['lletraPrincipal'];
    } 

    /**
     * Mirar si la paraula introduida esta a l'array de solucions
     */
    if (isset($_SESSION['textIntroduit']) && isset($_SESSION['lletraPrincipal'])) {
        $text = $_SESSION['textIntroduit'];
        $lletraObligatoria = $_SESSION['lletraPrincipal'];
        $arraySolucions = $_SESSION['solucions'];
        if (in_array($text, $_SESSION['solucions']) && str_contains($text, $lletraObligatoria) ) {
            header('Location: index.php', true, 302);
        } 
        elseif (!str_contains($text, $lletraObligatoria)) {
            header('Location: index.php?error=NoTeLaLletraObligatoria', true, 303);
        }
        elseif (!in_array($text, $arraySolucions)) {
            header('Location: index.php?error=FuncioNoValida', true, 303);
        }
    } 
?>