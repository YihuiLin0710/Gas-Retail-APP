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
            if (isset($_POST['addFuel'])) {
                $id = $_POST['id'];
                $Gal = $_POST['gal'];
                $Addr = $_POST['addr'];
                $Deliver = $_POST['deliver'];
                $Suggest = $_POST['suggest'];
                $Total = $_POST['total'];

                require_once 'includes/dbh-inc.php';
                require_once 'includes/functions-inc.php';
                date_default_timezone_set('America/Chicago');
                $Date = date('m/d/Y', time());
                #$Date = date('Y/m/d', time());
                if (emptyInputFuelQuote($id, $Gal, $Addr, $Deliver) !== false) {
                    header("location: fuel-quote.php?error=emptyinput");
                    exit();
                }
                if (strlen($Gal) > 12) {
                    header("location: fuel-quote.php?error=gallength");
                    exit();
                }
                if (strtotime($Deliver) < strtotime($Date)) {
                    header("location: fuel-quote.php?error=passeddate");
                    exit();
                }
                if (dateAddrSet($conn, $id, $Addr, $Deliver) !== false) {
                    header("location: fuel-quote.php?error=dateaddrset");
                    exit();
                }
                $idExists = idExists($conn, $id);
                $currentPrice = 1.50;
                $LocFact = "";
                $rateHistFact = "";
                $GalReqFact = "";
                $CompProfFact = 0.10;
                if ($idExists['state'] == "TX") {
                    $LocFact = 0.02;
                }
                else {
                    $LocFact = 0.04;
                }
                if (hasHistory($conn, $id) !== false) {
                    $rateHistFact = 0.01;
                } 
                else {
                    $rateHistFact = 0.00;
                }
                if ($Gal > 1000) {
                    $GalReqFact = 0.02;
                }
                else {
                    $GalReqFact = 0.03;
                }

                $Margin = $currentPrice * ($LocFact-$rateHistFact+$GalReqFact+$CompProfFact);
                
                $Suggest = $currentPrice + $Margin;
                $Total = $Gal * $Suggest;

?>
                <section class="final-signup-form">
                <h2>Fuel Quote Form:</h2>
                <div class="final-signup-form-form">
                <form action="includes/fuel-quote-inc.php" method="post">
                    <input type="hidden" name="id" value='<?php echo $id; ?>'>
                    <h3>Gallons:</h3>
                    <input type = "number" name="gal" value="<?php echo $Gal;?>" readonly><br><br>
                    <h3>Address:</h3>
                    <input type = "text" name="addr" value="<?php echo $Addr;?>" readonly><br><br>
                    <h3>Deliver Date:</h3>
                    <input type="date" name="deliver" value="<?php echo $Deliver;?>" readonly><br><br>
                    <h3>Suggested (Price/Gal):</h3>
                        <input type='text' name='suggest' value='<?php echo $Suggest;?>' readonly><br><br>
                    <h3>Total</h3>
                        <input type='text' name='total' value='<?php echo $Total;?>' readonly><br><br>
                    <button type="submit" name="addFuel">Submit</button> <br><br>
                </form>
                </div>
            </section>
            <div class="addUser">
                <a href="javascript:history.go(-1)" class="button">Alter Form</a>
            </div>
            <?php
            }
        }
    }
 ?>
 <?php
    include_once 'footer.php';
?>