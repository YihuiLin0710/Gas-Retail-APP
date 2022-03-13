<?php
    session_start();


    $name = $_POST['name'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $country = $_POST['country/region'];
    $state = $_POST['state/province'];
    $zipcode = $_POST['zipcode'];
    
    
    $username = $_SESSION['username'];

    /*
    $_SESSION['name'] = $POST['name'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['address2'] = $_POST['address2'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['country'] = $_POST['country/region'];
    $_SESSION['state'] = $_POST['state/province'];
    $_SESSION['zipcode'] = $_POST['zipcode'];
    */
    //echo $name, "<br>", $address, "<br>", $city, "<br>", $country, "<br>", $state, "<br>", $zipcode, "<br>";

    // Database connection
    $conn = new mysqli('localhost','root','','profile');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("UPDATE customer_profile
                                SET fullName='$name', address='$address', address2='$address2', city='$city', country='$country', state='$state', zipCode='$zipcode'
                                WHERE username = '$username';"); //change to $username after combine with register

        $stmt->execute();
        //updated
        echo "Profile updated...";
        header("location:main.html");
        $stmt->close();
        $conn->close();
    }
    
?>