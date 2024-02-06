<?php
// store all functions
$test = "functions.php patching correctly";

function connectToDB() {
  // database credentials
  $host = 'devkinsta_db';
  $database_name = 'To_Do_List';
  $database_user = 'root';
  $database_password = 'in4VkcqsYWTIdopj';

  // connect to database
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );
      
  return $database;
}

function isLoggedIn() {
  return isset($_SESSION["user"]);
}
   
function setError($error_message, $redirect_page) {
  $_SESSION["error"] = $error_message;
  // redirect appropriately
  header("Location: " . $redirect_page);
  exit;
}

function setSuccess($success_message, $redirect_page) {
  $_SESSION["success"] = $success_message;
  // redirect appropriately
  header("Location: " . $redirect_page);
  exit;
}

