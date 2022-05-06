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
            <section class="final-signup-form">
                <h2>Fuel Quote Form:</h2>
                <div class="final-signup-form-form">
                <form action="fuel-quote-quote.php" method="post">
                    <input type="hidden" name="id" value='<?php echo $_SESSION["User_id"]; ?>'>
                    <h3>Gallons:</h3>
                    <input type = "number" name="gal" placeholder="Gallons..."><br><br>
                    <h3>Address:</h3>
                        <select name="addr" required>
                            <option value="" disabled selected>---Select address---</option>
                            <option value='<?php echo $idExists['addr1'];?>'><?php echo $idExists['addr1'];?></option>
                            <?php
                                if ($idExists['addr2'] != "") {
                                    echo "<option value='".$idExists['addr2']."'>".$idExists['addr2']."</option>";
                                }
                            ?>
                        </select><br><br>
                    <h3>Deliver Date:</h3>
                    <input type="date" name="deliver"><br><br>
                    <h3>Suggested (Price/Gal):</h3>
                    <input type="text" name="suggest" placeholder="Suggested (Price/Gal)..." readonly><br><br>
                    <h3>Total</h3>
                    <input type="text" name="total" placeholder="Total..." readonly><br><br>
                    <button type="submit" name="addFuel">Get Quote</button> <br><br>
                </form>
            </div>
            </section>
    <?php
        }
    }
    ?>
    <?php
        if(isset($_GET["error"])) {
            if(isset($_GET["error"])) {
                if($_GET["error"] == "emptyinput") {
                    echo "<script>alert('Fill in all required fields!');</script>";
                    echo "<script>history.back();</script>";
                }
                else if($_GET["error"] == "stmtfailed") {
                    echo "<script>alert('Something went wrong, please try again!');</script>";
                    echo "<script>history.back();</script>";
                }
                else if($_GET["error"] == "gallength") {
                    echo "<script>alert('Gallons is larger than a trillion!');</script>";
                    echo "<script>history.back();</script>";
                }
                else if($_GET["error"] == "passeddate") {
                    echo "<script>alert('Delivery date set before today!');</script>";
                    echo "<script>history.back();</script>";
                }
                else if($_GET["error"] == "dateaddrset") {
                    echo "<script>alert('That address already has a request on that date!');</script>";
                    echo "<script>history.back();</script>";
                }
                else if($_GET["error"] == "none") {
                    header("location: main.php?error=fueladded");
                    exit();
                }
                
            }
        }
    ?>
<?php
    include_once 'footer.php';
?>