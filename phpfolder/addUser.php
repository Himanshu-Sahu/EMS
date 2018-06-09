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

$nameErr="";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

$var1=$_POST["pass"];
$var2=$_POST["unm"];
$var3= $_POST["sal_mon"];
$var4= $_POST["sal_dal"];
$var5= $_POST["sal_hrly"];

    $sql = "insert into employee value('$var2','$var1','user','$var3','$var4','$var5')";
    $result = $conn->query($sql);
if ($result == TRUE){
    $nameErr="";    
    header("Location: http://localhost/webbnix/phpfolder/welcome.html");
}else {
     $nameErr = "User already exist";
}
}

?>
<html>
    <head>
        <title>Add User</title>
            <script type="text/javascript" src="jquery-3.1.1.js"></script>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/header.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/add.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common1.css"/>
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/common2.css"/>


    </head>
    <body>
           <div id="tit"><?php include "header.html";?></div>
        <div class="user_project">
           <div class="box">
          <div class="caption1">Add User Information</div>
          <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]") ?>" method="post" title="hello">
        <div class="form"><span class="fill">Name:</span><input type="text" name="unm" placeholder="Enter Employee Name"/></div>
        <span class="error"><?php echo $nameErr;?></span>
        <div class="form"><span class="fill">Password:</span><input type="password" name="pass" placeholder="Enter Password"/></div>
        <div class="form"><span class="fill">Salary Monthly:</span><input type="number" name="sal_mon" placeholder="Enter Employee Salary"  onkeyup="calSalary(this.value)" required id="salmon" min="0"/><span class="error1"><?php echo $nameErr1="";?></div>
        <div class="form"><span class="fill">Salary Daily:</span><input type="number" name="sal_dal" value="0" step="0.01" id="saldal" readonly placeholder="Employee Daily Salary"/></div>
        <div class="form"><span class="fill">Salary Hourly:</span><input type="number" name="sal_hrly" value="0" step="0.01" id="salhrly" readonly placeholder="Employee Hourly Salary"/></div>
        
        <div class="option">
        <div class="change">
                    <div class="top"></div>
                    <div class="bottom"></div>
                     <input type="submit" value="Add User"/>
            </div>
        </div>
    </form>
    </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    function calSalary(str) {
        var str = parseFloat(str);
        if(str < 0){
          document.getElementById("salmon").value = 0;
          document.getElementById("saldal").value = 0;
          document.getElementById("salhrly").value = 0;
        }
        else{
          var sal_dal =  str/30;
          var sal_hrly = sal_dal/8.5;
          sal_dal = parseFloat(sal_dal);
          sal_dal = sal_dal.toFixed(2);
          sal_hrly = parseFloat(sal_hrly);
          sal_hrly = sal_hrly.toFixed(2);
          document.getElementById("saldal").value = sal_dal;
          document.getElementById("salhrly").value = sal_hrly;
      }}
      
      $(document).ready(function(){
      $("#sadal").keydown(function(){
return false;
    });
      $("#salhrly").keydown(function(){
      });
  });
      
</script>
    
