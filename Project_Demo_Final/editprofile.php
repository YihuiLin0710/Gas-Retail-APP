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
            $UserID = $_SESSION["User_id"]; 
            require_once 'includes/dbh-inc.php';
            require_once 'includes/functions-inc.php';
            $Username;
            $Name;
            $Addr1;
            $Addr2;
            $City;
            $State;
            $Zip;
    ?>  <section class="signup-form">
            <h2>To edit profile change fields below:</h2>
            <div class = "signup-form-form">
                <form action="includes/edit-profile-inc.php" method="post">
                    <?php
                        $sql = "SELECT * FROM client_info WHERE id = $UserID;";

                        $result = mysqli_query($conn , $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0) {
                            while($row = mysqli_fetch_assoc($result)) { 
                                $Username = $row['username'];
                                $Name = $row['fullname'];
                                $Addr1 = $row['addr1'];
                                $Addr2 = $row['addr2'];
                                $City = $row['city'];
                                $State = $row['state'];
                                $Zip = $row['zip'];
                            }
                        }
                    ?>
                    <input type="hidden" name="id" value='<?php echo $_SESSION["User_id"]; ?>'>
                    <input type="hidden" name="old" value='<?php echo $Username; ?>'>
                    <h3>Username:</h3>
                        <input type="text" name="user" value="<?php echo $Username;?>"><br><br>
                    <h3>Full Name:</h3>
                        <input type="text" name="name" value="<?php echo $Name;?>"><br><br>
                    <h3>Address 1:</h3>
                        <input type="text" name="addr1" value="<?php echo $Addr1;?>"><br><br>
                    <h3>Address 2:</h3>
                        <?php
                                if ($idExists['addr2'] != "") {
                                    echo "<input type='text' name='addr2' value='".$Addr2."'><br><br>";
                                }
                                else {
                                    echo "<input type='text' name='addr2' placeholder='Address 2...'><br><br>";
                                }
                            ?>
                        
                    <h3>City:</h3>
                        <input type="text" name="city" value="<?php echo $City;?>"><br><br>
                    <h3>State:</h3>
                        <select name="state">
                            <option value="<?php echo $State;?>"><?php echo $State;?></option>
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
                    <h3>Zip:</h3>
                        <input type="text" name="zip" value="<?php echo $Zip;?>"><br><br>
                    <button type="submit" name="edit">Submit Changes</button>
                </form>
                </div>
            </section>
            <div class = "signup-form-form">
                <form action="edit-password.php" method="post">
                    <button type="submit" name="submit">Change Password</button>
                </form>
            </div>
        <?php
        }
    }
    ?>
     <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<script>alert('Please fill in all required fields!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "userlength") {
                echo "<script>alert('Username is longer than 50 characters!');</script>";
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
            else if($_GET["error"] == "sql") {
                echo "<script>alert('Something went wrong, please try again!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "usertaken") {
                echo "<script>alert('Username already taken!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "none") {
                echo "<script>alert('Profile updated successfully!');</script>";
                echo "<script>history.back();</script>";
            }
        }
    ?>
<?php
    include_once 'footer.php';
?>