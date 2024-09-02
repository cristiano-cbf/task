<?php
session_start();
include_once '../classes/Task_Manager.php';

// Verifica se o TaskManager já está na sessão
if (!isset($_SESSION['taskManager'])) {
    // Se não estiver, redireciona para a página de index
    header("Location: ../pages/index.php");
    exit;
}

// Recupera o TaskManager da sessão
$tasksManager = unserialize($_SESSION['taskManager']);

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $completed = isset($_POST['completed']) ? true : false;

    // Adiciona a nova tarefa ao TaskManager
    $tasksManager->add_task($title, $description, $completed);

    // Atualiza o TaskManager na sessão
    $_SESSION['taskManager'] = serialize($tasksManager);

    // Redireciona para a página principal
    header("Location: ../pages/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Task</title>
    
    <link rel="stylesheet" type = "text/css" href="../CSS/styles.css">
    
</head>
<body>
    <h1>Adicionar Nova Task</h1>
    <form action="add_task.php" method="post">
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required><br><br>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <button type="submit">Adicionar</button>
    </form>
    <a href="../pages/index.php"><button>Voltar</button></a>
</body>
</html>
