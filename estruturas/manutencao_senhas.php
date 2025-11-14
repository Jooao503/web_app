<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Manutenção de Senhas</title>
  <link rel="stylesheet" href="style-man.css">
</head>
<body>

  <h1>Login</h1>
  <input id="logUsuario" placeholder="Usuário" />
  <input id="logSenha" placeholder="Senha" type="password" />
  <button onclick="logar()">Login</button>

  <hr />

  <h2>Trocar Senha</h2>
  <input id="userTroca" placeholder="Usuário" />
  <input id="senhaAtual" placeholder="Senha Atual" type="password" />
  <input id="novaSenha" placeholder="Nova Senha" type="password" />
  <button onclick="trocarSenha()">Trocar Senha</button>

  </div>

  <div id="mensagem"></div>
  <div id="erro"></div>

  <script>
    // Função para salvar usuários no localStorage
    function salvarUsuarios(usuarios) {
      localStorage.setItem('usuarios', JSON.stringify(usuarios));
    }

    // Função para carregar usuários do localStorage
    function carregarUsuarios() {
      const usuariosJSON = localStorage.getItem('usuarios');
      return usuariosJSON ? JSON.parse(usuariosJSON) : {};
    }

    // Função para mostrar mensagem (sucesso)
    function mostrarMensagem(msg) {
      document.getElementById('mensagem').textContent = msg;
      document.getElementById('erro').textContent = '';
    }

    // Função para mostrar erro
    function mostrarErro(msg) {
      document.getElementById('erro').textContent = msg;
      document.getElementById('mensagem').textContent = '';
    }

    // Cadastrar usuário
    function cadastrar() {
      const usuario = document.getElementById('cadUsuario').value.trim();
      const senha = document.getElementById('cadSenha').value;

      if (!usuario || !senha) {
        mostrarErro('Preencha usuário e senha para cadastro');
        return;
      }

      let usuarios = carregarUsuarios();

      if (usuarios[usuario]) {
        mostrarErro('Usuário já existe!');
        return;
      }

      usuarios[usuario] = senha;
      salvarUsuarios(usuarios);
      mostrarMensagem('Usuário cadastrado com sucesso!');
      
      // Limpa campos
      document.getElementById('cadUsuario').value = '';
      document.getElementById('cadSenha').value = '';
    }

    // Login
    function logar() {
      const usuario = document.getElementById('logUsuario').value.trim();
      const senha = document.getElementById('logSenha').value;

      if (!usuario || !senha) {
        mostrarErro('Preencha usuário e senha para login');
        return;
      }

      let usuarios = carregarUsuarios();

      if (usuarios[usuario] && usuarios[usuario] === senha) {
        localStorage.setItem('usuarioLogado', usuario);
        mostrarMensagem(`Login bem-sucedido! Bem-vindo, ${usuario}`);
        document.getElementById('areaTrocaSenha').style.display = 'block';
        document.getElementById('logUsuario').value = '';
        document.getElementById('logSenha').value = '';
      } else {
        mostrarErro('Usuário ou senha inválidos');
      }
    }

    // Trocar senha (usuário já logado)
    function trocarSenha() {
      const novaSenha = document.getElementById('novaSenha').value;
      const usuarioLogado = localStorage.getItem('usuarioLogado');

      if (!usuarioLogado) {
        mostrarErro('Você precisa fazer login primeiro');
        return;
      }

      if (!novaSenha) {
        mostrarErro('Informe a nova senha');
        return;
      }

      let usuarios = carregarUsuarios();
      usuarios[usuarioLogado] = novaSenha;
      salvarUsuarios(usuarios);

      mostrarMensagem('Senha alterada com sucesso!');
      document.getElementById('novaSenha').value = '';
    }

    // Logout
    function logout() {
      localStorage.removeItem('usuarioLogado');
      mostrarMensagem('Você saiu da conta');
      document.getElementById('areaTrocaSenha').style.display = 'none';
    }

    // Verifica se já tem usuário logado na carga da página
    window.onload = function() {
      const usuarioLogado = localStorage.getItem('usuarioLogado');
      if (usuarioLogado) {
        mostrarMensagem(`Você está logado como ${usuarioLogado}`);
        document.getElementById('areaTrocaSenha').style.display = 'block';
      }
    }
  </script>
</body>
</html>