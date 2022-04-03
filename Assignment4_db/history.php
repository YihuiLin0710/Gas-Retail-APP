<?php
    session_start();
    //echo $_SESSION['username'];
    $username = $_SESSION['username'];

    $conn = new mysqli('localhost','root','','fuel');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }

    $sql = "SELECT * FROM `fuel_profile` WHERE username = '$username';";
    $result = $conn-> query($sql);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <a href="main.php">
        Back to main page
    </a>
    <h2 class="right">Welcome, <?php echo $_SESSION['username']; ?>.  <a href="index.html">Logout</a></h2> 
    <form action="history.php" method="get">
    <center>
        <div class="center">

                
            


<table align="center" border="1px" style="width:600px; line-height:40px;">
        <tr>
            <th colspan="6"><h2>Fuel quote history</h2></th>
        </tr>
        <t>
            <th>Username </th>
            <th>Gallons </th>
            <th>Address </th>
            <th>Date </th>
            <th>Price </th>
            <th>Total </th>
        </t>

<?php
    if($result-> num_rows > 0) {
        while ($row = $result-> fetch_assoc()) {
?>
            
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['gallons']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['pricing_module']; ?></td>
                <td><?php echo $row['total']; ?></td>
            </tr>
    <?php
        }

    }
?>


            </table>
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
    .table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(1) {
        background-color: #dddddd;
    }

</style>