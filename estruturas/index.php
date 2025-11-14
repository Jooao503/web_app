<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Web App</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
          crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Boxicons (optional, for icons) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper">
        <form action="cadastro.php">
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Nome" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Senha" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" /> mostrar</label>
                <a href="#">Esqueceu sua senha?</a>
            </div>

            <button type="submit" class="btn">Entrar</button>

            <div class="register-link">
                <p>Não tem uma conta? <a href="autenticacao.php">Cadastre-se</a></p>
                <p><a href="manutencao.php"></a></p>
            </div>
        </form>
    </div>

    <script>
    const checkbox = document.querySelector('input[type="checkbox"]');
    const passwordInput = document.querySelector('input[type="password"]');

    checkbox.addEventListener('change', function () {
      if (this.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  </script>

</body>
</html>