<?php
    session_start();

    /*$user = $_SESSION['username'];
    $name = $_SESSION['name'];
    $address = $_SESSION['address'];
    $address2 = $_SESSION['address2'];
    $city = $_SESSION['city'];
    $country = $_SESSION['country/region'];
    $state = $_SESSION['state/province'];
    $zipcode = $_SESSION['zipcode'];*/


    //header("location:profile.html");
    //header("location:main.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
    <form method = "get" action = "main.php">
    <div>
        <h2><a href="profile.html">Edit personal file</a></h2>
        <h2 class="right">Welcome, <?php echo $_SESSION['username']; ?>.  <a href="index.html">Logout</a></h2> 


    </div>
    </form>

    <center>
    <div class="center">
        <div>
            <a href="fuel_quote.html">
                <button>Fuel Quote Form</button>
            </a>
        </div>
        <br><br>
        <div>
            <a href="history.php">
                <button>Fuel Quote History</button>
            </a>
        </div>

    </div>
        </center>
    </form>
</body>
    
<style>
.center {
    margin: 0;
    position: absolute;
    top: 40%;
    left:50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.right {
    margin: 0;
    position: absolute;
    top: 3%;
    left:85%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

text {
    font-size: 20px;
    float: right;
}

button {
    background-color: #3399ff; 
    border: 1px solid black; 
    color: white; 
    padding: 20px 200px; 
    cursor: pointer; 
    width: 100%; 
    font-size: 20px;
}

</style>