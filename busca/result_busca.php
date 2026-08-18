<?php
require_once __DIR__ . '/../../../config/conect.php';

// 3. Obter e sanitizar o termo de busca enviado via GET
// O nome 'termo_busca' deve corresponder ao atributo 'name' do input no formulário de busca
$termo_busca = '';
if (isset($_GET['termo_busca']) && !empty(trim($_GET['termo_busca']))) {
    $termo_busca = trim($_GET['termo_busca']); // Remove espaços em branco antes e depois
}

// 4. Lógica de Consulta ao Banco de Dados (APENAS SE HOUVER UM TERMO DE BUSCA VÁLIDO)
$produtos_encontrados = []; // Inicializa um array vazio para armazenar os produtos resultantes

if (!empty($termo_busca)) {
    // Prepara o termo de busca para usar na cláusula LIKE.
    // O '%' é um curinga que corresponde a qualquer sequência de caracteres, permitindo busca parcial.
    $termo_sql = "%" . $termo_busca . "%";

    // Consulta SQL para buscar produtos por nome ou descrição.
    // Usamos prepared statements para prevenir SQL Injection, substituindo variáveis diretamente na query por '?'
    $sql = "SELECT id_produto, nome, preco, imagem, descricao 
            FROM produto 
            WHERE nome LIKE ? OR descricao LIKE ? 
            ORDER BY nome ASC";

    $stmt = $conn->prepare($sql); // Prepara a consulta

    // Verifica se a preparação da consulta falhou
    if ($stmt === false) {
        // Em um ambiente de desenvolvimento, 'die()' pode ser útil para depuração.
        // Em produção, registre o erro (error_log) e mostre uma mensagem amigável ao usuário.
        error_log("Erro ao preparar a consulta de busca: " . $conn->error);
        // Exemplo para produção: $mensagem_erro_backend = "Ocorreu um erro ao buscar os produtos. Tente novamente mais tarde.";
    } else {
        // Vincula os parâmetros à query. 'ss' indica que ambos os '?' são strings.
        $stmt->bind_param("ss", $termo_sql, $termo_sql);
        $stmt->execute(); // Executa a consulta com os parâmetros seguros
        $resultado = $stmt->get_result(); // Obtém o conjunto de resultados da consulta

        // Processa os resultados para serem exibidos na parte Frontend
        if ($resultado->num_rows > 0) {
            while ($produto = $resultado->fetch_assoc()) {
                $produtos_encontrados[] = $produto; // Adiciona cada produto ao array
            }
        }
        $stmt->close(); // Fecha o statement para liberar recursos
    }
}
// O array $produtos_encontrados e a variável $termo_busca estarão disponíveis para a seção Frontend.
