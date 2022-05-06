<?php
    function emptyInputSignup($User, $Pass, $Confirm) {
        $result= "";
        if(empty($User) || empty($Pass) || empty($Confirm)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
    function emptyInputLogin($User, $Pass) {
        $result= "";
        if(empty($User) || empty($Pass)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }

    function emptyInputFinishSignup($id, $Name, $Addr1, $City, $State, $Zip) {
        $result= "";
        if(empty($id) || empty($Name) || empty($Addr1) || empty($City)
            || empty($State) || empty($Zip)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
    
    function userExists($conn, $User) {
        $sql = "SELECT * FROM client_info WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $User);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }


    function idExists($conn, $id) {
        $sql = "SELECT * FROM client_info WHERE id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
    function createUser($conn, $User, $Pass) {
        $sql = "INSERT INTO client_info (username) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $User);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        $userExists = userExists($conn, $User);

        $sql2 = "INSERT INTO user_cred (id, password) VALUES (?, ?);";

        $stmt2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        $hashedPwd = password_hash($Pass, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt2, "ss", $userExists['id'], $hashedPwd);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);


        header("location: ../signup.php?error=none");
        exit();
    }

    function getPass($conn, $User) {
        $userExists = userExists($conn, $User);
        $id = $userExists['id'];
        $sql = "SELECT * FROM user_cred WHERE id = '$id';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
        
        /*
        $sql = "SELECT * FROM user_cred WHERE id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $userExists['id']);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);*/
    }
    function loginUser($conn, $User, $Pass) {
        $userExists = userExists($conn, $User);
        $checkPwd = "";
        if ($userExists != false) { 
            $getPass  = getPass($conn, $User);
            //header("location: ../index.php?error=$getPass");
            //exit();
            $pwdHashed = $getPass["password"];
            $checkPwd = password_verify($Pass, $pwdHashed);
        }
        else {
            header("location: ../index.php?error=wronglogin");
            exit();
        }

        if($checkPwd === false) {
            echo $checkPwd;
            header("location: ../index.php?error=wronglogin");
            exit();
        }
        else if ($checkPwd === true){
            session_start();
            $_SESSION["User_id"] = $userExists["id"];
            header("location: ../main.php?error=login");
            exit();
        }
    }

    function finishUser($conn, $id, $Name, $Addr1, $Addr2, $City, $State, $Zip) {
        $sql = "UPDATE `client_info` SET `fullname`='$Name',`addr1`='$Addr1',`addr2`='$Addr2',
        `city`='$City',`state`='$State',`zip`='$Zip'WHERE `id`= $id;";
        if (mysqli_query($conn, $sql)) {
            header("location: ../main.php?error=none");
            exit();
        }
        else {
            header("location: ../finish-signup.php?error=sql");
            exit();
        }
    }
    function emptyInputEdit($id, $User, $Name, $Addr1, $City, $State, $Zip) {
        $result= "";
        if(empty($id) || empty($User)  || empty($Name) || empty($Addr1) || empty($City)
            || empty($State) || empty($Zip)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
    
    function editUser($conn, $id, $User, $Name, $Addr1, $Addr2, $City, $State, $Zip) {
        $sql = "UPDATE `client_info` SET `username`='$User', `fullname`='$Name',
        `addr1`='$Addr1',`addr2`='$Addr2',
        `city`='$City',`state`='$State',`zip`='$Zip' WHERE `id`= $id;";
        if (mysqli_query($conn, $sql)) {
            header("location: ../editprofile.php?error=none");
            exit();
        }
        else {
            header("location: ../editprofile.php?error=sql");
            exit();
        }
    }

    function  createHistoryTable($conn, $id) {
        $sql = "SELECT * FROM fuel_quote AS FQ
        WHERE FQ.id = $id;";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
        ?>
            <div class="COtable">
                <table border="1px" style="width:1000px; line-height:30px;">
                    <tr>
                        <th colspan="5"><h2>Fuel Quote History</h2></th>
                    </tr>
                    <t>
                        <th>Gallons </th>
                        <th>Address </th>
                        <th>Deliver Date </th>
                        <th>Suggested Price </th>
                        <th>Total</th>
                    </t>
            <?php
            while($row = $result->fetch_assoc()) {
            ?> 
                <tr>
                    <td><?php echo $row['gallons']; ?></td>
                    <td><?php echo $row['addr']; ?></td>
                    <td><?php echo $row['deliver']; ?></td>
                    <td><?php echo $row['suggest']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                </tr>
        <?php
            }
            ?>
                </table>
            </div>
            <?php
        }
        else {
        ?>
            <div class="noCO">
                <p>You have no history!</p>
            </div>
        <?php
        }
    }
    function emptyInputFuel($id, $Gal, $Addr, $Deliver, $Suggest, $Total) {
        $result= "";
        if(empty($id) || empty($Gal)  || empty($Addr) || empty($Deliver) || empty($Suggest) || empty($Total)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }  
    function addFuelQuote($conn, $id, $Gal, $Addr, $Deliver, $Suggest, $Total) {
        $sql = "INSERT INTO fuel_quote (id, gallons, addr, deliver, suggest, total) VALUES (?,?,?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../fuel-quote.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssssss", $id, $Gal, $Addr, $Deliver, $Suggest, $Total);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../fuel-quote.php?error=none");
        exit();
    }
    function emptyInputUpdatePass($Old, $New, $Confirm) {
        $result= "";
        if(empty($Old) || empty($New) || empty($Confirm)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
    function  updatePass($conn, $id, $Old, $New) {
        $sql = "SELECT * FROM user_cred WHERE id = '$id';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $pwdHashed = $row["password"];
        $checkPwd = password_verify($Old, $pwdHashed);
        if($checkPwd === false) {
            header("location: ../edit-password.php?error=oldbad");
            exit(); 
        }
        else if ($checkPwd === true){
            $hashedPwd = password_hash($New, PASSWORD_DEFAULT);
            $sql = "UPDATE `user_cred` SET `Password`='$hashedPwd' WHERE `id`= '$id';";
            if (mysqli_query($conn, $sql)) {
                 header("location: ../edit-password.php?error=none");
                exit();
            }  
            else {
                header("location: ../edit-password.php?error=sql");
                exit();
            }
        }
    }
    function hasHistory($conn, $id) {
        $sql = "SELECT * FROM fuel_quote AS FQ
        WHERE FQ.id = $id;";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    function emptyInputFuelQuote($id, $Gal, $Addr, $Deliver) {
        $result= "";
        if(empty($id) || empty($Gal) || empty($Addr) || empty($Deliver)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
    function dateAddrSet($conn, $id, $Addr, $Date) {
        $sql = "SELECT * FROM fuel_quote
        WHERE id = '$id' AND addr = '$Addr' AND deliver = '$Date';";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    function passwordCheck($Pass) {
        $result= "";
        if(preg_match('/[A-Z]/', $Pass) && preg_match('/\d/', $Pass) && preg_match('/[!@#$%^&*]/', $Pass) && preg_match('/[a-z]/', $Pass)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
?>