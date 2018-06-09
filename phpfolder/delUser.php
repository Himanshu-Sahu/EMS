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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$var1=$_POST["unm"];
    $sql1 = "delete from employee where unm='$var1'";
    $result1 = $conn->query($sql1);
    header("Location: http://localhost/webbnix/delUser.php");
}
?>
<html>
    <head><title>Delete User</title>            
        <script type="text/javascript" src="jquery-3.1.1.js"></script>
         <link rel="stylesheet" type="text/css" href="header.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/add.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/>
    </head>
<body>
<div id="tit"><?php include "header.html";?></div>
        <div class="user_project">   <div class="box">
          <div class="caption1">Delete User</div>
    <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
        <?php
            $conn1 = new mysqli($servername, $username, $password, $dbname);
             $sql = "select * from employee where utype='user'";
            $result = $conn1->query($sql);
if ($result->num_rows == 0){
    echo "0 results";
?>
        <br><br> <a href="addUser.php">Add User</a>
        <?php
    exit();
}
else{
    ?><select name="unm" required>
        <option disabled value="" selected>Select User</option><?php
    while($row = $result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['unm']?>"><?php echo $row['unm']?></option>
            <?php       
    }         
}
 
?>
        </select>
        <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
          <input type="submit" value="Delete">
        </div>
    </form>
   </div>
        </div>
</body>
<script type="text/javascript">
$(document).ready(function(){
$('form').submit(function(){
    alert("User Deleted Successfully");
    });
});
</script>
</html>
