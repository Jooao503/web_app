<?php
session_start();
include_once ('db.php');

// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $res = $pdo->query("SELECT * FROM usuarios WHERE email = '$email'");
    $usuario = $res->fetch();

    if ($usuario && $senha === $usuario['senha']) { // <-- sem password_verify
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['primeiro_acesso'] = $usuario['primeiro_acesso'];
    } else {
        echo "Login inválido<br>";
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: usuarios.php");
}

// Excluir
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->query("DELETE FROM usuarios WHERE id = $id");
    header("Location: usuarios.php");
}
?>

<?php if (!isset($_SESSION['usuario_id'])): ?>
    <h2>Login</h2>
    <form method="POST">
        Email: <input type="email" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="cadastro.php">Cadastrar novo usuário</a></p>
<?php else: ?>
    <h2>Bem-vindo!</h2>
    <p><a href="?logout=1">Sair</a></p>

    <h3>Usuários cadastrados:</h3>
    <ul>
        <?php
        $res = $pdo->query("SELECT * FROM usuarios");
        foreach ($res as $u) {
            echo "<li>{$u['nome']} ({$u['email']}) 
                  <a href='?delete={$u['id']}'>[Excluir]</a></li>";
        }
        ?>
    </ul>
<?php endif; ?>
