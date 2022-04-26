<?php
    include_once 'header.php';
?>
    <section class="login-form">
        <h2>Login</h2>
        <form action="includes/login-inc.php" method="post">
            <input type="text" name="user" placeholder="Username..."><br><br>
            <input type="password" name="pwd" placeholder="Password..."><br><br>
            <button type="submit" name="submit">Login</button>
        </form>
    </section>
    <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo '<script>alert("Fill in all required fields!")</script>';
                echo '<script>history.back()</script>';
            }
            else if($_GET["error"] == "wronglogin") {
                echo '<script>alert("Incorrect Username or Password!")</script>';
                echo '<script>history.back()</script>';
            }
        }
    ?>
<?php
    include_once 'footer.php';
?>