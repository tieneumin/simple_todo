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
// var_dump($database);

// 3. Capture label from $_POST
$todo_label = $_POST["todo_label"];
// var_dump($todo_label);

// 3.5 Check if label is empty
if (empty($todo_label)){
  echo "Please enter a task.<br>
  <a href='index.php'>Return</a>";
} else {
  // 4. Add label to database
  // SQL command
  $sql = "INSERT INTO todos (`label`) VALUES (:label)";
  // prepare database
  $query = $database -> prepare($sql);
  // execute the above
  $query -> execute(
    ["label" => $todo_label]
  );

  // 5. Redirect user to index.php
  header("Location: index.php");
  exit;
}

 