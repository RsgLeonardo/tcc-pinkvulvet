<?php
session_start();
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "pinkvulvet");
// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
// require_once '../../../config/conect.php';
?>