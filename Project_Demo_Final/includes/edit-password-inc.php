<?php
    if (isset($_POST["newPass"])) {
        $UnivID = $_SESSION["University_id"];
            $id = $_POST["id"];
            $Old = $_POST["old"];
            $New = $_POST["new"];
            $Confirm = $_POST["confirm"];

            require_once 'dbh-inc.php';
            require_once 'functions-inc.php';
    
            if (emptyInputUpdatePass($Old, $New, $Confirm) !== false) {
                header("location: ../edit-password.php?error=emptyinput");
                exit();
            }
            else if ($New != $Confirm) {
                header("location: ../edit-password.php?error=doesNotMatch");
                exit();
            }
            updatePass($conn, $id, $Old, $New);
    }
?>