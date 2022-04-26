<?php
if (isset($_POST["edit"])) {
    $id = $_POST['id'];
    $Old = $_POST['old'];
    $User = $_POST['user'];
    $Name = $_POST['name'];
    $Addr1 = $_POST['addr1'];
    $Addr2 = $_POST['addr2'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $Zip = $_POST['zip'];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputEdit($id, $User, $Name, $Addr1, $City, $State, $Zip) !== false) {
        header("location: ../editprofile.php?error=emptyinput");
        exit();
    }
    if (strlen($User) > 50) {
        header("location: ../editprofile.php?error=userlength");
        exit();
    }
    if (strlen($Name) > 50) {
        header("location: ../editprofile.php?error=namelength");
        exit();
    }
    if (strlen($Addr1) > 100) {
        header("location: ../editprofile.php?error=addr1length");
        exit();
    }
    if (strlen($Addr2) > 100) {
        header("location: ../editprofile.php?error=addr2length");
        exit();
    }
    if (strlen($City) > 100) {
        header("location: ../editprofile.php?error=citylength");
        exit();
    }
    if (strlen($Zip) < 5) {
        header("location: ../editprofile.php?error=zipshort");
        exit();
    }
    if (strlen($Zip) > 9) {
        header("location: ../editprofile.php?error=ziplength");
        exit();
    }
    if ($Old != $User) {
        if (userExists($conn, $User) !== false) {
            header("location: ../editprofile.php?error=usertaken");
            exit();
        }
    }
    editUser($conn, $id, $User, $Name, $Addr1, $Addr2, $City, $State, $Zip);
}
?>