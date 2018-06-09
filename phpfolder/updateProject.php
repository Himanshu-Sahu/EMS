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
$sql = "select * from project";
$result = $conn->query($sql);

if(!($result->num_rows > 0)){
  $error = "Number of project are zero";
}  

        ?>
<div id="tit"><?php include "header.html";?></div>
        <div class="user_project"><div class="box">
          <div class="caption1">Update Project Information</div>
        <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
            User:<select required name="project" style="padding: 2% 1%;">
            <option value=""  disabled selected >Select User</option>
            <?php while($row = $result->fetch_assoc()){?>
            <option><?php echo $row["projnm"];?></option>
            <?php }?>
        </select>
            Name: <input type="text" name="projnm" placeholder="Enter Project Name" required/><br><br>
                   <div class="change" >
                    <div class="top"></div><div class="bottom"></div>
                        <input type ="submit" value="Update Project">
                   </div>
        </form>
</div>
        </div>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $var1 = $_POST['projnm'];  
    $var2 = $_POST['project'];
    
$sql1 = "update project set projnm='$var1' where projnm='$var2'";

if($conn->query($sql1)==TRUE){
    echo "Information Updated";
}}?>