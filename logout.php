<?php
// Start session
session_start();

// Unset user session
unset($_SESSION['user']);

// Redirect user to index.php
header("Location: index.php");
exit;