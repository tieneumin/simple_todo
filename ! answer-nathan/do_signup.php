<?php

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
   $name = $_POST["name"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];

   // Step 4: error checking
    // 4.1 make sure all the fields are not empty
   if ( empty( $name ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
        echo "All the fields are required.";
   } else if ( $password !== $confirm_password ) {
        // 4.2 - make sure password is match
        echo "The password is not match";
   } else if ( strlen( $password ) < 8 ) {
        // 4.3 - make sure the password length is at least 8 chars
        echo "Your password must be at least 8 characters";
   } else {
        // step 5: create the user account
            // 5.1 - sql command (recipe)
            $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
            // 5.2 - prepare (put everything into th bowl)
            $query = $database->prepare( $sql );
            // 5.3 - execute (cook it)
            $query->execute([
                'name' => $name,
                'email' => $email,
                'password' => password_hash( $password, PASSWORD_DEFAULT )
            ]);

        // Step 6: redirect back to login.php
        header("Location: login.php");
        exit;

   }