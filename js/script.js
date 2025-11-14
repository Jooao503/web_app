document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const usernameInput = form.querySelector("input[type='text']");
  const passwordInput = form.querySelector("input[type='password']");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Evita que o formulário recarregue a página

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

    // Verifica se os campos estão vazios
    if (username === "" || password === "") {
      alert("Por favor, preencha todos os campos.");
      return;
    }

    // Simula uma autenticação (pode ser substituída por API real depois)
    if (username === "admin" && password === "1234") {
      alert("Login bem-sucedido!");
      // Redireciona para outra página, se quiser:
      // window.location.href = "dashboard.html";
    } else {
      alert("Usuário ou senha incorretos.");
    }
  });
});
