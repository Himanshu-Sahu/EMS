<html>
<head>
<style>
*{
box-sizing:border-box;}
#loader{
position:relative;
left:45%;
top:30%;
width:150px;
height:150px;
background-color:white;
padding:10px;
}

.load1{
left:10px;
top:10px;
border-radius: 10px 0 0 10px;
}

.load2{
right:10px;
top:10px;
border-radius: 0 10px 10px 0;
}

.load3{
border-radius: 0 10px 10px 0;
right:10px;
bottom:10px;
}

.load4{
border-radius: 10px 0 0 10px;
;
left:10px;
bottom:10px;;
}

.load{
position:absolute;
background-color:white;
padding:30px;
width:25%;
height:25%;
}

@keyframes label{
from{opacity:0.2;}
to{opacity:0.4;}
}

</style>
</head>
<body>
<div id="loader">
<div id="content">
<span class="load1 load"></span>
<span class="load2 load"></span>
</div>
<div>
<span class="load3 load"></span>
<span class="load4 load"></span>
</div>
</div>
<script>
    var count =0;
index = 1;
index1 = 4;
j=1;
t=200,x=850;
load  = document.getElementsByClassName("load");


setInterval(myLoader,220);


function myLoader(){

myVar = setTimeout(myTimer,t);
myVar1 = setTimeout(myTimer1,x);

function myTimer(){
if(index > load.length){index=1}
for(i = 0;i<index;i++)
{
load[i].style.backgroundColor="aqua";
load[i].style.opacity= 0.8;
}
for(i = 0;i<index-1;i++)
{
load[i].style.backgroundColor="grey";
load[i].style.opacity= j;
j = j-0.3;
}
index++;
}
function myTimer1(){
    count+=1;
for(i = 0;i<index1;i++)
{
load[i].style.backgroundColor="white";
}
j=1;
if(count==10)
    window.location.assign("loader.php");
}
}

</script>
</body>
</html>