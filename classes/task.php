<?php

class Task{

    public $title;
    public $description;
    public $completed ;

    function __construct($title, $description, $completed){

        $this->title = $title;
        $this->description = $description;
        $this->completed = $completed;
    }

    function markAsCompleted(){//: marca a tarefa como concluída.
        $this->completed = true;
    }

    function markAsIncompleted(){//: marca a tarefa como NÃO concluída.
        $this->completed = false;
    }

    function getTitle(){//retorna o título da tarefa.
        return  $this->title;
        
    }

    function setTitle($newTilte){//Redefine o Título
        $this->title = $newTilte;
    }

    function getDescription() {//retorna a descrição da tarefa.
        return  $this->description;
        
    }

    function setDescription($newDescription){//Redefine a Descrição
        $this->description = $newDescription;
    }

    function isCompleted() {//retorna um booleano indicando se a tarefa está concluída ou não.
    
        return  $this->completed;
    }
    
    
}

