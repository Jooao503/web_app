<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $status = 1;
    $qtd_acesso = 0;

    $stmt = $pdo->prepare("INSERT INTO usuarios (login, senha, nome, tipo, status, Quant_acesso) 
                       VALUES (:login, :senha, :nome, :tipo, :status, :qtd_acesso)");
$stmt->execute([
    ':login' => $login,
    ':senha' => $senha,
    ':nome' => $nome,
    ':tipo' => $tipo,
    ':status' => $status,
    ':qtd_acesso' => $qtd_acesso
]);

    echo "Usuário cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style-cadas.css"> <!-- Mesmo CSS do index.php -->
</head>
<body>
    <div class="wrapper">
        <form action="cadastro.php" method="post">
            <h1>Cadastro</h1>

            <div class="input-box">
                <input type="text" placeholder="Login" name="login" required>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Senha" name="senha" required>
            </div>

            <div class="input-box">
                <input type="name" placeholder="Nome" name="nome" required>
            </div>
            
            <div class="input-box">
                <input type="text" placeholder="Tipo" name="tipo" required>
                
            </div>
                <button type="submit" class="btn">Cadastrar</button>
                <div class="register-link">
                    <p>Já tem uma conta? <a href="index.php">Entrar</a></p>
            </div>
            
        </form>
    </div>
</body>
</html>
