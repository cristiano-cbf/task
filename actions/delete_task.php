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

// Verifica se o índice da tarefa foi fornecido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../pages/index.php");
    exit;
}

$taskId = (int)$_GET['id'];

// Exclui a tarefa
$tasksManager->delete_task($taskId);

// Atualiza o TaskManager na sessão
$_SESSION['taskManager'] = serialize($tasksManager);

// Redireciona para a página principal
header("Location: ../pages/index.php");
exit;
?>
