<?php
session_start();
 
date_default_timezone_set("Asia/Kolkata");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webbnix";
$time;
 $date = date('Y/m/d');


$var1=$var2=$var3=$var4=$var5=$var6=$var7=$var8=$var9=$var10="";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$user = $_SESSION["unm"];
$user = str_replace(" ","_",$user);
$user = $user.'_'.date("m").'_'.date("y");

$sql1 = "select * from $user";
if($conn->query($sql1) == FALSE){
    $sql2 = "create table $user(date1 date primary key,project_name varchar(50),task_perform varchar(150),time_in varchar(15),time_out varchar(15),remark varchar(150))"; 
    $conn->query($sql2);           
}
if($conn->query($sql1) == TRUE){
$sql3 = "select * from $user where date1= '$date'";
$result3 = $conn->query($sql3);           
$row3 = $result3->fetch_assoc();
$time = $row3['time_in'];
$proj = $row3['project_name'];
$time2= $row3['time_out'];
}
$sql = "SELECT * FROM project";
$result = $conn->query($sql);
?>
<html>
    <head><title>Employee Worksheet Form</title>
         <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="jquery-3.1.1.js"></script>
        <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/mystyle2.css"/>
    </head>
    <body>
        <?php include 'header.html';
        ?>
       
        <div id="sheet">
            <?php
            if(isset($time2)){
                ?><div id = "exit"><?php echo "You already submitted Your Worksheet";
                 exit();
                 ?></div><?php
            }
            ?>
            <div class="caption">Fill Your Worksheet</div>
                <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
                <div class="form" id="date"><span class="fill">Date:</span><input type="text" name="date1" value="<?php echo date('Y/m/d')?>" readonly/></div>
                <div class="form" id="selector"><span class="fill">Project Name:</span><select name="projnm" required>
                    <option value="" selected disabled>Select Project</option>
                        <?php while($row = $result->fetch_assoc()) {?>
                    <option value="<?php echo $row['projnm']?>"><?php echo $row['projnm']?></option>
                        <?php } ?>
                </select><span class="required">*</span>
            </div>
            <?php if(isset($time)){ ?>
                <div class="form"><span class="fill">Time In: </span><input type="text" value="<?php echo $time;?>" readonly></div>
            <div class="form"><span class="fill">Time Out: </span><input type="number" name="time_out_hrs" placeholder="hrs" min="0" max="11" class="hrs2" readonly value="<?php echo date("h")?>">:<input type="number" name="time_out_min" placeholder="mins" min="0" max="60" class="min2" readonly value="<?php echo date("m")?>">:<select name="AP2" id="ap2"><option>AM</option><option selected>PM</option></select><span class="required">*</span></div>
            <div class="form"><span class="fill" class="view">Task Performed:</span><textarea name="message1" required></textarea><span class="required">*</span></div>
            <div class="form"><span class="fill">Remark:</span><textarea name="message2"></textarea></div>

    <?php }else{ ?>
            <div class="form"><span class="fill">Time In: </span><input type="number" name="time_in_hrs" placeholder="hrs" min="0" max="11" class="hrs2" readonly value="<?php echo date("h")?>">:<input type="number" name="time_in_min" placeholder="mins" min="0" max="60" class="min2" readonly value="<?php echo date("m")?>">:<select name="AP1" id="ap1"><option selected>AM</option><option>PM</option></select><span class="required">*</span></div>
    <?php }?>
                <div id="button">
                        <div class="change">
                            <div class="top"></div>
                            <div class="bottom"></div>
                            <input type="submit" value="submit" name="save"/>
                        </div>
                    
                        <div class="change">
                            <div class="top"></div>
                            <div class="bottom"></div>
                            <input  type="reset" value="reset"/>
                        </div>
                <div>
        </form>
        </div>
    </body>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(!isset($time)){
$var1=$_POST["date1"];
$var2=$_POST["projnm"];
$var5=$_POST["time_in_hrs"];
$var5=$var5.":".$_POST["time_in_min"];
$var5=$var5.":".$_POST["AP1"];
$sql = "insert into $user(date1, project_name, time_in) values('$var1','$var2','$var5')";
}
else{
$var3=$_POST["message1"];
$var4=$_POST["message2"];
$var6=$_POST["time_out_hrs"];
$var6=$var6.":".$_POST["time_out_min"];
$var6=$var6.":".$_POST["AP2"];
$sql = "update $user set task_perform='$var3',time_out='$var6',remark='$var4' where date1='$date'";
}
$result = $conn->query($sql);
if($result){
header("Location: http://localhost/webbnix/phpfolder/index.php");}
}
?>
</html>
<script type="text/javascript" src="script1.js">
</script>
