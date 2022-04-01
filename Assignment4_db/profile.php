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
        header("location:main.php");
        $stmt->close();
        $conn->close();
    }
    
?>