<?php
require_once '../../../config/conect.php';
// Obtém o ID do produto da URL
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto = $_POST["adicionar_carrinho"];

    // file_put_contents('./my-log.txt', 'test=' . $id_produto);
    // isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Verifica se o formulário de adicionar ao carrinho foi enviado
    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar_carrinho'])) {
    // ***MODIFICAÇÃO IMPORTANTE***
    // Para adicionar ao carrinho sem um usuário logado, você precisa de uma maneira de identificar o carrinho.
    // A abordagem mais comum é usar sessões.  Se você ainda não iniciou a sessão, inicie agora.
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

    // Redireciona para a página do carrinho para exibir o item adicionado
    //header('Location: ../carrinho/carrinho.php'); // Assumindo que você tem um arquivo carrinho.php
    //exit(); // Encerra o script após o redirecionamento

    // MODIFICAÇÃO: Em vez de redirecionar, retorne uma resposta JSON
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Item adicionado ao carrinho com sucesso!']);
    exit();
}
