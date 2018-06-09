$(document).ready(function(){
   hrs_off = 0;
   hrs_on = 0;
   mins_off = 0;
   mins_on = 0;
   time_in_hrs = 0;
   time_in_min = 0;
   time_out_hrs = 12;
   time_out_min = 60;
   time_in_ap = "AM";
   time_out_ap = "PM";
    
    $("form").submit(function(){
        confirm("submit data");
    });
    
   $(".hrs1:nth-of-type(2)").focusout(function(){
             hrs_off = parseInt($(this).val());
        if(hrs_on + hrs_off > 24 || (hrs_on + hrs_off == 24 && mins_on + mins_off >= 0 )){
                        hrschange();

}
        if(mins_on+mins_off > 60){
             if(hrs_on + hrs_off +1 >= 24){
                 minschange();
            }
        }
    }); 
    
    $(".hrs1:nth-of-type(4)").focusout(function(){
        hrs_on = parseInt($(this).val());
        if(hrs_on + hrs_off > 24 || (hrs_on + hrs_off == 24 && mins_on + mins_off >= 0 )){
            hrschange();
}
        if(mins_on+mins_off > 60){
             if(hrs_on + hrs_off +1 >= 24){
                 minschange();
            }
        }
    });
    
    $(".min1:nth-of-type(3)").focusout(function(){
        mins_off = parseInt($(this).val());
        if(hrs_on + hrs_off >= 24){
         hrschange();
}
        if(mins_on+mins_off > 60){
             if(hrs_on + hrs_off +1 == 24){
                 minschange();
            }
        }
    });
    
    $(".min1:nth-of-type(5)").focusout(function(){
        mins_on = parseInt($(this).val());
        if(hrs_on + hrs_off >= 24){
         hrschange();
}
        if(mins_on+mins_off > 60){
             if(hrs_on + hrs_off +1 == 24){
               minschange();
            }
        }
    });
    
    $(".min1").change(function(){
        if($(this).val() > 59){   
            alert("minutes can't be greater than 60");
            $(this).val("");}
    });
     $(".hrs1").change(function(){
        if($(this).val() > 23){
            alert("hours can't be greater than 24");
            $(this).val("");}
            
    });
    $(".min2").change(function(){
        if($(this).val() > 59){   
            alert("minutes can't be greater than 60");
            $(this).val("");}
    });
     $(".hrs2").change(function(){
        if($(this).val() > 11){
            alert("hours can't be greater than 11");
            $(this).val("");}          
    });
    
   
    time_out_ap = "PM";
    
    $(".hrs2:nth-of-type(6)").focusout(function(){
        time_in_hrs = $(this).val();

        var a ="01/03/2017 "+time_in_hrs+":"+time_in_min+":"+time_in_ap;
        var b ="01/03/2017 "+time_out_hrs+":"+time_out_min+":"+time_out_ap;
        
        if(Date.parse(a)>=Date.parse(b)){
                      change();          
        }
    });
    
     $(".hrs2:nth-of-type(8)").focusout(function(){
        time_out_hrs = $(this).val();
        
        var a ="01/03/2017 "+time_in_hrs+":"+time_in_min+":"+time_in_ap;
        var b ="01/03/2017 "+time_out_hrs+":"+time_out_min+":"+time_out_ap;
        
         if(Date.parse(a)>=Date.parse(b)){
                     change();          
        }
    }); 
    
    $(".min2:nth-of-type(7)").focusout(function(){
        time_in_min = $(this).val();

    var a ="01/03/2017 "+time_in_hrs+":"+time_in_min+":"+time_in_ap;
    var b ="01/03/2017 "+time_out_hrs+":"+time_out_min+":"+time_out_ap;
    
        if(Date.parse(a)>=Date.parse(b)){
                     change();          
        }
    });
    
    $(".min2:nth-of-type(9)").focusout(function(){
        time_out_min = $(this).val();

    var a ="01/03/2017 "+time_in_hrs+":"+time_in_min+":"+time_in_ap;
    var b ="01/03/2017 "+time_out_hrs+":"+time_out_min+":"+time_out_ap;
        
        if(Date.parse(a) > Date.parse(b)){
                      change();          
        }
    });
    
    $("#ap1").focusout(function(){
        time_in_ap = $(this).val();
    
    var a ="01/03/2017 "+time_in_hrs+":"+time_in_min+":"+time_in_ap;
    var b ="01/03/2017 "+time_out_hrs+":"+time_out_min+":"+time_out_ap;
    
        if(Date.parse(a) >= Date.parse(b)){
                    change();          
        }
    });
    
     $("#ap2").focusout(function(){
        time_out_ap = "PM";
        time_out_ap = $(this).val();
    
    var a ="01/03/2017 "+time_in_hrs+":"+time_in_min+":"+time_in_ap;
    var b ="01/03/2017 "+time_out_hrs+":"+time_out_min+":"+time_out_ap;
  
         if(Date.parse(a)>=Date.parse(b)){
                       change();          
        }
    });
    
    function change(){
         $(".hrs2:nth-of-type(6)").val("");
            $(".min2:nth-of-type(7)").val("");
            $(".hrs2:nth-of-type(8)").val("");
            $(".min2:nth-of-type(9)").val("");
            $("#ap1").val("AM");
            $("#ap2").val("PM");

             time_in_hrs = 0;
   time_in_min = 0;
   time_out_hrs = 12;
   time_out_min = 60;
   time_in_ap = "AM";
   time_out_ap = "PM";
    }
 
});

    function hrschange(){
           hrs_on = 0;
           hrs_off = 0;
             $(".hrs1:nth-of-type(2)").val("");
                 $(".hrs1:nth-of-type(4)").val("");
                 $(".min1:nth-of-type(3)").val("");
                 $(".min1:nth-of-type(5)").val("");
    }
    
    function minschange(){
          $(".hrs1:nth-of-type(2)").val("");
                 $(".hrs1:nth-of-type(4)").val("");
                 $(".min1:nth-of-type(3)").val("");
                 $(".min1:nth-of-type(5)").val("");
                                  hrs_off = 0;
   hrs_on = 0;
   mins_off = 0;
   mins_on = 0;
    }