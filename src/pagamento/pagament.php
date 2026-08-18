<?php
include_once '../cadastro-login/usandoAPI/viacep.php';
include '../cadastro-login/login/auth.php';
require_once '../../../config/conect.php';

// Verificar se o usuário está logado
if (!verificar_login()) {
    header("Location: ../conta/opcoes.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

$id_cliente = obter_id_usuario();

// Buscar dados do cliente
$sql_cliente = "SELECT nome FROM cliente WHERE id_cliente = ?";
$stmt_cliente = $conn->prepare($sql_cliente);
$stmt_cliente->bind_param("i", $id_cliente);
$stmt_cliente->execute();
$result_cliente = $stmt_cliente->get_result();
// Alteração: Verificar se há resultados antes de tentar buscar
if ($result_cliente && $result_cliente->num_rows > 0) {
    $dados_cliente = $result_cliente->fetch_assoc();
} else {
    $dados_cliente = array('nome' => ''); // Define um valor padrão para evitar erros
}

// Buscar endereço do cliente
$sql_endereco = "SELECT * FROM endereco WHERE id_cliente = ?";
$stmt_endereco = $conn->prepare($sql_endereco);
$stmt_endereco->bind_param("i", $id_cliente);
$stmt_endereco->execute();
$result_endereco = $stmt_endereco->get_result();

// Alteração: Verificar se há resultados antes de tentar buscar
if ($result_endereco && $result_endereco->num_rows > 0) {
    $dados_endereco = $result_endereco->fetch_assoc();
} else {
    $dados_endereco = array( // Define um valor padrão para evitar erros
        'cep' => '',
        'endereco' => '',
        'numero' => '',
        'complemento' => '',
        'bairro' => '',
        'cidade' => '',
        'estado' => '',
        'informacoes' => ''
    );
}

// Buscar itens do carrinho
$itens_carrinho = [];
$total_geral = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $ids_produtos = array_column($_SESSION['carrinho'], 'id_produto');
    $ids_produtos_string = implode(',', $ids_produtos);

    $sql_carrinho = "SELECT p.id_produto, p.nome, p.preco, p.imagem
                    FROM produto p
                    WHERE p.id_produto IN ($ids_produtos_string)";

    $result_carrinho = $conn->query($sql_carrinho);

    if ($result_carrinho->num_rows > 0) {
        while ($row_carrinho = $result_carrinho->fetch_assoc()) {
            $quantidade = 0;
            foreach ($_SESSION['carrinho'] as $item) {
                if ($item['id_produto'] == $row_carrinho['id_produto']) {
                    $quantidade = $item['quantidade'];
                    break;
                }
            }

            $subtotal = $row_carrinho['preco'] * $quantidade;
            $total_geral += $subtotal;

            $itens_carrinho[] = [
                'id_produto' => $row_carrinho['id_produto'],
                'nome' => $row_carrinho['nome'],
                'preco' => $row_carrinho['preco'],
                'imagem' => $row_carrinho['imagem'],
                'quantidade' => $quantidade,
                'subtotal' => $subtotal,
            ];
        }
    }
} elseif (obter_id_usuario()) { // Se o utilizador estiver logado, busca o carrinho do banco de dados
    $id_cliente = obter_id_usuario();
    $sql = "SELECT p.id_produto, p.nome, p.preco, p.imagem, c.quantidade 
            FROM produto p
            JOIN carrinho c ON p.id_produto = c.id_produto
            WHERE c.id_cliente = $id_cliente";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $subtotal = $row['preco'] * $row['quantidade'];
            $total_geral += $subtotal;

            $itens_carrinho[] = [
                'id_produto' => $row['id_produto'],
                'nome' => $row['nome'],
                'preco' => $row['preco'],
                'imagem' => $row['imagem'],
                'quantidade' => $row['quantidade'],
                'subtotal' => $subtotal,
            ];
        }
    }
}

$editando_endereco = isset($_GET['editar_endereco']);

// Processar a atualização do endereço
if (isset($_POST['atualizar_endereco'])) {
    // Validar e sanitizar os dados (IMPORTANTE: Faça uma validação robusta!)
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $informacoes = $_POST['informacoes'];

    // Atualizar no banco de dados
    $sql_update_endereco = "UPDATE endereco SET 
                            cep = ?, endereco = ?, numero = ?, complemento = ?, 
                            bairro = ?, cidade = ?, estado = ?, informacoes = ?
                            WHERE id_cliente = ?";
    $stmt_update_endereco = $conn->prepare($sql_update_endereco);
    $stmt_update_endereco->bind_param(
        "ssssssssi",
        $cep,
        $endereco,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $estado,
        $informacoes,
        $id_cliente
    );

    if ($stmt_update_endereco->execute()) {
        // Atualização bem-sucedida, buscar os dados atualizados
        $stmt_endereco->execute();
        $result_endereco = $stmt_endereco->get_result();
        $dados_endereco = $result_endereco->fetch_assoc();
        $editando_endereco = false; // Sair do modo de edição
    } else {
        echo "Erro ao atualizar o endereço: " . $conn->error;
    }
}

//Processar a finalização do pagamento
if (isset($_POST['finalizar_pagamento'])) {
    $forma_pagamento = $_POST['payment_method'];

    //1. Criar um novo pedido
    $sql_pedido = "INSERT INTO pedido (id_cliente, valor_total, data_pedido, status_pedido) VALUES (?, ?, NOW(), 'a')"; // 'a' para aberto
    $stmt_pedido = $conn->prepare($sql_pedido);
    $stmt_pedido->bind_param("id", $id_cliente, $total_geral);

    if ($stmt_pedido->execute()) {
        $id_pedido = $conn->insert_id; // Obter o ID do pedido

        //2. Inserir os itens do pedido
        foreach ($itens_carrinho as $item) {
            $sql_item_pedido = "INSERT INTO item_pedido (id_pedido, id_produto, quantidade, preco) VALUES (?, ?, ?, ?)";
            $stmt_item_pedido = $conn->prepare($sql_item_pedido);
            $stmt_item_pedido->bind_param("iiid", $id_pedido, $item['id_produto'], $item['quantidade'], $item['preco']);
            $stmt_item_pedido->execute();
        }

        //3. Registrar o pagamento
        $sql_pagamento = "INSERT INTO pagamento (id_pedido, valor, forma_pagamento) VALUES (?, ?, ?)";
        $stmt_pagamento = $conn->prepare($sql_pagamento);
        $stmt_pagamento->bind_param("ids", $id_pedido, $total_geral, $forma_pagamento);
        $stmt_pagamento->execute();

        //4. Limpar o carrinho (sessão ou banco de dados, dependendo de onde você está armazenando)
        unset($_SESSION['carrinho']); // Limpa o carrinho da sessão

        // Redirecionar para uma página de sucesso
        header("Location: pagamento_sucesso.php?id_pedido=" . $id_pedido);
        exit();
    } else {
        echo "Erro ao processar o pedido: " . $conn->error;
    }
}

$conn->close();
