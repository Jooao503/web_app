<?php
// ------- PROCESSAR RESERVA --------
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $evento = trim($_POST["evento"]);

    if ($nome && $email && $evento) {
        $reserva = "Evento: $evento | Nome: $nome | Email: $email | Data: " . date("d/m/Y H:i") . "\n";
        file_put_contents("reservas.txt", $reserva, FILE_APPEND);
        $msg = "✅ Reserva realizada com sucesso!";
    } else {
        $msg = "⚠️ Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
            border: 1px solid #ccc;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            padding: 10px;
            color: white;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .success {
            padding: 10px;
            background: #28a745;
            color: white;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }
        .error {
            padding: 10px;
            background: #dc3545;
            color: white;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>📝 Fazer Reserva</h1>

    <?php if ($msg) : ?>
        <div class="<?php echo strpos($msg, 'sucesso') !== false ? 'success' : 'error'; ?>">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Selecione o Evento:</label>
        <select name="evento" required>
            <option value="">-- Escolha um evento --</option>
            <option value="Show de Rock">Show de Rock</option>
            <option value="Workshop de Programação">Workshop de Programação</option>
            <option value="Festa de Ano Novo">Festa de Ano Novo</option>
        </select>

        <label>Seu Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>

        <label>Seu E-mail:</label>
        <input type="email" name="email" placeholder="email@exemplo.com" required>

        <button type="submit" class="btn">Enviar Reserva</button>
    </form>

</body>
</html