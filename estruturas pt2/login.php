<?php
session_start();

// Simulação de banco de dados
$usuarios = [
    'admin' => ['senha' => '1234', 'primeiro_acesso' => false],
    'joao'  => ['senha' => 'abcd', 'primeiro_acesso' => true]
];

// Inicializa contador
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
}

// Verifica bloqueio
$bloqueado = $_SESSION['tentativas'] >= 3;

// LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$bloqueado) {

    $usuario = $_POST['usuario'] ?? '';
    $senha   = $_POST['senha'] ?? '';

    // Verifica usuário e senha
    if (isset($usuarios[$usuario]) && $usuarios[$usuario]['senha'] === $senha) {

        // Reset tentativas
        $_SESSION['tentativas'] = 0;

        // Primeiro acesso
        if ($usuarios[$usuario]['primeiro_acesso']) {
            $_SESSION['usuario_temp'] = $usuario;
            header('Location: primeiro_acesso.php');
            exit;
        }

        // Login normal
        $_SESSION['usuario'] = $usuario;
        header('Location: home.php');
        exit;

    } else {
        // Erro de login
        $_SESSION['tentativas']++;

        $restantes = 3 - $_SESSION['tentativas'];

        if ($restantes > 0) {
            $erro = "Usuário ou senha incorretos. Restam $restantes tentativa(s).";
        } else {
            $erro = "⛔ Conta bloqueada! Tente novamente mais tarde.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - WebApp</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #0056b3;
        }
        .erro {
            color: red;
            font-size: 14px;
        }
        .bloqueado {
            color: darkred;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login WebApp</h2>

    <?php if (isset($erro)): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <?php if ($bloqueado): ?>
        <p class="bloqueado">⛔ Acesso bloqueado por 3 tentativas incorretas.</p>
    <?php else: ?>
        <form method="post" action="">
            <input type="text" name="usuario" placeholder="Usuário" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>
            <button type="submit">Entrar</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>