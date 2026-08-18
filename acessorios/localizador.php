<?php
require_once '../../../config/conect.php';

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

if (isset($_GET['acao']) && $_GET['acao'] == 'listar') {
    $sql = "SELECT * FROM produto where id_categoria = 6";
    $result = $conn->query($sql);

    $produtos = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($produtos);
    exit; // Adicionado para garantir que nada mais seja enviado
}
