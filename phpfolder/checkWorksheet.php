<html>
    <head>
        <meta charset="UTF-8">
        <title>Check Worksheet</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="http://localhost/webbnix/cssfolder/worksheet.css"/>
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
    
$error="";
$index=1;
$month = 0;
$year=2016;
$present = 0;
$ndays=0;
$tot_sun=0;
$count=1;

$sql = "select * from employee where utype='user'";
$result = $conn->query($sql);

if(!($result->num_rows > 0)){
  $error = "Number of employee are zero";
}
?>
<div><?php include "header.html";?></div>
    
        <div class="head">
          <div class="header" >Check Employee Worksheet</div>
        <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
            
            <div class="form"><span class="fill">User:</span><select required name="user">
            <option value=""  disabled selected >Select User</option>
            <?php while($row = $result->fetch_assoc()){?>
            <option><?php echo $row["unm"];?></option>
            <?php }?>
                </select></div>
            <div class="form"><span class="fill">Month:</span><select name="month" required>
            <option value="" disabled selected>Select Month</option>
             <?php while($month <12){?>
            <option><?php echo $month+=1;?></option>
            <?php }?>
        </select></div>
            <div class="form"><span class="fill">Year:</span><select name="year" required>
            <option value="" disabled selected>Select Year</option>
             <?php while($year<2018){?>
            <option><?php echo $year+=1;?></option>
            <?php }?>
        </select></div>
             <div class="form"><div class="change">
             <div class="top"></div><div class="bottom"></div>
        <input type ="submit" value="Search">
        </div>
        </div>
             
        </form>
        </div>
                <div><?php echo $error;?></div>

        <div id="user">
                 <?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    $var1 = $_POST['user'];
    $var2 = $_POST['month'];
    $var3 = $_POST['year'];
    
    $var1 = str_replace(" ","_",$var1);
    $var1 = $var1.'_0'.$var2.'_'.substr($var3, 2, 3);
        $var4 = $_POST['user'];

 if($var2 == date('m')){
 $ndays  = date('d');  
 }

else{
switch($var2){
case 4:
case 6:
case 9:
case 11:
 $ndays = 30;
 break;
case 1:
case 3:
case 5:
case 7:
case 8:
case 10:
case 12:
 $ndays = 31;
    break;
case 2:
 $ndays = 28;
    break;
default:
 $ndays = 30;
}
}

    
$sql1 = "SELECT * FROM $var1 where year(date1)='$var3' and month(date1) ='$var2'";
$sql3 = "select sum(time_out - time_in + 12) as tot_time from $var1";
$sql4 = "SELECT * FROM Employee where unm='$var4'";

$result1="";


if($conn->query($sql1)==TRUE){
    $result1 = $conn->query($sql1);

    if(!($result1->num_rows > 0)){
    echo "Number of rows are zero";
}
else{
    ?>
                            <div class="caption">Worksheet</div>

            <table>
                <tr><th>Date</th><th>Project-Name</th><th>Task-Performed</th><th>Time-In</th><th>Time-Out</th><th>Remark</th></tr>
<?php                
 while($row1 = $result1->fetch_assoc()){
                  ?>   
                <tr><td><?php echo $row1['date1'] ?></td><td><?php echo $row1['project_name']?></td><td><?php  echo $row1['task_perform']?></td><td><?php echo $row1['time_in']?></td><td><?php echo $row1['time_out']?></td><td><?php echo $row1['remark'] ?></td></tr>
<?php }}} ?>   
            </table>   
        </div>
                    <div class="caption">Days of Absent</div>

                <table>
       <?php
       $sql2 = "select day(date1) as date2 from $var1  where date1 between '$var3-$var2-1' and '$var3-$var2-30'" ;
if($conn->query($sql2)==TRUE){
    $result2 = $conn->query($sql2);
if(!($result2->num_rows > 0)){
  echo "Number of Absents are zero";
}
else{
    while($row = $result2->fetch_assoc()){
    $present++;
     $predat[] = $row['date2'];
    }
    ?>
<tr><th>S.No</th><th>Date</th></tr>
<?php
        for($i=1;$i<=$ndays;$i++){
            $j =$i;
            if(isweekend("$var3-$var2-$i")=="true"){
            $count++;}
            else{
            for($x = 0; $x < $present; ) {
            if($predat[$x]==$j){ 
                $x++; 
            }
                 else{
                     if(isweekend("$var3-$var2-$j")=="false"){ ?>
<tr><td><?php echo $index++;?></td><td><?php echo $j;}?></td></tr>
                     <?php }
             
                     $j++;
                     $count++;
            } $present=0;
            $i = $j--; 
            }
          
                 if(isweekend("$var3-$var2-$i")=="false" && $i<=$ndays){     
           ?>    
<tr><td><?php echo $index++;?></td><td><?php echo $i;?></td> </tr><?php }}}}?>
        </table>
                    </div>     
                <div id="salary"><p style="text-align: center;font-size:30px">Salary Summary</p><hr>
                 <p style="font-size:20px;"><?php if($result3 = $conn->query($sql3) && $result4 = $conn->query($sql4)){
                $result3 = $conn->query($sql3);
                $result4 = $conn->query($sql4);
                        $row3 = $result3->fetch_assoc();
                        $row4 = $result4->fetch_assoc();
                    $hr =  substr($row3['tot_time'], 0, strpos($row3['tot_time'], '.'));
                    $min = substr($row3['tot_time'],strpos($row3['tot_time'], '.')+1, count($row3['tot_time'])+1 );
                    $hr = intval($hr);
                    $min = intval($min);
                    $tot_work_days = date('d')-$tot_sun;
                    $tot_work_min = $tot_work_days*30;
                    $tot_work_hrs = $tot_work_days*8;
                    if(($tot_work_min) > 59){
                    $tot_work_hrs = $tot_work_hrs + $tot_work_min/60;
                    $tot_work_min = $tot_work_min%60;
                    if($tot_work_min == 0)
                        $tot_work_min = '00';
                    }
                    $net_sal = $hr*$row4['sal_hrly'] +($min/60.00)*$row4['sal_hrly'];
                                        $ded = $row4['sal_mon'] - $net_sal;
                    if($min > 59){
                    $hr = $hr + $min/60;
                    $min = $min%60;
                    
                    }
                    
                    echo "Total time work out: =>".$row3['tot_time'];?><hr><?php
                    echo nl2br("\n".'Total Working Hours For This Month => '.$tot_work_hrs." hrs:".$tot_work_min."mins" );?><hr><?php
                    echo nl2br("\n".'Gross Salary Rs. =>'.$row4['sal_mon']);?><hr><?php
                    echo nl2br("\n".'Net Salary Rs. =>'.round($net_sal,2));?><hr><?php
                    echo nl2br("\n".'Deduction of Rs. =>'.round(($ded),2));?><hr><?php
                
                } ?></p></div>
<?php }?>
    </body>
<?php 
function isweekend($date1){
    $date1 = strtotime($date1);
    $date1 = date("l", $date1);
    $date1 = strtolower($date1);
    if($date1 == "sunday") 
    return "true";
 else 
     return "false";   
}
?>
</html>
