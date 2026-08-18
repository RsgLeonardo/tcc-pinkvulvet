<?php
// Caminho para o arquivo de conexão e autenticação (ajuste conforme a estrutura do seu projeto)
require_once __DIR__ . '/../../../config/conect.php';
require_once __DIR__ . '/../cadastro-login/login/auth.php'; // Inclua o auth.php


// Verifica se o usuário está logado. Se não, redireciona para a página de login.
if (!verificar_login()) {
    // Redireciona para a página de login, passando a URL atual para redirecionamento após o login
    header("Location: " . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/pinkvulvet/aplicacao/src/conta/opcoes.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

$id_cliente = obter_id_usuario();

$produtos_favoritos = []; // Inicializa o array de produtos favoritados

// Consulta SQL para buscar os produtos favoritados pelo cliente
$sql = "SELECT p.id_produto, p.nome, p.preco, p.imagem, p.descricao
        FROM produto p
        INNER JOIN favoritos f ON p.id_produto = f.id_produto
        WHERE f.id_cliente = ?
        ORDER BY p.nome ASC";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    error_log("Erro ao preparar a consulta de favoritos: " . $conn->error);
    // Em produção, você pode exibir uma mensagem de erro mais amigável ao usuário
} else {
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos_favoritos[] = $row;
        }
    }
    $stmt->close();
}

$conn->close();
