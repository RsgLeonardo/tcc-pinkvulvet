<?php
require_once '../../../config/conect.php';
require_once '../cadastro-login/login/auth.php';

$id_produto = isset($_GET['id']) ? intval($_GET['id']) : 0;

$is_favorited = false;
if (verificar_login() && $id_produto > 0) {
    $id_cliente = obter_id_usuario();
    $sql_check_fav = "SELECT COUNT(*) FROM favoritos WHERE id_cliente = ? AND id_produto = ?";
    $stmt_check_fav = $conn->prepare($sql_check_fav);
    if ($stmt_check_fav) {
        $stmt_check_fav->bind_param("ii", $id_cliente, $id_produto);
        $stmt_check_fav->execute();
        $stmt_check_fav->bind_result($count);
        $stmt_check_fav->fetch();
        $stmt_check_fav->close();
        if ($count > 0) {
            $is_favorited = true;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar_carrinho'])) {

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    $quantidade_a_adicionar = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;
    if ($quantidade_a_adicionar <= 0) {
        $quantidade_a_adicionar = 1;
    }

    $produto_no_carrinho = false;
    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['id_produto'] == $id_produto) {
            $item['quantidade'] += $quantidade_a_adicionar;
            $produto_no_carrinho = true;
            break;
        }
    }

    if (!$produto_no_carrinho) {
        $_SESSION['carrinho'][] = [
            'id_produto' => $id_produto,
            'quantidade' => $quantidade_a_adicionar,
        ];
    }

    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => '✅ Produto adicionado ao carrinho com sucesso!']);
    exit();
}

$sql = "SELECT nome, imagem, preco, descricao FROM produto WHERE id_produto = $id_produto";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $produto = $resultado->fetch_assoc();
    $nome_produto = $produto['nome'];
    $caminho_imagem = '../../../fotos/produtos/' . $produto['imagem'];
    $preco_produto = $produto['preco'];
    $descricao_produto = $produto['descricao'];
} else {
    $nome_produto = "Produto não encontrado.";
    $caminho_imagem = "path/to/default-image.jpg";
    $preco_produto = "0.00";
    $descricao_produto = "Descrição não encontrada.";
}

$conn->close();
?>
