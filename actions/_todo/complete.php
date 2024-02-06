<?php
$database = connectToDB();

// capture data from POST
$todo_completed = $_POST["todo_completed"];
$todo_id = $_POST["todo_id"];

// check state and update accordingly
if ($todo_completed == 0) {
  // SQL command
  $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
} else if ($todo_completed == 1) {
  // SQL command
  $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
}
// prepare query
$query = $database -> prepare($sql);
// execute query with placeholder (security)
$query -> execute(["id" => $todo_id]);

// redirect to home
header("Location: /");
exit;