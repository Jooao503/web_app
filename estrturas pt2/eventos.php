<?php
require 'db.php'; // conexão com banco

// ---------------- PROCESSAR RESERVA -----------------
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $evento_id = $_POST["evento_id"];
    $nome      = trim($_POST["nome"]);
    $email     = trim($_POST["email"]);

    if ($evento_id && $nome && $email) {

        // INSERIR NO BANCO
        $stmt = $pdo->prepare("
            INSERT INTO reservas (evento_id, nome, email, data_hora)
            VALUES (:evento_id, :nome, :email, NOW())
        ");

        $stmt->execute([
            ':evento_id' => $evento_id,
            ':nome'      => $nome,
            ':email'     => $email
        ]);

        $msg = "Reserva realizada com sucesso!";
    } else {
        $msg = "Por favor, preencha todos os campos.";
    }
}

// --------- EVENTOS (poderiam vir do banco também) ----------
$eventos = [
    [
        "id" => 1,
        "nome" => "Show de Rock",
        "data" => "2025-12-10",
        "hora" => "20:00",
        "local" => "Arena SP",
        "capacidade" => 15000,
        "imagem" => "img/show_rock.jpg",
        "descricao" => "Um grande show com várias bandas de rock."
    ],
    [
        "id" => 2,
        "nome" => "Workshop de Programação",
        "data" => "2025-11-20",
        "hora" => "09:00",
        "local" => "Centro Tech",
        "capacidade" => 200,
        "imagem" => "img/workshop_programacao.jpg",
        "descricao" => "Aprenda PHP, JavaScript e muito mais!"
    ],
    [
        "id" => 3,
        "nome" => "Festa de Ano Novo",
        "data" => "2025-12-31",
        "hora" => "22:00",
        "local" => "Praia Central",
        "capacidade" => 50000,
        "imagem" => "img/festa_ano_novo.jpg",
        "descricao" => "A maior festa de réveillon da região!"
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Eventos e Reservas</title>
    <link rel="stylesheet" href="style-cadas.css"> <!-- Pode usar o mesmo CSS -->
</head>
<body>

    <div class="wrapper">
        <h1>Eventos Disponíveis</h1>

        <!-- LISTAGEM DE EVENTOS -->
        <?php foreach ($eventos as $evento) : ?>
            <div class="evento">
                <img src="<?= $evento['imagem'] ?>" 
                     alt="<?= $evento['nome'] ?>"
                     style="width:100%; border-radius:10px; margin-bottom:10px;">

                <h2><?= $evento["nome"] ?></h2>
                <p><strong>Data:</strong> <?= $evento["data"] ?></p>
                <p><strong>Local:</strong> <?= $evento["local"] ?></p>
                <p><?= $evento["descricao"] ?></p>
            </div>
        <?php endforeach; ?>

        <h2>Faça sua Reserva</h2>

        <?php if ($msg): ?>
            <div class="msg">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <!-- FORMULÁRIO -->
        <form action="reservas.php" method="POST">

            <div class="input-box">
                <select name="evento_id" required>
                    <option value="">Selecione o evento</option>

                    <?php foreach ($eventos as $evento): ?>
                        <option value="<?= $evento["id"] ?>">
                            <?= $evento["nome"] ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="input-box">
                <input type="text" name="nome" placeholder="Seu nome" required>
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Seu e-mail" required>
            </div>

            <button type="submit" class="btn">Enviar Reserva</button>
        </form>

    </div>

</body>
</html>
