<?php
    session_start();


    class Profile
    {
        public function setValues(){
    
            if(isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        else {
            return false;
        }
            if(isset($_POST['address'])) {
            $address = $_POST['address'];
        }
        else {
            return false;
        }
            if(isset($_POST['address2'])) {
                $address2 = $_POST['address2'];
            }
        else {
            return false;
        }
            if(isset($_POST['city'])) {
                    $city = $_POST['city'];
            }
        else {
            return false;
        }
            if(isset($_POST['country/region'])) {
                    $country = $_POST['country/region'];
            }
        else {
            return false;
        }
            if(isset($_POST['state/province'])) {
                    $state = $_POST['state/province'];
            }
        else {
            return false;
        }
            if(isset($_POST['zipcode'])) {
                $zipcode = $_POST['zipcode'];
            }
        else {
            return false;
        }
    
        return true;
    
        }
    }
   


    if(isset($_POST['name'])) {
		$name = $_POST['name'];
	}
    if(isset($_POST['address'])) {
		$address = $_POST['address'];
	}
    if(isset($_POST['address2'])) {
        $address2 = $_POST['address2'];
    }
    if(isset($_POST['city'])) {
        $city = $_POST['city'];
    }
    if(isset($_POST['country/region'])) {
        $country = $_POST['country/region'];
    }
    if(isset($_POST['state/province'])) {
        $state = $_POST['state/province'];
    }
    if(isset($_POST['zipcode'])) {
        $zipcode = $_POST['zipcode'];
    }

    //$name = $_POST['name'];
    //$address = $_POST['address'];
    //$address2 = $_POST['address2'];
    //$city = $_POST['city'];
    //$country = $_POST['country/region'];
    //$state = $_POST['state/province'];
    //$zipcode = $_POST['zipcode'];
    
    
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
