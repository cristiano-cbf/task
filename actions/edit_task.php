<?php
session_start();
include_once '../classes/Task_Manager.php';

// Verifica se o TaskManager já está na sessão
if (!isset($_SESSION['taskManager'])) {
    header("Location: ../pages/index.php");
    exit;
}

// Recupera o TaskManager da sessão
$tasksManager = unserialize($_SESSION['taskManager']);

// Verifica se o índice da tarefa foi fornecido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../pages/index.php");
    exit;
}

$taskId = (int)$_GET['id'];
$tasks = $tasksManager->get_tasks();

if (!isset($tasks[$taskId])) {
    header("Location: ../pages/index.php");
    exit;
}

$taskToEdit = $tasks[$taskId];

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $completed = isset($_POST['completed']) ? true : false;

    // Edita a tarefa
    $tasksManager->edit_task($taskId, $title, $description, $completed);

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
    <title>Editar Task</title>
    
    <link rel="stylesheet" type = "text/css" href="../CSS/styles.css">
    
</head>
<body>
    <h1>Editar Task</h1>
    <form action="edit_task.php?id=<?php echo $taskId; ?>" method="post">
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($taskToEdit->getTitle()); ?>" required><br><br>
        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($taskToEdit->getDescription()); ?></textarea><br><br>
        <button type="submit" class="check-btn">Atualizar</button>
    </form>
    <a href="../pages/index.php"><button>Voltar</button></a>
</body>
</html>
