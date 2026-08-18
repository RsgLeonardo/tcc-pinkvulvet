<?php
// Caminho para o arquivo de conexão e autenticação
require_once __DIR__ . '/../../../config/conect.php'; // Ajuste o caminho conforme necessário
require_once __DIR__ . '/../cadastro-login/login/auth.php'; // Inclua o auth.php para verificar login e obter ID do usuário

header('Content-Type: application/json'); // Garante que a resposta será JSON


// Verifica se o usuário está logado
if (!verificar_login()) {
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado para favoritar produtos.']);
    exit();
}

$id_cliente = obter_id_usuario();

// Recebe os dados JSON da requisição
$data = json_decode(file_get_contents('php://input'), true);

$id_produto = isset($data['id_produto']) ? intval($data['id_produto']) : 0;
$acao = isset($data['acao']) ? $data['acao'] : ''; // 'favoritar' ou 'desfavoritar'

if ($id_produto <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID do produto inválido.']);
    exit();
}

if ($acao === 'favoritar') {
    // Verifica se o produto já está favoritado para evitar duplicatas
    $sql_check = "SELECT COUNT(*) FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
    $stmt_check = $conn->prepare($sql_check);
    if (!$stmt_check) {
        echo json_encode(['success' => false, 'message' => 'Erro ao preparar consulta de verificação: ' . $conn->error]);
        exit();
    }
    $stmt_check->bind_param("ii", $id_cliente, $id_produto);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_row();
    $stmt_check->close();

    if ($row_check[0] > 0) {
        echo json_encode(['success' => true, 'message' => 'Produto já está nos favoritos.']);
        $conn->close();
        exit();
    }

    // Insere o produto nos favoritos
    $sql_insert = "INSERT INTO favoritos (id_cliente, id_produto) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        echo json_encode(['success' => false, 'message' => 'Erro ao preparar inserção: ' . $conn->error]);
        exit();
    }
    $stmt_insert->bind_param("ii", $id_cliente, $id_produto);

    if ($stmt_insert->execute()) {
        echo json_encode(['success' => true, 'message' => 'Produto adicionado aos favoritos!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao adicionar aos favoritos: ' . $conn->error]);
    }
    $stmt_insert->close();

} elseif ($acao === 'desfavoritar') {
    // Remove o produto dos favoritos
    $sql_delete = "DELETE FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if (!$stmt_delete) {
        echo json_encode(['success' => false, 'message' => 'Erro ao preparar exclusão: ' . $conn->error]);
        exit();
    }
    $stmt_delete->bind_param("ii", $id_cliente, $id_produto);

    if ($stmt_delete->execute()) {
        if ($stmt_delete->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Produto removido dos favoritos!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Produto não encontrado nos favoritos para remoção.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao remover dos favoritos: ' . $conn->error]);
    }
    $stmt_delete->close();

} else {
    echo json_encode(['success' => false, 'message' => 'Ação inválida.']);
}

$conn->close();
?>