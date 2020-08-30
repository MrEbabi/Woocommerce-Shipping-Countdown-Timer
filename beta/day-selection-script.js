jQuery.ajax({
    type:"POST",
    url: day_selection_object.ajax_url,
    data: { 'action': 'get_countdown_timer_settings' },
    success:function(data) {
        showCounter(data);
    }
})

function showCounter(data) {
    data = data.replace('[', '');
    data = data.replace(']', '');
    data = data.replace('"', '');
    data = data.replace('"', '');
    data = data.replace('"', '');
    data = data.replace('"', '');
    var dataFields = data.split(',');
    var pureDays = dataFields[0].split('');
    var selectedDays = dataFields[0];
    var selectedHour = dataFields[1];
     
    setInterval(function(){ 
        
        var thisDay = new Date();
    
        //remaining days are calculating
        var minDayDistance = 6;
        var dayDistance;
        var today = thisDay.getDay();
        for (var i = 0; i < selectedDays.length; i++)
        {
            if(selectedDays[i] > today) dayDistance = selectedDays[i] - today;
            else dayDistance = selectedDays[i] - today + 7;
            if(dayDistance < minDayDistance) minDayDistance = dayDistance;
        }
        var deliverDays = minDayDistance;
        
        //remaining hour is calculating
        var hour = thisDay.getHours();
        var hourDistance;
        if(selectedHour > hour) hourDistance = selectedHour - hour;    
        else hourDistance = selectedHour - hour + 24;
    
        var deliverHours = hourDistance - 1;
        
        var minute = thisDay.getMinutes();
        var second = thisDay.getSeconds();
        
        var deliverMinutes = 59 - minute;
        var deliverSeconds = 59 - second;
        if(selectedHour == hour && minute === 0 && second === 0) deliverHours = 0;
        if(selectedDays == today && selectedHour == hour && minute === 0 && second === 0) deliverDays = 0;
        if(selectedHour <= hour) deliverDays = deliverDays - 1;
        
        /*
        console.log(thisDay);
        if(deliverDays > 0) console.log(deliverDays, 'gün');
        if(deliverHours > 0) console.log(deliverHours, 'saat');
        console.log(deliverMinutes, 'dakika');
        console.log(deliverSeconds, 'saniye');
        */
        
        var showDayHour = deliverDays + "Days" + deliverHours + " Hours " + deliverMinutes + " Minutes " + deliverSeconds + " Seconds ";
        var showDay = deliverDays + "Days" + deliverMinutes + " Minutes " + deliverSeconds + " Seconds ";
        var showHour = deliverHours + "Hours" + deliverMinutes + " Minutes " + deliverSeconds + " Seconds ";
        var showNon = deliverMinutes + " Minutes " + deliverSeconds + " Seconds ";
        
        if(deliverDays > 0)
        {
            if(deliverHours > 0)
            {
                document.getElementById("showDays").innerHTML = showDayHour;
            }
            else
            {
                document.getElementById("showDays").innerHTML = showDay;
            }
        }
        else if(deliverHours > 0)
        {
            document.getElementById("showDays").innerHTML = showHour;
        }
        else document.getElementById("showDays").innerHTML = showNon;
    
    }, 1000);
}
