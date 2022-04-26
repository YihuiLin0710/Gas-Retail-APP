<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Team 25 Fuel Project</title>
        <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
        <!--<link rel="shortcut icon" type="image/png" href="img/lib-logo.png">-->
    </head>
    <body>
        <div class="bar">
            <div class="header-final">
                <nav>
                    <div class="img-for-logo">
                        <!--<a href="main.php"><img class="img-book" src = "img/book.png" alt="Library Logo"></a>-->
                    </div>
                    <div class="logo-name"> 
                        <a class="logo-name-name"href="main.php"><h1>Team 25 Fuel Project</h1></a>
                    </div> 
                    <div class="loggedin">
                        <?php
                            if(isset($_SESSION["User_id"])) {
                                $UserID = $_SESSION["User_id"];
                                require_once 'includes/dbh-inc.php';
                                $sql = "SELECT * FROM client_info WHERE id = '$UserID';";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                #echo "Hello, " . $row["username"]."."."<br>";
                                echo "Hello, " . $row["fullname"]."."."<br>";
                            }
                        ?>
                    </div>
                        <ul>
                            <?php
                                if(isset($_SESSION["User_id"])) {
                                    echo "<li><a href='main.php'>Home</a>";
                                        echo "<ul>";
                                            echo "<li><a href='fuel-quote.php'>Fuel Quote Form</a></li>";
                                            echo "<li><a href='history.php'>History</a></li>";
                                            echo "<li><a href='editprofile.php'>Edit Profile</a></li>";
                                        echo "</ul>";
                                    echo "</li>";
                                    
                                    echo "<li><a href='includes/logout-inc.php'>Logout</a></li>";
                                }
                                else {
                                    echo "<li><a href='index.php'>Login</a></li>";
                                    echo "<li><a href='signup.php'>Signup</a></li>";
                                }
                            ?>
                        </ul>
                </nav>
            </div>
        </div>
        <div class = background_wrapper>
            <div class = middle_wrapper>