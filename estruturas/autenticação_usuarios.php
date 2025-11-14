<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Autenticador Simples</title>
  <link rel="stylesheet" href="style-aut.css">
</head>
<body>
  <h2>Cadastro</h2>
  <input id="cadUsuario" placeholder="Usuário" />
  <input id="cadSenha" placeholder="Senha" type="password" />
  <button onclick="cadastrar()">Cadastrar</button>

  <div id="mensagem"></div>

  <script>
    function salvarUsuarios(usuarios) {
      localStorage.setItem('usuarios', JSON.stringify(usuarios));
    }

    function carregarUsuarios() {
      const usuariosJSON = localStorage.getItem('usuarios');
      return usuariosJSON ? JSON.parse(usuariosJSON) : {};
    }

    function cadastrar() {
      const usuario = document.getElementById('cadUsuario').value.trim();
      const senha = document.getElementById('cadSenha').value;

      if (!usuario || !senha) {
        mostrarMensagem('Preencha usuário e senha para cadastro', true);
        return;
      }

      let usuarios = carregarUsuarios();

      if (usuarios[usuario]) {
        mostrarMensagem('Usuário já existe!', true);
        return;
      }

      usuarios[usuario] = senha;
      salvarUsuarios(usuarios);

      mostrarMensagem('Usuário cadastrado com sucesso!');
      limparCampos('cadUsuario', 'cadSenha');
    }

    function logar() {
      const usuario = document.getElementById('logUsuario').value.trim();
      const senha = document.getElementById('logSenha').value;

      if (!usuario || !senha) {
        mostrarMensagem('Preencha usuário e senha para login', true);
        return;
      }

      let usuarios = carregarUsuarios();

      if (usuarios[usuario] && usuarios[usuario] === senha) {
        mostrarMensagem(`Login bem-sucedido! Bem-vindo, ${usuario}`);
        limparCampos('logUsuario', 'logSenha');
      } else {
        mostrarMensagem('Usuário ou senha inválidos', true);
      }
    }

    function trocarSenha() {
      const usuario = document.getElementById('userTroca').value.trim();
      const senhaAtual = document.getElementById('senhaAtual').value;
      const novaSenha = document.getElementById('novaSenha').value;

      if (!usuario || !senhaAtual || !novaSenha) {
        mostrarMensagem('Preencha todos os campos para trocar a senha', true);
        return;
      }

      let usuarios = carregarUsuarios();

      if (!usuarios[usuario]) {
        mostrarMensagem('Usuário não encontrado', true);
        return;
      }

      if (usuarios[usuario] !== senhaAtual) {
        mostrarMensagem('Senha atual incorreta', true);
        return;
      }

      usuarios[usuario] = novaSenha;
      salvarUsuarios(usuarios);

      mostrarMensagem('Senha alterada com sucesso!');
      limparCampos('userTroca', 'senhaAtual', 'novaSenha');
    }

    function mostrarMensagem(msg, erro = false) {
      const div = document.getElementById('mensagem');
      div.textContent = msg;
      if (erro) {
        div.classList.remove('sucesso');
        div.classList.add('erro');
      } else {
        div.classList.remove('erro');
        div.classList.add('sucesso');
      }

      // Apaga a mensagem após 5 segundos
      clearTimeout(div.timeout);
      div.timeout = setTimeout(() => {
        div.textContent = '';
        div.classList.remove('erro', 'sucesso');
      }, 5000);
    }

    function limparCampos(...ids) {
      ids.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
      });
    }
  </script>
</body>
</html>