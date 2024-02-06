<?php

    // start session
    session_start();

   // step 1: list out all the database info
   $host = 'mysql';
   $database_name = 'php_docker';
   $database_user = 'root';
   $database_password = 'secret';

   // Step 2: connect to the database
   $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );

  // Step 3: get all the data from the form using $_POST
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Step 4: error checking
  if ( empty( $email ) || empty( $password ) ) {
        echo "All the fields are required.";
  } else {
    // Step 5: login the user
     // 5.1 - retrieve the user data from your users table using the email provided by the user
      // 5.1.1 - sql command (recipe)
      $sql = "SELECT * FROM users WHERE email = :email";
      // 5.1.2 - prepare
      $query = $database->prepare($sql);
      // 5.1.3 - execute
      $query->execute([
        'email' => $email
      ]);
      // 5.1.4 - fetch 
      $user = $query->fetch(); // get only one row of data
      
      // 5.2 - make sure the $user is not empty
      if ( empty( $user ) ) {
        echo "The email provided does not exists";
      } else {
        // 5.3 - make sure the password is correct
        if ( password_verify( $password, $user["password"] ) ) {
          // 5.4 - if password is valid, login the user
          $_SESSION["user"] = $user;

          // Step 6: redirect back to index.php
          header("Location: index.php");
          exit;
        } else {
          echo "The password provided is incorrect";
        }
      }


  }

