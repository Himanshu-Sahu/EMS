<?php
$nameErr="";
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
$var1=$_POST["pnm"];
if($var1 == '')
    $nameErr = 'Please Enter Project Name';
else{
    $sql = "insert into project value('$var1')";
    $result = $conn->query($sql);
if ($result == TRUE) 
    header("Location: http://localhost/webbnix/phpfolder/welcome.html");
 else 
    $nameErr = "Project Already Exist";
}
}

?>
<html>
    <head>
        <title>Add User</title>
        <link rel="stylesheet" type="text/css" href="header.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/>
                        <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/add.css"/>

    </head>
    <body>
    <div id="tit"><?php include "header.html";?></div>
        <div class="user_project">
        <div class="box">
          <div class="caption1">Add Project Information</div>
        <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]") ?>" method="post">
            <div class="form"><span class="fill">Name:</span><input type="text" name="pnm" placeholder="Enter Project Name"/></div><span class="error"><?php echo $nameErr;?></span>
                  <div class="option">
        <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
                    <input type="submit" value="Add Project "/>
            </div>
        </div>   
    </form>
    </div>
        </div>
    </body>
</html>


