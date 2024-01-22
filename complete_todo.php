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

// 3. Capture id and updated state from $_POST
$todo_completed = $_POST["todo_completed"];
$todo_id = $_POST["todo_id"];

// 4. Check state in database and change accordingly
if ($todo_completed == 0) {
// SQL command
$sql = "UPDATE todos SET completed = 1 WHERE id = :id";
} else if ($todo_completed == 1) {
// SQL command
$sql = "UPDATE todos SET completed = 0 WHERE id = :id";
}

// prepare database
$query = $database -> prepare($sql);
// execute the above
$query -> execute(
  ["id" => $todo_id]
);

// 5. Redirect user to index.php
header("Location: index.php");
exit;