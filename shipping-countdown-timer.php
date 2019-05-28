function shipping_countdown_timer($attributes)
{
	$attr = shortcode_atts( array(
      'hour' => 16,
      'minute' => 0,
      'second' => 0
      ), $attributes );
	?>
	<style>

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
	width: 30%;
	margin-left: 35%;
	}
	}

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
	</style>
    <?php
    $content = "<div class='allCount'>";
    $content .= "<h2 class='headDays'>Next Shipping</h2>";
    $content .= "<p class='Days' id='showDays'></p></div>";
	?>
    <script>
	//code is based on 24 hour-clock system
	//shipping time is chosen as 16:00 for days monday-tuesday-wednesday-thursday-friday
	//it is restricted such that there will be no shipping on saturday and sunday
	var x = setInterval(function()
	{
		var givenHour = <?php echo $attr[hour] ?>;
		var givenMinute = <?php echo $attr[minute] ?>;
		var givenSecond = <?php echo $attr[second] ?>;
		
		var deliverDays = 0;
		
		var date = new Date();
		var day = date.getDay();
		var hour = date.getHours();
		var minute = date.getMinutes();
		var second = date.getSeconds();
		
		//remaining days are calculating if it is weekend (friday or/and saturday is adding)
		if((day == 5 && hour >= givenHour ) || (day == 6 && hour < givenHour)) deliverDays = 2;
		else if((day === 6 && hour >= givenHour ) || (day == 0 && hour < givenHour)) deliverDays = 1;
		
		//remaining time is calculating
		var remainingHour = givenHour - hour - 1;
		var remainingMinute = givenMinute - minute;
		var remainingSecond = givenSecond - second - 1;
		
		if(remainingHour < 0 ) remainingHour += 24;
		if(remainingMinute < 0 ) remainingMinute += 60;
		if(remainingSecond < 0 ) remainingSecond += 60;
		
		if(givenHour == hour && givenMinute >= minute ) { remainingHour = 0; }
		if(givenMinute == minute) remainingMinute = 0;
		
		var show0 = remainingHour + " Hours " + remainingMinute + " Minutes " + remainingSecond + " Seconds ";
		
		var show1 = deliverDays + " Days " + remainingHour + " Hours " + remainingMinute + " Minutes " + remainingSecond + " Seconds ";
		
		if(deliverDays > 0) document.getElementById("showDays").innerHTML = show1;
		else document.getElementById("showDays").innerHTML = show0;
	}, 1000);
		
	</script>
	
	<?php
	return $content;
}

add_shortcode( 'shipping-countdown-timer', 'shipping_countdown_timer' );
