<?php
$database = connectToDB();

// capture data from POST
$todo_id = $_POST["todo_id"];

// delete label via filtering by id
// SQL command
$sql = "DELETE FROM todos where id = :id";
// prepare SQL query
$query = $database -> prepare($sql);
// execute query with placeholder 
$query -> execute(["id" => $todo_id]);

// redirect to home
header("Location: /");
exit;

 