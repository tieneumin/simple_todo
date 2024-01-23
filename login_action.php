<?php
// Start session
session_start();

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

// 3. Capture form data via $_POST
$email = $_POST["email"];
$password = $_POST["password"];

// 4. Check for errors
if (empty($email) || empty($password)) {
  echo "All fields are required.<br>
  <a href='login.php'>Go back</a>";
} else {
  // 5. Login the user
  // 5.1 Retrieve data from users table using email user provided
  // 5.1.1 SQL command
  $sql = "SELECT * FROM users WHERE email = :email";
  // 5.1.2 Prepare SQL query
  $query = $database -> prepare($sql);
  // 5.1.3 Execute above query with placeholder
  $query -> execute (
    ['email' => $email]
  );
  // 5.1.4 Fetch login details
  $user = $query -> fetch(); // get only 1 row of data
  // echo var_dump($user);

  // 5.2 Ensure $user not empty 
  // $user returns false if not found, hence empty and not isset
  if (empty($user)) {
    echo "The email provided does not exist.<br>
    <a href='login.php'>Back to login</a> | 
    <a href='signup.php'>Sign up</a>";
  } else {
  // 5.3 Ensure password correct
    if (password_verify($password,$user["password"])) {
      // 5.4 If password valid, login user
      $_SESSION["user"] = $user;
      // 6. Redirect user to index.php
      header("Location: index.php");
      exit;
    } else {
      echo "The password is incorrect.<br>
      <a href='login.php'>Go back</a>";
    }
  }
}