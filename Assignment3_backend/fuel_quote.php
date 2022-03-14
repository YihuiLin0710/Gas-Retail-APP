<?php
    session_start();

    class fuel_quote
    {
        public function setValues(){
    
            if (isset($_POST['gallons'])) {
                $_SESSION['gallons'] = $_POST['gallons'];
            }
        else{
            return false;
		}
        if (isset($_POST['address'])) {
            $_SESSION['address'] = $_POST['address'];
        }
        else{
            return false;
		}
        if (isset($_POST['date'])) {
            $_SESSION['date'] = $_POST['date'];
        }
        else{
            return false;
		}
        if (isset($_POST['pricing_module'])) {
            $_SESSION['pricing_module'] = $_POST['pricing_module'];
        }
        else{
            return false;
		}
        if (isset($_POST['total'])) {
            $_SESSION['total'] = $_POST['total'];
        }
        else{
            return false;
		}
    }
    
    if (isset($_POST['gallons'])) {
        $_SESSION['gallons'] = $_POST['gallons'];
    }
    if (isset($_POST['address'])) {
        $_SESSION['address'] = $_POST['address'];
    }
    if (isset($_POST['date'])) {
        $_SESSION['date'] = $_POST['date'];
    }
    if (isset($_POST['pricing_module'])) {
        $_SESSION['pricing_module'] = $_POST['pricing_module'];
    }
    if (isset($_POST['total'])) {
        $_SESSION['total'] = $_POST['total'];
    }

    //$_SESSION['gallons'] = $_POST['gallons'];
    //$_SESSION['address'] = $_POST['address'];
    //$_SESSION['date']    = $_POST['date'];
    //$_SESSION['pricing_module'] = $_POST['pricing_module'];
    //$_SESSION['total']   = $_POST['total'];
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
