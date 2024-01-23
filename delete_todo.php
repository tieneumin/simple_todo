<?php
// 1. List database info e.g. DevKinsta Site Info 
$host = "devkinsta_db"; 
$database_name = "To_Do_List"; 
$database_user = "root";
$database_password = "in4VkcqsYWTIdopj"; 

// 2. Connect database to .php
$database = new PDO(
  "mysql:host=$host;dbname=$database_name",
  $database_user,
  $database_password
);

// 3. Capture id from $_POST
$todo_id = $_POST["todo_id"];
// var_dump($todo_id);

// 4. Delete label from database via id
// SQL command
$sql = "DELETE FROM todos where id = :id";
// prepare SQL query
$query = $database -> prepare($sql);
// execute the above with placeholder
$query -> execute(
  ["id" => $todo_id]
);

// 5. Redirect user to index.php
header("Location: index.php");
exit;

 