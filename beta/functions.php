function get_countdown_timer_settings() {
    global $wpdb;
    $dayResults = $wpdb->get_results("SELECT * FROM wp_options WHERE option_name = '_product_countdown_timer_days'");
    $timeResults = $wpdb->get_results("SELECT * FROM wp_options WHERE option_name = '_product_countdown_timer_hour'");
    $result = array($dayResults[0]->option_value, $timeResults[0]->option_value);
    echo json_encode($result);
    wp_die();
}

add_action( 'wp_ajax_nopriv_get_countdown_timer_settings', 'get_countdown_timer_settings' );
add_action( 'wp_ajax_get_countdown_timer_settings', 'get_countdown_timer_settings' );

add_menu_page( 'Countdown Timer', 'Countdown Timer', 'manage_options' , 'day-selection-form' , 'day_selection_form', 'dashicons-warning' , '54');

function load_countdown_timer_scripts() {
    if(is_product())
    {
        wp_enqueue_script( 'day-selection-script', get_stylesheet_directory_uri() . '/day-selection-script.js', array('jquery') );
        wp_localize_script( 'day-selection-script', 'day_selection_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
}

add_action('wp_enqueue_scripts', 'load_countdown_timer_scripts');

function day_selection_form () {
    
    $day_time_selection_form = "<h2>Shipping Countdown Timer Settings</h2>";

    $day_time_selection_form .= "<div style='margin: 50px; background-color: lavender; line-height: 30px; width: 200px;'>";
    
    $day_time_selection_form .= "<form action='' method='post'>";

	$days = array(
		1 => "MONDAY",
		2 => "TUESDAY",
		3 => "WEDNESDAY",
		4 => "THURSDAY",
		5 => "FRIDAY",
		6 => "SATURDAY",
		7 => "SUNDAY",
	);
	
	$times = array(
	    0 => "00.00",
	    1 => "01.00",
		2 => "02.00",
		3 => "03.00",
		4 => "04.00",
		5 => "05.00",
		6 => "06.00",
		7 => "07.00",
		8 => "08.00",
	    9 => "09.00",
		10 => "10.00",
		11 => "11.00",
		12 => "12.00",
		13 => "13.00",
		14 => "14.00",
		15 => "15.00",
		16 => "16.00",
		17 => "17.00",
		18 => "18.00",
		19 => "19.00",
		20 => "20.00",
		21 => "21.00",
		22 => "22.00",
		23 => "23.00"
	);

	foreach($days as $day_num => $day_name) {
		$day_time_selection_form .= "
			<input type='checkbox' 
				name='daySelection[]' 
				value='".esc_html($day_num)."'
			/>
			<label>
				".esc_html($day_name)."
			</label>
			<br/>
		";
	}
	
	$day_time_selection_form .= "<br/><select name='timeSelection'>";
	
	foreach($times as $time_num => $time_name) {
		$day_time_selection_form .= "
			<option value='".esc_html($time_num)."'>
			    ".esc_html($time_name)."
			</option>
			<br/>
		";
	}
	
	$day_time_selection_form .= "</select>";
	$day_time_selection_form .= "<br/><br/>";
	$day_time_selection_form .= "<input type='submit' value='Kaydet' name='submitTimerSettings'>";

	$day_time_selection_form .= "</form></div>";
	
	echo $day_time_selection_form;
	
	if(isset($_POST['submitTimerSettings']))
    {
        if(isset($_POST['daySelection']) && !empty($_POST['daySelection']) && isset($_POST['timeSelection']) && !empty($_POST['timeSelection']))
        {
            $daySelection = "";
            foreach($_POST['daySelection'] as $selectedDays) {
                $daySelection .= $selectedDays;
            }
            $timeSelection = sanitize_text_field($_POST['timeSelection']);
            $options = get_option('_product_countdown_timer_days');
            if(!$options)
            {
                add_option('_product_countdown_timer_days', $daySelection);
            }
            else
            {
                update_option('_product_countdown_timer_days', $daySelection);
            }
            $options = get_option('_product_countdown_timer_hour');
            if(!$options)
            {
                add_option('_product_countdown_timer_hour', $timeSelection);
            }
            else
            {
                update_option('_product_countdown_timer_hour', $timeSelection);
            }
        }
    }
}


add_shortcode('daySelectionForm', 'day_selection_form');
