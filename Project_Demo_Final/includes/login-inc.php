<?php

if (isset($_POST["submit"])) {
    $User = $_POST["user"];
    $Pass = $_POST["pwd"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputLogin($User, $Pass) !== false) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    loginUser($conn, $User, $Pass);
}