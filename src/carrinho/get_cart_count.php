<?php
require_once __DIR__ . '/../../../config/conect.php';
require_once __DIR__ . '/../cadastro-login/login/auth.php';
require_once __DIR__ . '/cart.php';

header('Content-Type: application/json'); // Define o tipo de conteúdo da resposta como JSON

$cart_item_count = 0; // Inicializa o contador de itens do carrinho com 0


// Lógica para obter a contagem do carrinho com base no status de login do usuário
if (verificar_login()) {
    // Assume que o ID do usuário logado é armazenado em $_SESSION['id_cliente'].
    // Confirme que esta é a variável de sessão correta para o ID do usuário logado.
    $user_id = $_SESSION['id_cliente'] ?? null;

    if ($user_id) {
        try {
            // Prepara a consulta SQL para somar as quantidades dos itens do carrinho do usuário logado.
            $stmt = $conn->prepare("SELECT SUM(quantidade) AS total_items FROM carrinho WHERE id_cliente = ?");
            $stmt->bind_param("i", $user_id); // "i" para inteiro (integer)
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row && $row['total_items'] !== null) {
                $cart_item_count = (int)$row['total_items'];
            }
            $stmt->close(); // Fecha o statement preparado.

        } catch (Exception $e) {
            // Em caso de erro com o DB, tenta usar o carrinho da sessão como fallback (se existir).
            // Em ambiente de produção, você pode logar o erro em um arquivo de log, mas não exibi-lo ao usuário.
            if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
                foreach ($_SESSION['carrinho'] as $item) {
                    $cart_item_count += $item['quantidade'];
                }
            }
        }
    } else {
        // Se o ID do cliente logado não estiver na sessão, usa o carrinho de sessão como fallback.
        if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
            foreach ($_SESSION['carrinho'] as $item) {
                $cart_item_count += $item['quantidade'];
            }
        }
    }

} else {
    // Se o usuário não está logado, a contagem vem do carrinho armazenado na sessão (carrinho de convidado).
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $item) {
            $cart_item_count += $item['quantidade'];
        }
    }
}

// Imprime a contagem final como um objeto JSON.
echo json_encode(['count' => $cart_item_count]);

// Fecha a conexão com o banco de dados.
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>