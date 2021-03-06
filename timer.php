<?php

//if you are adding this code to the Wordpress/Woocommerce, delete <?php tag (line 1)

?>

<br><br>

//css part

<style>
    //desktop
    @media (min-width:500px){
        p.Days{
            color: #000000;
            font-family: "Arial";
        	font-weight: normal;
        	font-style: normal;
            text-align: center;
            font-size: 20px;
            margin-top: 1%;
            border-style: dotted;
            width: 20%;
            margin-left: 40%;
        }
    }
    //mobile
    @media (max-width:500px){
        p.Days{
            color: #000000;
            font-family: "Arial";
        	  font-weight: normal;
        	  font-style: normal;
            text-align: center;
            font-size: 20px;
            margin-top: 1%;
            border-style: dotted;
        }
    }
    div.allCount{
        border-style: ridge;
        border-width: thin;
    }
    
    h2.headDays{
        color: #000000;
        font-family: "Arial";
        text-align: center;
        font-weight: 700;
    }
    
    button.alisveris {
    background-color: #000000;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    margin-bottom: 1%;
}
</style>

//html part

<div class="allCount">
<h2 class="headDays">Next Shipping</h2>
<p class="Days" id="showDays"></p>

</div>

//javascript part

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

<?php
?>
//if you are adding this code to the Wordpress/Woocommerce, delete ?> tag (line 116)
