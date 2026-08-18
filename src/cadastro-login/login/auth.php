<?php

// Função para verificar se o usuário está logado
function verificar_login()
{
    return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
}

// Função para obter o ID do usuário logado
function obter_id_usuario()
{
    return isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;
}

// Função para obter o nome do usuário logado
function obter_nome_usuario()
{
    return isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : null;
}
?>