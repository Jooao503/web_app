<?php
session_start();

// Verifica se veio do login
if (!isset($_SESSION['usuario_temp'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario_temp'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if ($nova_senha === $confirmar && strlen($nova_senha) >= 4) {
        // Aqui salvaria no banco de dados a nova senha
        // e marcaria o primeiro_acesso = false

        unset($_SESSION['usuario_temp']);
        $_SESSION['usuario'] = $usuario;

        header('Location: home.php');
        exit;
    } else {
        $erro = "As senhas não coincidem ou são muito curtas (mínimo 4 caracteres).";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Primeiro Acesso</title>
</head>
<body>
    <h2>Primeiro acesso de <?php echo htmlspecialchars($usuario); ?></h2>

    <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Nova senha:</label><br>
        <input type="password" name="nova_senha" required><br><br>

        <label>Confirmar senha:</label><br>
        <input type="password" name="confirmar" required><br><br>

        <button type="submit">Salvar nova senha</button>
    </form>
</body>
</html>