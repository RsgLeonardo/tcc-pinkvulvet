<?php
require_once '../../../config/conect.php';

// Define o cabeçalho para resposta JSON
header('Content-Type: application/json');

// Obtém o ID do produto da URL
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto = $_POST["adicionar_carrinho"];

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Se o carrinho ainda não existe na sessão, crie um array para ele.
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verifica se o produto já está no carrinho.
    $produto_no_carrinho = false;
    foreach ($_SESSION['carrinho'] as &$item) { // Use &$item para modificar o item diretamente
        if ($item['id_produto'] == $id_produto) {
            $item['quantidade']++; // Aumenta a quantidade se o produto já estiver no carrinho
            $produto_no_carrinho = true;
            break; // Importante: sai do loop após atualizar
        }
    }

    // Se o produto não está no carrinho, adicione-o.
    if (!$produto_no_carrinho) {
        // Adiciona o produto ao carrinho na sessão.  'quantidade' => 1
        $_SESSION['carrinho'][] = [
            'id_produto' => $id_produto,
            'quantidade' => 1, // Começa com quantidade 1
        ];
    }

    // Retorna resposta JSON de sucesso
    echo json_encode(['success' => true, 'message' => 'Produto adicionado ao carrinho com sucesso!']);
    exit();
}

// Se não for POST, retorna erro
echo json_encode(['success' => false, 'message' => 'Método não permitido']);
?>