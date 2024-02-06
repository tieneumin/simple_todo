<?php
$database = connectToDB();

// capture data from POST
$email = $_POST["email"];
$password = $_POST["password"];

// error-checking
// ensure all fields filled
if (empty($email) || empty($password)) {
  setError("All fields are required.", "/login");
} else {
  // retrieve user with said email via placeholder query (security)
  $sql = "SELECT * FROM users WHERE email = :email";
  $query = $database -> prepare($sql);
  $query -> execute (['email' => $email]);
  $user = $query -> fetch(); // fetch 1 row
  // ensure user exists
  // $user returns false if not found, hence empty and not isset
  if (empty($user)) {
    setError("Account does not exist.", "/login");
  } else {
    // ensure correct password 1/2
    if (password_verify($password, $user["password"])) {

      // log user in
      $_SESSION["user"] = $user;
      
      // redirect to home
      header("Location: /");
      exit;

    // ensure correct password 1/2  
    } else {
      setError("Incorrect password.", "/login");
    }
  }
}