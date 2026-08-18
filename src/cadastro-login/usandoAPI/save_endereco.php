<?php
require_once '../../../../config/conect.php'; // Inclui a conexão com o banco
include_once('viacep.php'); // Inclui a lógica do ViaCEP

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba e valide o id_cliente
    $id_cliente = filter_input(INPUT_POST, 'id_cliente', FILTER_VALIDATE_INT);
    if (!$id_cliente) {
        die("Erro: ID do cliente inválido.");
    }
    $id_cliente = $_POST['id_cliente'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    // Validação dos dados (***ADICIONE VALIDAÇÕES APROPRIADAS***)
    if (empty($cep) || empty($endereco) || empty($numero) || empty($bairro) || empty($cidade) || empty($estado)) {
        die("Todos os campos de endereço são obrigatórios.");
    }

    // Se você quiser usar a API do ViaCEP para preencher automaticamente (opcional)
    // Você pode manter essa lógica aqui, mas lembre-se de validar os dados recebidos do formulário
    // mesmo se usar a API.

    $stmt_endereco = $conn->prepare("INSERT INTO endereco (id_cliente, cep, endereco, numero, complemento, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_endereco->bind_param("isssssss", $id_cliente, $cep, $endereco, $numero, $complemento, $bairro, $cidade, $estado);

    if ($stmt_endereco->execute()) {
        echo "Endereço cadastrado com sucesso!";
        header("Location: ../login/form_login.php"); // Redirecione para onde desejar
    } else {
        echo "Erro ao cadastrar endereço: " . $stmt_endereco->error;
    }

    $stmt_endereco->close();
}
