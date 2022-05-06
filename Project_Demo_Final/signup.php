<?php
    include_once 'header.php';
?>
    <section class="signup-form"> <!--signup-form-->
        <h2>To signup fill out fields below:</h2>
        <div class="signup-form-form">
            <form action="includes/signup-inc.php" method="post">
                <h3>Username:</h3>
                <input type = "text" name="user" placeholder="Username (at least 8 characters)"><br><br>
                <h3>Password: </h3>
                <input type="password" name="pwd" placeholder="Password..."><br><br>
                <h3>Confirm Password: </h3>
                <input type="password" name="confirm" placeholder="Confirm Password..."><br><br>
                <button type="submit" name="submit">Sign Up</button>
            </form> <br><br>
            <label>*Password must be at least 8 characters in length and it must contain an upper & lower case letter, a number, and a special character(!@#$%^&*)</label>
        </div>
        
    </section>
    <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<script>alert('Fill in all required fields!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "usershort") {
                echo "<script>alert('Username is shorter than 8 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "userlong") {
                echo "<script>alert('Username is longer than 50 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "matchpwd") {
                echo "<script>alert('Password doesn\'t match!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "passshort") {
                echo "<script>alert('Password is shorter than 8 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "passlong") {
                echo "<script>alert('Password is longer than 50 characters!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "invaliduser") {
                echo "<script>alert('Enter a proper Username!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "usertaken") {
                echo "<script>alert('Username already taken!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "stmtfailed") {
                echo "<script>alert('Something went wrong, please try again!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "passcheck") {
                echo "<script>alert('Password must contain an upper & lower case letter, a number, and a special character(!@#$%^&*)!');</script>";
                echo "<script>history.back();</script>";
            }
            else if($_GET["error"] == "none") {
                echo "<script>alert('You have successfully signed up!');</script>";
            }
        }
    ?>
<?php
    include_once 'footer.php';
?>