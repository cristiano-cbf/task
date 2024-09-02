<?php

include 'Task.php';

class TaskManager {
    
    public $lista = [];

    function __construct($lista = []) {
        $this->lista = $lista;
    }

    function add_task($title, $description, $completed = false) {

        $task = new Task($title, $description, $completed);
   
        $this->lista[] = $task;
    }

    // Obtém todas as tarefas
    function get_tasks() {
        return $this->lista;
    }

   // Edita uma tarefa existente pelo índice
    function edit_task($id, $title, $description, $completed = false) {
        if (isset($this->lista[$id])) {
            $task = $this->lista[$id];
            $task->setTitle($title);
            $task->setDescription($description);
            $task->completed = $completed; // Atualiza o status diretamente, se preferir.
        } else {
            throw new Exception("Tarefa não encontrada no índice fornecido.");
        }
    }

    // Exclui uma tarefa existente pelo índice
    function delete_task($id) {
        if (isset($this->lista[$id])) {
            unset($this->lista[$id]);
            $this->lista = array_values($this->lista); // Reindexa o array após a exclusão
        } else {
            throw new Exception("Tarefa não encontrada no índice fornecido.");
        }
    }
}
/*

// Exemplo de uso da classe TaskManager
$tasks = new TaskManager([
    new Task("Lavar Louça", "Lavar todos os pratos", false),
    new Task("Estudar PHP", "Estudar classes e objetos", true),
    new Task("Exercício Físico", "Caminhada de 30 minutos", false),
    new Task("Leitura", "Ler 20 páginas de um livro", true)
]);

// Edita uma tarefa existente (por exemplo, tarefa no índice 1)
$tasks->edit_task(1, "Estudar PHP Avançado", "Estudar conceitos avançados de PHP", false);

// Adiciona uma nova tarefa
$tasks->add_task("Comprar mantimentos", "Comprar leite, pão e ovos", false);

// Delete uma tarefa
$tasks->delete_task(2);

// Exibe as tarefas
echo "<pre>";
print_r($tasks);
echo "</pre>";

*/
?>