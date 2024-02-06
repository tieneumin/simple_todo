<?php
// log user out
unset($_SESSION['user']);

// redirect
header("Location: /");
exit;