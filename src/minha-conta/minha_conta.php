<?php
include '../cadastro-login/login/auth.php'; // Inclui o arquivo de autenticação
require_once '../../../config/conect.php'; // Inclui o arquivo de conexão com o banco de dados

// Verificar se o usuário está logado
if (!verificar_login()) {
    header("Location: ../cadastro-login/login/form_login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

$id_cliente = obter_id_usuario();

// Buscar dados do cliente
$sql_cliente = "SELECT nome, email, telefone, cpf, data_nascimento FROM cliente WHERE id_cliente = ?";
$stmt_cliente = $conn->prepare($sql_cliente);
$stmt_cliente->bind_param("i", $id_cliente);
$stmt_cliente->execute();
$result_cliente = $stmt_cliente->get_result();

if ($result_cliente->num_rows > 0) {
    $dados_cliente = $result_cliente->fetch_assoc();
} else {
    // Tratar o caso em que o cliente não foi encontrado
    header("Location: minha_conta_form.php?status=error&message=" . urlencode("Cliente não encontrado."));
    exit();
}

// Buscar endereço do cliente
$sql_endereco = "SELECT endereco, numero, complemento, bairro, cidade, estado, cep FROM endereco WHERE id_cliente = ?";
$stmt_endereco = $conn->prepare($sql_endereco);
$stmt_endereco->bind_param("i", $id_cliente);
$stmt_endereco->execute();
$result_endereco = $stmt_endereco->get_result();

if ($result_endereco->num_rows > 0) {
    $dados_endereco = $result_endereco->fetch_assoc();
} else {
    $dados_endereco = array(
        'endereco' => '',
        'numero' => '',
        'complemento' => '',
        'bairro' => '',
        'cidade' => '',
        'estado' => '',
        'cep' => ''
    );
}

// Processar solicitação de alteração de email
if (isset($_POST['alterar_email'])) {
    $novo_email = $_POST['novo_email'];
    // Valide o novo email (verifique o formato, se já existe, etc.)
    if (!filter_var($novo_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: minha_conta_form.php?status=error&message=" . urlencode("Por favor, insira um endereço de e-mail válido."));
        exit();
    }

    $sql_alterar_email = "UPDATE cliente SET email = ? WHERE id_cliente = ?";
    $stmt_alterar_email = $conn->prepare($sql_alterar_email);
    $stmt_alterar_email->bind_param("si", $novo_email, $id_cliente);

    if ($stmt_alterar_email->execute()) {
        // Atualizar a sessão com o novo email, se necessário
        $_SESSION['email_usuario'] = $novo_email;
        header("Location: minha_conta_form.php?status=success&message=" . urlencode("Email alterado com sucesso!"));
        exit();
    } else {
        header("Location: minha_conta_form.php?status=error&message=" . urlencode("Erro ao alterar email: " . $stmt_alterar_email->error));
        exit();
    }
}

// Processar solicitação de alteração de senha
if (isset($_POST['alterar_senha'])) {
    $nova_senha = $_POST['nova_senha'];

        // Validação da nova senha no lado do servidor
        if (strlen($nova_senha) < 8 || strlen($nova_senha) > 16 || // Verifica o comprimento da senha
        !preg_match('/[A-Z]/', $nova_senha) || // Pelo menos uma letra maiúscula
        !preg_match('/[a-z]/', $nova_senha) || // Pelo menos uma letra minúscula
        !preg_match('/[0-9]/', $nova_senha) || // Pelo menos um número
        !preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\-]/', $nova_senha)) { // Pelo menos um caractere especial
        header("Location: minha_conta_form.php?status=error&message=" . urlencode("A senha deve ter entre 8 e 16 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial."));
        exit(); // Interrompe a execução se a senha não for válida
    }

    // Valide a nova senha (verifique o comprimento, requisitos de segurança, etc.)

    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT); // Hash da nova senha

    $sql_alterar_senha = "UPDATE cliente SET senha = ? WHERE id_cliente = ?";
    $stmt_alterar_senha = $conn->prepare($sql_alterar_senha);
    $stmt_alterar_senha->bind_param("si", $nova_senha_hash, $id_cliente);

    if ($stmt_alterar_senha->execute()) {
        header("Location: minha_conta_form.php?status=success&message=" . urlencode("Senha alterada com sucesso!"));
        exit();
    } else {
        header("Location: minha_conta_form.php?status=error&message=" . urlencode("Erro ao alterar senha: " . $stmt_alterar_senha->error));
        exit();
    }
}