<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webbnix";
$error="";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
$unm = $_POST["unm"];
$pass = $_POST["pass"];

$_SESSION["unm"] = $unm;
    
$sql = "SELECT * FROM employee where unm='$unm' and pass='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    $error="";
    $row = $result->fetch_assoc();
    if($row["utype"] == "admin")
        header("Location: http://localhost/webbnix/phpfolder/welcome.html");
    else
    header("Location: http://localhost/webbnix/phpfolder/worksheet.php");  
}
else 
    $error="Username or Password doesn't match";
}
?>

<html>
    <head>
        <title>EMS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/mystyle1.css"/>
    </head>
    <body>
        <div id="header">Employee Management System</div>
        <div id="form1">
            <div class="head">Login</div><div class="Error"><b><?php echo $error?></b></div>
            <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
                <div><input type="text" name="unm" required placeholder="Enter User Name"/><br></div>
                <div><input type="password" name="pass" required placeholder="Enter Password"/><br></div>
                <div id="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
                    <input type="submit" value="Login"/>
                 </div>
            </form>
        </div>
    </body>
</html>
