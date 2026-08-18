<?php
session_start(); // Inicia a sessão

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Se for preciso matar a sessão, também é necessário matar os cookies.
// Nota: Isso destruirá a sessão, e não apenas os dados da sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruir a sessão
session_destroy();

// Redirecionar para a página de login ou página inicial
header("Location: ../../../../index.php");
exit();
