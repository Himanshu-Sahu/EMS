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
    
$sql = "SELECT * FROM Employee where utype='user'";
$result = $conn->query($sql);
if(!($result->num_rows > 0)){
  $var1 = "Number of rows are zero";
}?>
<html>
    <head>
        <title>Change Password</title>
         <link rel="stylesheet" type="text/css" href="header.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/add.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/></head>
    <body>
<div id="tit"><?php include "header.html";?></div>
        <div class="user_project">            <div class="box">
          <div class="caption1" style="margin-left: 9%">Change Password</div>
       <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
            <select required name="user" style="padding: 1.8% 1%;">
            <option value=""  disabled selected >Select User</option>
            <?php while($row = $result->fetch_assoc()){?>
            <option><?php echo $row["unm"];?></option>
            <?php }?>
        </select>
            <input type="password" name="pass" placeholder="Enter Password" required/><br><br>
            <div class="change" style="width:35%;">
                    <div class="top"></div>
                    <div class="bottom"></div><input type="submit" value="Change Password"></div>
       </form>
                    </div>
        </div>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $var1 = $_POST['user'];  
    $var1 = str_replace(" ","_",$var1);
    $var2 = $_POST['pass'];  
    
$sql1 = "update employee set pass='$var2' where unm='$var1'";

if($conn->query($sql1)==TRUE){
    echo "Password Updated";
}}?>
