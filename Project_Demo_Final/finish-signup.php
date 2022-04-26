<?php
    include_once 'header.php';
?>
    <?php
        if (isset($_SESSION['User_id'])) {
            $UserID = $_SESSION["User_id"];
            require_once 'includes/dbh-inc.php';
            require_once 'includes/functions-inc.php';
        ?>
            <section class="signup-form">
                <h2>To finish signing up fill out required(*) fields below:</h2>
                <div class = "signup-form-form">
                    <form action="includes/signup-inc.php" method="post">
                        <h3>*Full Name:</h3>
                            <input type="text" name="name" placeholder="Full Name..."><br><br>
                        <h3>*Address 1:</h3>
                            <input type="text" name="addr1" placeholder="Address 1..."><br><br>
                        <h3>Address 2:</h3>
                            <input type="text" name="addr2" placeholder="Address 2..."><br><br>
                        <h3>*City:</h3>
                            <input type="text" name="city" placeholder="City..."><br><br>
                        <h3>*State:</h3>
                            <select name="state"> <!--required-->
                                <option value="" disabled selected>---Select State---</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select> <br><br>
                        <h3>*Zip:</h3>
                            <input type="text" name="zip" placeholder="Zip Code..."><br><br>
                        <button type="submit" name="finish">Finish Signing up</button>
                    </form>
                </div>
            </section>
        <?php
        }
    ?>
    <?php
        if(isset($_GET["error"])) {

            if($_GET["error"] == "emptyinput") {
                echo "<script>alert('Please fill in all required fields!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "namelength") {
                echo "<script>alert('Name cannot be longer than 50 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "addr1length") {
                echo "<script>alert('Address 1 cannot be longer than 100 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "addr2length") {
                echo "<script>alert('Address 2 cannot be longer than 100 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "citylength") {
                echo "<script>alert('City cannot be longer than 100 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "zipshort") {
                echo "<script>alert('Zipcode must be at least 5 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "ziplength") {
                echo "<script>alert('Zipcode cannot be longer than 9 characters!');</script>";
                echo "<script>history.back();</script>";
            }
        }
    ?>
<?php
    include_once 'footer.php';
?>