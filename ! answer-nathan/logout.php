<?php

    // start session
    session_start();

    // remove user session
    unset( $_SESSION['user'] );

    // redirect the user back to index.php
    header("Location: index.php");
    exit;