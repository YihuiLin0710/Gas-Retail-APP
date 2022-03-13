<?php
    session_start();

    $user = $_SESSION['username'];
    $name = $_SESSION['name'];
    $address = $_SESSION['address'];
    $address2 = $_SESSION['address2'];
    $city = $_SESSION['city'];
    $country = $_SESSION['country/region'];
    $state = $_SESSION['state/province'];
    $zipcode = $_SESSION['zipcode'];


    header("location:profile.html");

?>