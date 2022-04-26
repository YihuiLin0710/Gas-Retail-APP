<?php
if (isset($_POST["addFuel"])) {
    $id = $_POST['id'];
    $Gal = $_POST['gal'];
    $Addr = $_POST['addr'];
    $Deliver = $_POST['deliver'];
    $Suggest = $_POST['suggest'];
    $Total = $_POST['total'];
    
    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if (emptyInputFuel($id, $Gal, $Addr, $Deliver, $Suggest, $Total) !== false) {
        header("location: ../fuel-quote.php?error=emptyinput");
        exit();
    }
    if (strlen($Gal) > 12) {
        header("location: ../fuel-quote.php?error=gallength");
        exit();
    }
    addFuelQuote($conn, $id, $Gal, $Addr, $Deliver, $Suggest, $Total);
}
?>