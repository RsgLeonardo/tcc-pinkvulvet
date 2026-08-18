<?php
require_once '../../../config/conect.php';

// Inicia a sessão se ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Consulta para buscar os itens do carrinho
// Esta consulta agora busca os produtos com base nos IDs armazenados na sessão
$cartItems = [];
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $ids_produtos = array_column($_SESSION['carrinho'], 'id_produto');
    $quantidades = $_SESSION['carrinho']; // Mantém a informação da quantidade

    // Converte os IDs dos produtos para uma string para usar na consulta IN
    $ids_produtos_string = implode(',', $ids_produtos);


    // Verificar se o usuário está logado
    /*if (!isset($_SESSION['id_cliente'])) {
    // Redirecionar para a página de login
    header("Location: ../../login/login.php?redirect=" . urlencode($_SERVER['PHP_SELF']));
    exit;
}

$id_cliente = $_SESSION['id_cliente'];*/

    // Converte os IDs dos produtos para uma string para usar na consulta IN
    $ids_produtos_string = implode(',', $ids_produtos);

    $sql = "SELECT
                p.id_produto,
                p.nome,
                p.preco,
                p.imagem
            FROM
                produto p
            WHERE
                p.id_produto IN ($ids_produtos_string)";

    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            // Encontra a quantidade do produto no carrinho da sessão
            $quantidade = 0;
            foreach ($quantidades as $item) {
                if ($item['id_produto'] == $row['id_produto']) {
                    $quantidade = $item['quantidade'];
                    break;
                }
            }

            $cartItems[] = [
                'id' => $row['id_produto'], // Usar o ID do produto
                'name' => $row['nome'],
                'price' => floatval($row['preco']),
                'quantity' => intval($quantidade), // Usar a quantidade da sessão
                'image' => $row['imagem']
            ];
        }
    }
}

// Função para calcular o total de itens no carrinho
$totalItens = 0;
foreach ($cartItems as $item) {
    $totalItens += $item['quantity'];
}

// Função para calcular o valor total do carrinho
function calcularTotal($cartItems)
{
    $total = 0;
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Processar ações do carrinho (atualizar quantidade, remover item)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_quantity':
                $id = intval($_POST['id']); // Garante que o ID é um inteiro
                $quantidade = intval($_POST['quantidade']); // Garante que a quantidade é um inteiro

                // Valida a quantidade
                if ($quantidade > 0) {
                    // Atualiza a quantidade na sessão
                    foreach ($_SESSION['carrinho'] as &$item) {
                        if ($item['id_produto'] == $id) {
                            $item['quantidade'] = $quantidade;
                            break;
                        }
                    }
                } else {
                    // Se a quantidade for 0 ou negativa, remove o item do carrinho
                    foreach ($_SESSION['carrinho'] as $key => $item) {
                        if ($item['id_produto'] == $id) {
                            unset($_SESSION['carrinho'][$key]);
                            break;
                        }
                    }
                }
                break;

            case 'remove_item':
                $id = intval($_POST['id']); // Garante que o ID é um inteiro
                // Remove o item do carrinho na sessão
                foreach ($_SESSION['carrinho'] as $key => $item) {
                    if ($item['id_produto'] == $id) {
                        unset($_SESSION['carrinho'][$key]);
                        break;
                    }
                }
                break;

            case 'clear_cart':
                // Remove todos os itens do carrinho limpando a sessão
                unset($_SESSION['carrinho']);
                $_SESSION['carrinho'] = []; // Garante que o carrinho é um array vazio
                break;
        }
        // Recalcula o total e redireciona para a página do carrinho
        header('Location: carrinho.php');
        exit();
    }
}