<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: usuarios.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova = $_POST['nova_senha'];
    $id = $_SESSION['usuario_id'];

    $pdo->query("UPDATE usuarios SET senha = '$nova', primeiro_acesso = 0 WHERE id = $id");

    $_SESSION['primeiro_acesso'] = 0;
    header("Location: usuarios.php");
}
?>

<h2>Trocar senha</h2>
<form method="POST">
    Nova senha: <input type="password" name="nova_senha"><br>
    <button type="submit">Salvar</button>
</form>
