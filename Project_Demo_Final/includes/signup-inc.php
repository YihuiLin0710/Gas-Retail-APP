<?php

if (isset($_POST["submit"])) {
    $User = $_POST["user"];
    $Pass = $_POST["pwd"];
    $Confirm = $_POST["confirm"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputSignup($User, $Pass, $Confirm) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (strlen($User) > 50) {
        header("location: ../signup.php?error=userlength");
        exit();
    }
    if ($Pass !== $Confirm) {
        header("location: ../signup.php?error=matchpwd");
        exit();
    }
    if (strlen($Pass) > 50) {
        header("location: ../signup.php?error=passlength");
        exit();
    }
    if (userExists($conn, $User) !== false) {
        header("location: ../signup.php?error=uidtaken");
        exit();
    }
    createUser($conn, $User, $Pass);
}


if (isset($_POST["finish"])) {
    session_start();
    $id = $_SESSION['User_id'];
    $Name = $_POST['name'];
    $Addr1 = $_POST['addr1'];
    $Addr2 = $_POST['addr2'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $Zip = $_POST['zip'];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputFinishSignup($id, $Name, $Addr1, $City, $State, $Zip) !== false) {
        header("location: ../finish-signup.php?error=emptyinput");
        exit();
    }
    if (strlen($Name) > 50) {
        header("location: ../finish-signup.php?error=namelength");
        exit();
    }
    if (strlen($Addr1) > 100) {
        header("location: ../finish-signup.php?error=addr1length");
        exit();
    }
    if (strlen($Addr2) > 100) {
        header("location: ../finish-signup.php?error=addr2length");
        exit();
    }
    if (strlen($City) > 100) {
        header("location: ../finish-signup.php?error=citylength");
        exit();
    }
    if (strlen($Zip) < 5) {
        header("location: ../finish-signup.php?error=zipshort");
        exit();
    }
    if (strlen($Zip) > 9) {
        header("location: ../finish-signup.php?error=ziplength");
        exit();
    }
    finishUser($conn, $id, $Name, $Addr1, $Addr2, $City, $State, $Zip);
}
?>