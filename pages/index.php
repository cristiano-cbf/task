<?php
session_start(); // Iniciando a SESSION
include_once '../classes/task_Manager.php'; // Certifique-se de incluir a classe TaskManager

// Verifica se o TaskManager já está na sessão
if (!isset($_SESSION['taskManager'])) {
    // Inicializa o TaskManager com alguns dados
    $tasksManager = new TaskManager([
        new Task("Lavar Louça", "Lavar todos os pratos", false),
        new Task("Estudar PHP", "Estudar classes e objetos", true),
        new Task("Exercício Físico", "Caminhada de 30 minutos", false),
        new Task("Leitura", "Ler 20 páginas de um livro", true)
    ]);

    // Serializa o TaskManager e salva na sessão
    $_SESSION['taskManager'] = serialize($tasksManager);
} else {
    // Recupera o TaskManager da sessão
    $tasksManager = unserialize($_SESSION['taskManager']);
}

// Obtém a lista de tarefas
$tasks = $tasksManager->get_tasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tasks</title>
    <link rel="stylesheet" type = "text/css" href="../CSS/styles.css">
    
     <script>
        function confirmDelete() {
            return confirm("Tem certeza que deseja excluir esta tarefa?");
        }
    </script>
</head>
<body>
    <h1>Lista de Tasks</h1>
    
    <table>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="../actions/add_task.php">
        <button type="button" class="check-btn">✚</button></a></td>
        </tr>
        <?php foreach($tasks as $index => $task): //Estrutura de Repetição para buscar os elementos do array?>
        <tr>
            <td><?php echo $task->getTitle(); ?></td>
            <td><?php echo $task->getDescription(); ?></td>
            <td><?php echo $task->isCompleted() ? 'Concluído' : 'Pendente'; ?></td>
            <td>
                <a href="../actions/edit_task.php?id=<?php echo $index; ?>"><button type="button">✎</button></a>
                   <a href="../actions/delete_task.php?id=<?php echo $index; ?>" onclick="return confirmDelete();"><button type="button" class="delete-btn">✖</button></a>
                <?php if (!$task->isCompleted()): ?>
                    <a href="../actions/mark_complete.php?id=<?php echo $index; ?>"><button type="button" class="check-btn">✔</button></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
