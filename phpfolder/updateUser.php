<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" type="text/css" href="header.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/add.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/>
    </head>
    <body>
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
$sql = "select * from employee where utype='user'";
$result = $conn->query($sql);

if(!($result->num_rows > 0)){
  $error = "Number of employee are zero";
}  

        ?>
<div id="tit"><?php include "header.html";?></div>
        <div class="user_project">   <div class="box">
          <div class="caption1">Update User Information</div>
        <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
            User:<select required name="user" style="padding: 2% 1%;">
            <option value=""  disabled selected >Select User</option>
            <?php while($row = $result->fetch_assoc()){?>
            <option><?php echo $row["unm"];?></option>
            <?php }?>
            </select>
            Salary: <input type="number" name="sal" placeholder="Enter Salary" required/><br><br>
                    
            <div class="change" style="width:35%;">
                    <div class="top"></div>
                    <div class="bottom"></div><input type ="submit" value="Update Information">
                    </div>
        </form>
   </div>
        </div>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $var1 = $_POST['user'];  
    $var3 = $_POST['sal'];
    
$sql1 = "update employee set sal_mon='$var3' where unm='$var1'";

if($conn->query($sql1)==TRUE){
    echo "Information Updated";
}}?>