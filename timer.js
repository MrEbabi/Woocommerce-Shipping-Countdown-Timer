//this part is the only JS part of the code, for the full working version, kindly check "timer.php" code

<script>
//code is based on 24 hour-clock system
//shipping time is chosen as 16:00 for days monday-tuesday-wednesday-thursday-friday
//it is restricted such that there will be no shipping on saturday and sunday
var x = setInterval(function()
{
    var deliverDays = 0;
    var deliverHours = 23;
    var deliverMinutes = 59;
    var deliverSeconds = 59;
    var date = new Date();
    var day = date.getDay();
    var hour = date.getHours();
    var minute = date.getMinutes();
    var second = date.getSeconds();
    
    //remaining days are calculating if it is weekend (friday or/and saturday is adding)
    if((day == 5 && hour >= 16) || (day == 6 && hour < 16)) deliverDays = 2;
    else if((day === 6 && hour >=16) || (day == 0 && hour < 16)) deliverDays = 1;
    
    //remaining time is calculating
    if(hour >= 16 ) deliverHours = deliverHours - (hour - 16);
    else deliverHours = (15 - hour);
    deliverMinutes = 59 - minute;
    deliverSeconds = 59 - second;
    
    var show0 = deliverHours + " Hours " + deliverMinutes + " Minutes " + deliverSeconds + " Seconds ";
    
    var show1 = deliverDays + " Days " + deliverHours + " Hours " + deliverMinutes + " Minutes " + deliverSeconds + " Seconds ";
    
    if(deliverDays > 0) document.getElementById("showDays").innerHTML = show1;
    else document.getElementById("showDays").innerHTML = show0;
}, 1000);
    
</script>
