<?php
    session_start();
    $_SESSION['gallons'] = $_POST['gallons'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['date']    = $_POST['date'];
    $_SESSION['pricing_module'] = $_POST['pricing_module'];
    $_SESSION['total']   = $_POST['total'];
    //echo $gallons, "<br>", $address, "<br>", $date, "<br>", $pricing_module, "<br>", $total;

    //Database connection
    $conn = new mysqli('localhost','root','','fuel');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("INSERT INTO fuel_profile(username, gallons, address, date, pricing_module, total) values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdd", $_SESSION['username'] , $_SESSION['gallons'], $_SESSION['address'], $_SESSION['date'], $_SESSION['pricing_module'], $_SESSION['total']);
        $execval = $stmt->execute();

        //updated
        echo "Profile updated...";
        header("location:main.html");
        $stmt->close();
        $conn->close();
    }

?>