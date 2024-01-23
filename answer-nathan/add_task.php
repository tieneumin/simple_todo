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

  // Step 3: grab the label from $_POST
  $task_name = $_POST["task_name"];

   // do error checking and check if $task_name is empty or not
   if ( empty( $task_name ) ) {
    echo 'Please enter a task name';
   } else {
    // Step 4: add the task into the database
        // 4.1 - sql command
        $sql = 'INSERT INTO todos (`label`) VALUES (:label)';
        // 4.2 - prepare 
        $query = $database->prepare($sql);
        // 4.3 - execute
        $query->execute([
            'label' => $task_name
        ]);

      // Step 5: redirect the user back to index.php
        header("Location: index.php");
        exit;
   }