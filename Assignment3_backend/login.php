<?php
    session_start();


    class register
    {
        public function setValues(){
    
            if(isset($_POST['user'])) {
                $_SESSION['username'] = $_POST['user'];
            }
            else{
                return false;
		    }
            if(isset($_POST['password'])) {
                $_SESSION['password'] = $_POST['password'];
                }
            else{
                return false;
            }
        }
    }
    

    if(isset($_POST['user'])) {
		$_SESSION['username'] = $_POST['user'];
	}
    if(isset($_POST['password'])) {
		$_SESSION['password'] = $_POST['password'];
	}

    //$_SESSION['username'] = $_POST['user'];
    //$_SESSION['password'] = $_POST['password'];
    $user = $_POST['user'];

$T=new mysqli("localhost", "root","","profile");
if($T->connect_error)
    die("Fail to connect : ".$T->connect_error);
else{
    $stmt=$T->prepare("select * from customer_profile where username = ?");
    $stmt->bind_param("s",$_SESSION['username']);
    $stmt->execute();
    $stmt_result=$stmt->get_result();
    if($stmt_result->num_rows>0){
        $data=$stmt_result->fetch_assoc();
        if($data['password']==$_SESSION['password']){
            echo "<h2> Login Successfully</h2>";
            header("location:main.html");
        }
        else
            echo "<h2> Invalid Username or Password</h2>";
    }
    else
        echo "<h2> Invalid Username or Password</h2>";
}

?>
