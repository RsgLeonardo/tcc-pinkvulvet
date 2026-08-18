<?php
require_once '../../../../config/conect.php';
include_once 'auth.php';


// Capturar dados do formulário
$email = $_POST['email'];
$senha_digitada = $_POST['senha']; // Importante mudar o nome da variável para diferenciar

// Proteger contra injeção de SQL (apenas no email)
$email = $conn->real_escape_string($email);

// Consultar o banco de dados
$sql = "SELECT id_cliente, senha, nome FROM cliente WHERE email='$email'"; // Selecionar id, senha e nome
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Obter os dados do usuário

    // Verificar a senha usando password_verify()
    if (password_verify($senha_digitada, $row['senha'])) {
        // Login bem-sucedido
        $_SESSION['id_usuario'] = $row['id_cliente'];
        $_SESSION['nome_usuario'] = $row['nome'];
        $_SESSION['logado'] = true;


        // Redirecionar
        $redirect = $_POST['redirect'] ?? '../../../../index.php'; // Redireciona para a página inicial por padrão
        header("Location: " . $redirect . (strpos($redirect, '?') === false ? '?' : '&') . "login=success");
        exit();
    } else {
        // Senha incorreta
        echo "E-mail ou senha inválidos.";
    }
} else {
    // Usuário não encontrado
    echo "E-mail ou senha inválidos.";
}

$conn->close();
?>