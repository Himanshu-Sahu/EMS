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
    $sql1 = "delete from project where projnm = '$var1'";
    $result1 = $conn->query($sql1);
if ($result1 === TRUE) 
    header("Location: http://localhost/webbnix/delProject.php");
}
?>
<html>
    <head><title>Delete User</title>
    <link rel="stylesheet" type="text/css" href="header.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/add.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/></head>
    
<body>
<div id="tit"><?php include "header.html";?></div>
        <div class="user_project">   <div class="box">
          <div class="caption1">Delete Project</div>
    <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
        <?php
            $conn1 = new mysqli($servername, $username, $password, $dbname);
             $sql = "select * from project";
            $result = $conn1->query($sql);
if ($result->num_rows == 0){
    echo "0 results";
?>
        <br><br><a href="addProject.php">Add Project</a>
        <?php
    exit();
}
else{
    ?><select name="pnm">
                <option disabled value="" selected>Select Project</option><?php
    while($row = $result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['projnm']?>"><?php echo $row['projnm']?></option>
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
</html>
