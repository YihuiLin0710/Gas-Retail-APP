<?php
    include_once 'header.php';
    if (isset($_SESSION['User_id'])) {
        require_once 'includes/dbh-inc.php';
        require_once 'includes/functions-inc.php';
        $idExists = idExists($conn, $_SESSION["User_id"]);
        if (empty($idExists['fullname'])) {
            header("location: finish-signup.php");
            exit();
        }
        else {
?>
    <?php
            createHistoryTable($conn, $_SESSION["User_id"]);
        }
    }
    ?>
    <?php
        if(isset($_GET["error"])) {
        }
    ?>
<?php
    include_once 'footer.php';
?>