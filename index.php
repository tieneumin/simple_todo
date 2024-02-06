<?php
// start session
session_start();

require "actions/functions.php";
// echo $test . "<br>"; // sanity check
require "actions/OOP_auth.php";
require "actions/OOP_todo.php";

// // current session credentials
// if (isLoggedIn()) {
//   print_r($_SESSION["user"]);
// } 

// Uniform Resource Identifier requested by prior page i.e. header("Location: X");
$path = $_SERVER["REQUEST_URI"];
// var_dump($_SERVER["REQUEST_URI"]); // current route

// // // remove query from URL in GET scenario
// $path = parse_url($path, PHP_URL_PATH);

// remove starting slash
$path = trim($path, "/");

$auth = new Auth();
$todo = new Task();

switch ($path) {
  // actions
  case "signup_action":
    $auth -> signup();
    break;
  case "login_action":
    $auth -> login();
    break;
  case "logout_action":
    $auth -> logout();
    break;
  case "add_todo":
    $todo -> add();
    break;
  case "complete_todo":
    $todo -> complete();
    break;
  case "delete_todo":
    $todo -> delete();
    break;

  // pages
  case "signup":
    $subpage_title = "Sign Up";
    require "pages/signup.php";
    break;
  case "login":
    $subpage_title = "Login";
    require "pages/login.php";
    break;
  default:
    $subpage_title = "Home";
    require "pages/home.php";
    break;
}