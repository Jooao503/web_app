<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bd_crud_php';

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>