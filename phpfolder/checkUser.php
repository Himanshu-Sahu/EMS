<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webbnix";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    
$sql = "SELECT * FROM employee where utype='user'";
$result = $conn->query($sql);

if($result->num_rows==0){
    echo "No user available";
    return;
}

$count=0;
?>
<html>
    <head>
        <title>Check User</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
                <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/>

    </head>
    
 <body>
    <div><?php include "header.html";?></div>
        <div class="user_project">
            <table>
                <caption class="caption">List Of Users</caption>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Salary Monthly</th>
                    </tr>
        <?php
        while($row = $result->fetch_assoc()){
            ?>
        <tr><td>
            <?php
            $count=$count+1;
            echo $count;?>
            </td>
            <td>
        <?php 
        echo $row["unm"];
        ?></td>
        <td>
        <?php 
        echo $row["sal_mon"];
        ?></td></tr><br>
        <?php
        }
        ?>
  </table>
    <div class="option">
            <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
                    <a href="addUser.php">Add User</a>
            </div>
            <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
                    <a href="delUser.php">Delete User</a>
            </div>
            <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
                    <a href="changePass.php">Change Password</a>
            </div>
            <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div><a class="optionlist" href="updateUser.php">Update User Information</a>
            </div>
          </div>
      </div>
    
 </body>
</html>
