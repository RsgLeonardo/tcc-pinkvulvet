<?php
require_once '../../../config/conect.php';
// Função para sincronizar o carrinho do anônimo com o usuário logado
function sincronizar_carrinho($conn, $id_cliente, $carrinho_anonimo)
{
    if ($carrinho_anonimo && !empty($carrinho_anonimo)) {
        foreach ($carrinho_anonimo as $item) {
            $id_produto = $item['id_produto'];
            $quantidade = $item['quantidade'];

            // Verifica se o item já existe no carrinho do usuário
            $stmt = $conn->prepare("SELECT quantidade FROM carrinho WHERE id_cliente = ? AND id_produto = ?");
            $stmt->bind_param("ii", $id_cliente, $id_produto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Item já existe, atualiza a quantidade
                $row = $result->fetch_assoc();
                $nova_quantidade = $row['quantidade'] + $quantidade;
                $stmt = $conn->prepare("UPDATE carrinho SET quantidade = ? WHERE id_cliente = ? AND id_produto = ?");
                $stmt->bind_param("iii", $nova_quantidade, $id_cliente, $id_produto);
                $stmt->execute();
            } else {
                // Item não existe, insere no carrinho do usuário
                $stmt = $conn->prepare("INSERT INTO carrinho (id_cliente, id_produto, quantidade) VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $id_cliente, $id_produto, $quantidade);
                $stmt->execute();
            }
        }
    }
}
