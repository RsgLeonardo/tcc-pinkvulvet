<?php
require_once '../../../../config/conect.php';

function validarSenha($senha)
{
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]).{8,16}$/';
    return preg_match($regex, $senha) && strlen($senha) >= 8;
}

function calcularIdade($dataNascimento)
{
    $hoje = new DateTime();
    $nascimento = new DateTime($dataNascimento);
    $idade = $hoje->diff($nascimento)->y;
    return $idade;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nascimento = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    $erros = [];
    // tirei telefone
    if (empty($nome) || empty($cpf) || empty($data_nascimento) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $erros[] = "Todos os campos são obrigatórios.";
    }

    if ($senha != $confirmar_senha) {
        $erros[] = "As senhas não coincidem.";
    }

    if (str_word_count($nome) < 2) {
        $erros[] = "Por favor, insira seu nome completo.";
    }

    if (calcularIdade($data_nascimento) < 13) {
        $erros[] = "Você deve ter pelo menos 13 anos para criar uma conta.";
    }

    if (!validarSenha($senha)) {
        $erros[] = "A senha deve ter entre 8 e 16 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial.";
    }

    // Adicione aqui a validação do CPF se necessário no servidor

    if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<p style='color:red;'>$erro</p>";
        }
        die();
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO cliente (nome, cpf, data_nascimento, telefone, email, senha) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nome, $cpf, $data_nascimento, $telefone, $email, $senha_hash);

        if ($stmt->execute()) {
            $id_cliente = $conn->insert_id;
            echo "Cadastro realizado com sucesso!";
            header("Location: ../usandoAPI/cada-end.php?id_cliente=" . urldecode($id_cliente));
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    }
}
