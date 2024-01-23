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

// 3. Capture signup details via $_POST
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// 4. Check for errors
// 4.1 Ensure all fields not empty
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
  echo "All fields are required.<br>
  <a href='signup.php'>Go back</a>";
  // 4.2 Ensure passwords match
} else if ($password !== $confirm_password) {
  echo "The passwords do not match.<br>
  <a href='signup.php'>Go back</a>";
  // 4.3 Ensure password >=8 characters 
} else if (strlen($password ) < 8) {
  echo "Your password must be at least 8 characters.<br>
  <a href='signup.php'>Go back</a>";
} else {
  // 5. Create user account
  // 5.1 SQL command
  $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
  // 5.2 Prepare SQL query
  $query = $database -> prepare($sql);
  // 5.3 Execute above query
  $query -> execute ([
      'name' => $name,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
  ]);

  // 6. Redirect user to login
  header("Location: login.php");
  exit;
}