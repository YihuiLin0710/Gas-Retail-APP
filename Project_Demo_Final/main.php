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
    <div class="center-wrapper">
        <div class="center">
            <a href="fuel-quote.php">
                <button>Fuel Quote Form</button>
            </a>
        </div>
        <br><br>
        <div class="center">
            <a href="history.php">
                <button>Fuel Quote History</button>
            </a>
        </div>
    </div>
    <?php
        }
    }
    ?>
    <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "login") {
                echo '<script>alert("Login Successful!")</script>';
            }
        }
    ?>
<?php
    include_once 'footer.php';
?>