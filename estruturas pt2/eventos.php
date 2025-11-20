<?php
// ------- CONFIGURAÇÃO DOS EVENTOS --------
$eventos = [
    [
        "id" => 1,
        "nome" => "Show de Rock",
        "data" => "2025-12-10",
        "local" => "Arena SP",
        "descricao" => "Um grande show com várias bandas de rock."
    ],
    [
        "id" => 2,
        "nome" => "Workshop de Programação",
        "data" => "2025-11-20",
        "local" => "Centro Tech",
        "descricao" => "Aprenda PHP, JavaScript e muito mais!"
    ],
    [
        "id" => 3,
        "nome" => "Festa de Ano Novo",
        "data" => "2025-12-31",
        "local" => "Praia Central",
        "descricao" => "A maior festa de réveillon da região!"
    ]
];

// ------- PROCESSAR RESERVA --------
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $evento_id = $_POST["evento_id"];
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);

    if ($evento_id && $nome && $email) {
        $reserva = "Evento ID: $evento_id | Nome: $nome | Email: $email | Data: " . date("d/m/Y H:i") . "\n";
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
    <title>Eventos e Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        .evento {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            border: 1px solid #ccc;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .success {
            padding: 10px;
            background: #28a745;
            color: white;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .error {
            padding: 10px;
            background: #dc3545;
            color: white;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>📅 Eventos Disponíveis</h1>

    <!-- LISTAGEM DE EVENTOS -->
    <?php foreach ($eventos as $evento) : ?>
        <div class="evento">
            <h2><?php echo $evento["nome"]; ?></h2>
            <p><strong>📅 Data:</strong> <?php echo $evento["data"]; ?></p>
            <p><strong>📍 Local:</strong> <?php echo $evento["local"]; ?></p>
            <p><?php echo $evento["descricao"]; ?></p>
        </div>
    <?php endforeach; ?>

    <!-- FORMULÁRIO DE RESERVA -->
    <h2>📝 Faça sua Reserva</h2>

    <?php if ($msg) : ?>
        <div class="<?php echo strpos($msg, 'sucesso') !== false ? 'success' : 'error'; ?>">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="evento_id">Selecione o Evento:</label>
        <select name="evento_id" required>
            <option value="">-- Escolha um evento --</option>
            <?php foreach ($eventos as $evento) : ?>
                <option value="<?php echo $evento["id"]; ?>">
                    <?php echo $evento["nome"]; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Seu Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>

        <label>Seu E-mail:</label>
        <input type="email" name="email" placeholder="email@exemplo.com" required>

        <button type="submit" class="btn">Enviar Reserva</button>
    </form>

</body>
</html>
