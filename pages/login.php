<?php
// Inicializa a variável de redirecionamento e validações
$login = "login.php";
$validacoes = [];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'name' está preenchido
    if (empty($_POST['name'])) {
        $validacoes[] = "Por favor, preencha o campo do USUÁRIO.";
    }

    // Verifica se o campo 'senha' está preenchido
    if (empty($_POST['senha'])) {
        $validacoes[] = "Por favor, preencha o campo da SENHA.";
    }

    // Se não houver validações, redireciona para a página principal
    if (count($validacoes) === 0) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/styles.css">
</head>
<body class = "login-body">
    <div class="login-container">
        <h1>Login</h1>
        <?php if (count($validacoes) > 0): ?>
            <ul class="errors">
                <?php foreach ($validacoes as $validacao): ?>
                    <li><?= $validacao ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="<?= $login ?>" method="POST" class="login-form">
            <div class="form-group">
                <input type="text" name="name" placeholder="Digite o USUÁRIO" required>
            </div>
            <div class="form-group">
                <input type="password" name="senha" placeholder="Digite a SENHA" required>
            </div>
            <div class="form-group">
                <input type="submit" name="confirmacao" value="ENVIAR">
            </div>
        </form>
    </div>
</body>
</html>
