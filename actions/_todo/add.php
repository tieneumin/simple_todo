<?php
$database = connectToDB();

// capture data from POST
$todo_label = $_POST["todo_label"];

// error-checking
// ensure field filled
if (empty($todo_label)) {
  setError("Field cannot be empty.", "/");
}

// add label to database under logged-in user
// SQL command
$sql = 'INSERT INTO todos (`label`,`user_id`) VALUES (:label, :user_id)';
// prepare query
$query = $database -> prepare($sql);
// execute query with placeholder (security)
$query -> execute([
  "label" => $todo_label,
  "user_id" => $_SESSION["user"]['id']
]);

// redirect to home
header("Location: /");
exit;