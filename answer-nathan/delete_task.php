<?php

    // step 1: list out all the database info
    $host = 'mysql';
    $database_name = 'php_docker';
    $database_user = 'root';
    $database_password = 'secret';

    // Step 2: connect to the database to PHP
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // Step 3: grab the task_id from $_POST
    $task_id = $_POST["task_id"];

    // Step 4: delete the task from database
        // 4.1 - sql command (recipe)
        $sql = "DELETE FROM todos where id = :id";
        // 4.2 - prepare (put everything into the bowl)
        $query = $database->prepare($sql);
        // 4.3 - execute (cook it)
        $query->execute([
            'id' => $task_id
        ]);
    
    // Step 5: redirect back to index.php
    header("Location: index.php");
    exit;