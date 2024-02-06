<?php
$database = connectToDB();

// capture data from POST
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// error-checking
// ensure all fields filled
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
  setError("All fields are required.", "/signup");
  // ensure passwords match
} else if ($password !== $confirm_password) {
  setError("Passwords do not match.", "/signup");
  // ensure password >=8 characters 
} else if (strlen($password ) < 8) {
  setError("Password must be at least 8 characters.", "/signup");
} else {
  // ensure email not in use 1/2
  $sql = "SELECT * FROM users WHERE email = :email";
  $query = $database -> prepare($sql);
  $query -> execute(["email" => $email]);
  $user = $query -> fetch();
  if (empty($user)) {

    // create account
    $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
    $query = $database -> prepare($sql);
    $query -> execute([
      "name" => $name,
      "email" => $email,
      "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    // confirm account creation and redirect
    setSuccess("Account successfully created.", "/login");

  // ensure email not in use 2/2
  } else {
    setError("Email is already in use.", "/signup");
  }
}