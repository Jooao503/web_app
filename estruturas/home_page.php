<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>
    <p>Você está logado com sucesso.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>
    <p>Você está logado com sucesso.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>
    <p>Você está logado com sucesso.</p>
    <a href="logout.php">Sair</a>
</body>
</html>