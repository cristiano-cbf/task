<?php
session_start();
include_once '../classes/Task_Manager.php';

// Verifica se o TaskManager está na sessão
if (!isset($_SESSION['taskManager'])) {
    header("Location: ../pages/index.php");
    exit;
}

// Recupera o TaskManager da sessão
$tasksManager = unserialize($_SESSION['taskManager']);

// Verifica se o índice da tarefa foi fornecido e é válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../pages/index.php");
    exit;
}

$taskId = (int)$_GET['id'];

// Marca a tarefa como concluída
$task = $tasksManager->get_tasks()[$taskId];
if (!$task->isCompleted()) {
    $tasksManager->edit_task($taskId, $task->getTitle(), $task->getDescription(), true);
}

// Atualiza o TaskManager na sessão
$_SESSION['taskManager'] = serialize($tasksManager);

// Redireciona de volta para a página principal
header("Location: ../pages/index.php");
exit;
?>
