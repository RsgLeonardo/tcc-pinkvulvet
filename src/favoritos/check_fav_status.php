<?php
require_once __DIR__ . '/../../../config/conect.php';
require_once __DIR__ . '/../cadastro-login/login/auth.php';

header('Content-Type: application/json');


$response = ['is_favorited' => false, 'success' => false];

if (!verificar_login()) {
    echo json_encode($response);
    exit();
}

$id_cliente = obter_id_usuario();
$id_produto = isset($_GET['id_produto']) ? intval($_GET['id_produto']) : 0;

if ($id_produto <= 0) {
    echo json_encode($response);
    exit();
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM favoritos WHERE id_cliente = ? AND id_produto = ?");
$stmt->bind_param("ii", $id_cliente, $id_produto);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    $response['is_favorited'] = true;
}
$response['success'] = true; // A requisição foi processada com sucesso, mesmo que não esteja favoritado

$conn->close();
echo json_encode($response);
?>