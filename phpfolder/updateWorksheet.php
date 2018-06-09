<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Information</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webbnix";
$submit = '';
 
$month = 0;
$year=2016;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select * from employee where utype='user'";
$result = $conn->query($sql);

$sql4 = "SELECT * FROM project";
$result4 = $conn->query($sql4);

if(!($result->num_rows > 0)){
  $error = "Number of employee are zero";
}  

        ?>
        
       <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
            User:<select required name="user">
            <option value=""  disabled selected >Select User</option>
            <?php while($row = $result->fetch_assoc()){?>
            <option><?php echo $row["unm"];?></option>
            <?php }?> <br>
            <br><input type="date" name="workday">
        <input type ="submit" name="submit" value="save">
        </form>
        <?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['submit'] == 'save')
    {   
        $user1 = $_POST['user'];
   $var2 = $_POST['workday'];
    
   
  $year1 = substr($var2, 2, 2);
  $mon1 = substr($var2, 5, 2);
  $day2 = substr($var2, 8, 2);
  
 
    
   $user1 = strtolower($user1);
    $user1 = str_replace(" ","_",$user1);
    $user1 = $user1.'_'.$mon1.'_'.$year1;
      $user2 =$user1;

    
$sql1 = "SELECT * FROM $user1 where day(date1) = '$day2'";

if($conn->query($sql1)==TRUE){
    $result2 = $conn->query($sql1);
    if($result2->num_rows>0){
        $row = $result2->fetch_assoc();
          $off = $row['off_timer'];
          $on = $row['on_timer'];
          $in = $row['time_in'];
          $out =  $row['time_out'];?>
  
        <form action="<?php echo htmlspecialchars("$_SERVER[PHP_SELF]")?>" method="POST">
            Date:<input type="text" name="date1" value="<?php echo str_replace("-","/",$var2);?>" readonly/>
            <br>
            Project Name:<select name="projnm" required>
                <option value=<?php echo $row['project_name'];?> selected disabled><?php echo $row['project_name'];?></option>
                 <?php while($row4 = $result4->fetch_assoc()) {
            ?>
            <option value="<?php echo $row4['projnm'];?>"><?php echo $row4['projnm'];?></option>
                 <?php } ?>
            </select>*<br><br>
            Task Performed:<br><textarea name="message1" rows="5" cols="50" required value="<?php echo $row['task_perform'];?>"><?php echo $row['task_perform'];?></textarea>*<br>
            Off Timer: <input type="number" name="on_time_hrs1"  placeholder="hrs" min="0" max="23" class="hrs1" value="<?php echo substr($off,0,strpos($off,'.'));?>">:<input type="number" name="on_time_min1" placeholder="mins" min="0" max="60" class="min1" value="<?php echo substr($off,strpos($off,'.')+1,count($off)+1);?>"><br>
            On Timer:  <input type="number" name="on_time_hrs2" placeholder="hrs" min="0" max="23" class="hrs1" value="<?php echo substr($on,0,strpos($on,'.'));?>">:<input type="number" name="on_time_min2" placeholder="mins" min="0" max="60" class="min1" value="<?php echo substr($on,strpos($on,'.')+1,count($on)+1);?>"><br>
            Time In:   <input type="number" name="time_in_hrs" placeholder="hrs" min="0" max="11" class="hrs2" value="<?php echo substr($in,0,strpos($in,':'));?>">:<input type="number" name="time_in_min" placeholder="mins" min="0" max="60" class="min2" value="<?php echo substr($in,strpos($in,':')+1,strpos($in,':'));?>">:<select name="AP1" id="ap1"><option selected>AM</option><option>PM</option></select><br>
            Time Out:  <input type="number" name="time_out_hrs" placeholder="hrs" min="0" max="11" class="hrs2" value="<?php echo substr($out,0,strpos($out,':'));?>">:<input type="number" name="time_out_min" placeholder="mins" min="0" max="60" class="min2" value="<?php echo substr($out,strpos($out,':')+1,strpos($out,':'));?>">:<select name="AP2" id="ap2"><option>AM</option><option selected>PM</option></select><br>
            Remark:<br><textarea name="message2" rows="5" cols="50" <?php echo $row['remark'];?>><?php $row['remark'] ?></textarea>
            <br>
            <input type="hidden" name="user1" value="<?php echo $user1;?>">
            <input type="submit" value="change" name="submit"/>
            <input type="reset" value="reset"/>
        </form>
     
  <?php }else{
    echo "No Data Available";
}    
}else{
    echo "No Data Available";
}
}}?>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if($_POST['submit'] =='change'){

$var1=$_POST['date1'];
$var1 = str_replace("/", "-",$var1);
$user1 = $_POST['user1'];
$var2=$_POST["projnm"];
$var3=$_POST["message1"];
$var4=$_POST["message2"];
$var5=$_POST["time_in_hrs"];
$var5=$var5.":".$_POST["time_in_min"];
$var5=$var5.":".$_POST["AP1"];
$var6=$_POST["time_out_hrs"];
$var6=$var6.":".$_POST["time_out_min"];
$var6=$var6.":".$_POST["AP2"];
$var7=$_POST["on_time_hrs1"];
$var8=$_POST["on_time_hrs2"];
$var9=$_POST["on_time_min1"];
$var10=$_POST["on_time_min2"];
$var7 = $var7.'.'.$var9;
$var8 = $var8.'.'.$var10;

    
$sql3 = "update $user1 set project_name='$var2',task_perform='$var3',off_timer='$var7',on_timer='$var8',time_in='$var5',time_out='$var6',remark='$var4' where date1='$var1'";

$result3 = $conn->query($sql3);
if($result3){
header("Location: http://localhost/webbnix/index.php");}
else{
        echo $result3->error;}}}?>
    </body>
</html>
z