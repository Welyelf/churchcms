<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $widgets = $this->home_model->get_active_widgets();

        $this->data['widgets']['right_sidebar'] = array();
        $this->data['widgets']['page_header'] = array();
        $this->data['widgets']['content'] = array();
        $this->data['widgets']['full-width'] = array();

        foreach ($widgets as $widget) {
            $func = $widget->function_name;
            if ($widget->location != NULL) {
                $view_parameters = json_decode($widget->view_parameters, TRUE);
                $model_parameters = json_decode($widget->model_parameters, TRUE);

                array_push($this->data['widgets'][$widget->location], $this->$func($view_parameters, $model_parameters, $widget->location, $widget->custom_css, $widget->custom_js));
            }

        }
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function custom_widget($view_parameters = array(), $model_parameters = array(), $widget_css = null, $widget_js = null)
    {
        if (isset($view_parameters['content'])) {
            $this->data['view_parameters'] = $view_parameters;
            $this->data['widget_css'] = $widget_css;
            $this->data['js_widget'] = $widget_js;
            return $this->load->view('home/widgets/custom_widget', $this->data, true);
        } else {
            log_message('error', 'Could not load custom_widget because of missing "content" in the view_parameters.');
            return;
        }
    }


    public function events_widget($view_parameters = array(), $model_parameters = array())
    {
        $start_date = date('Y-m-d');
        $date_range = date_range($start_date, 6, FALSE, 'Y-m-d');
        if (isset($convert_date)) {
            $date_year = date('Y', $convert_date);
        } else {
            $date_year = date('Y');
        }
        $events = array();

        //var_dump($date_range);

        foreach ($date_range as $date) {
            $events[strtotime($date)] = array();
        }

        $recurring_events = $this->events->get_week_events($date_range[6]);

        foreach ($recurring_events as $event) {
            // Fix to show events that are not showing with none recurrence.
            switch ($event->recurrence) {
                case 'none':
                    foreach ($date_range as $date) {
                        // Set current date from unix to human.
                        $curdate = date('Y-m-d', $event->datetime);
                        // Check if date is same from database date. Then push to the date box.
                        if ($date == $curdate) {
                            array_push($events[strtotime($date)], $event);
                        }
                    }
                    break;
                case 'daily':
                    foreach ($date_range as $date) {
                        // Set From date.
                        $from = strtotime($date . '0:00');
                        // Set End date.
                        $to = strtotime($date . '0:00');
                        // Check if end date same with date range end. Then push event data to upcoming events.
                        if ($from >= $event->datetime && $to <= $event->end_date) {
                            array_push($events[strtotime($date)], $event);
                        }
                        // Display events with no expiry.
                        if ($from >= $event->datetime && !$event->end_date) {
                            array_push($events[strtotime($date)], $event);
                        }

                    }
                    break;
                case 'weekly':
                    // New code for weekly - Fixed issue regarding incorrect event day.
                    foreach ($date_range as $date) {
                        // Get the day of the week based on the current date.
                        $day_of_the_week = date("w", strtotime($date));
                        // Get all days in database.
                        $days = str_split($event->day_weekly, 1);
                        // Set From date.
                        $from = strtotime($date . '0:00');
                        // Set End date.
                        $to = strtotime($date . '0:00');

                        if (in_array($day_of_the_week, $days)) {
                            if ($from >= $event->datetime && $to <= $event->end_date)
                                foreach ($days as $day_of_week) {
                                    if ($day_of_week == $day_of_the_week)
                                        array_push($events[strtotime($date)], $event);
                                }

                            // Display events with no expiry.
                            if ($from >= $event->datetime && !$event->end_date)
                                foreach ($days as $day_of_week) {
                                    if ($day_of_week == $day_of_the_week)
                                        array_push($events[strtotime($date)], $event);
                                }

                        }

                    }

                    // Old Code ----------------------
                    //$days = str_split ($event->day_weekly,1); // days of the week to recur
//                    $day_of_the_week = date('w');
//
//                    if($day_of_the_week > $event->day_weekly){
//                        $days = str_split( (7-(date('w')) + $event->day_weekly  ),1);  // occur on the actual day
//                    }else if($day_of_the_week < $event->day_weekly){
//                        $days = str_split(($event->day_weekly - $day_of_the_week),1);
//                    }else if($day_of_the_week == $event->day_weekly){
//                        $days = str_split((0),1);
//                    }
//                    else{
//                        $days =str_split($event->day_weekly,1);
//                    }
//
//                    foreach($days as $day_of_week) {
//                        array_push($events[strtotime($date_range[$day_of_week])],$event);
//                    }
                    break;
                case 'monthly':
                    if ($event->day_monthly < 10) {
                        $event->day_monthly = '0' . $event->day_monthly;
                    }

                    foreach ($date_range as $date) {
                        $recur_date = substr($date, 0, 8) . $event->day_monthly;
                        if ($date == $recur_date) {
                            // Set From date.
                            $from = strtotime($recur_date . '0:00');
                            // Set End date.
                            $to = strtotime($recur_date . '0:00');

                            if ($from >= $event->datetime && $to <= $event->end_date)
                                array_push($events[strtotime($date)], $event);

                            // Display events with no expiry.
                            if ($from >= $event->datetime && !$event->end_date)
                                array_push($events[strtotime($date)], $event);

                        }
                    }
                    break;
                case 'yearly':
                    if ($event->day_yearly < 10) {
                        $event->day_yearly = '0' . $event->day_yearly;
                    }
                    if ($event->month_yearly < 10) {
                        $event->month_yearly = '0' . $event->month_yearly;
                    }

                    foreach ($date_range as $date) {
                        $recur_date = substr($date, 0, 5) . $event->month_yearly . '-' . $event->day_yearly;
                        if ($date == $recur_date) {
                            // Set From date.
                            $from = strtotime($recur_date . '0:00');
                            // Set End date.
                            $to = strtotime($recur_date . '0:00');

                            if ($from >= $event->datetime && $to <= $event->end_date) {
                                array_push($events[strtotime($date)], $event);
                            }
                            // Display events with no expiry.
                            if ($from >= $event->datetime && !$event->end_date) {
                                array_push($events[strtotime($date)], $event);
                            }
                        }
                    }
                    break;
                case 'others':
                    $year = $date_year;
                    $months = explode("|", $event->month_others);
                    foreach ($months as $month) {
                        $date = date_create($event->order_others . " " . $event->weekday_others . " of " . get_month($month) . " " . $year);
                        $date = date_format($date, "Y-m-d");
                        if (in_array($date, $date_range)) {
                            // Set From date.
                            $from = strtotime($date . '0:00');
                            // Set End date.
                            $to = strtotime($date . '0:00');

                            if ($from >= $event->datetime && $to <= $event->end_date) {
                                array_push($events[strtotime($date)], $event);
                            }
                            // Display events with no expiry.
                            if ($from >= $event->datetime && !$event->end_date) {
                                array_push($events[strtotime($date)], $event);
                            }
                        }
                    }
                    break;
                default:
                    log_message('error', "Unexpected event recurrence type '$event->recurrence'.");
                    break;
            }
        }

        foreach ($events as $key => $event_list) {
            if (count($event_list) > 1) {
                usort($event_list, 'sortByTime');
                $events[$key] = $event_list;
            }
        }

        $this->data['days'] = $events;
        return $this->load->view('home/widgets/events_widget', $this->data, true);
    }

    public function service_widget($view_parameters = array(), $model_parameters = array())
    {
        $weekly_events = $this->events->get_weekly_recurring();
        usort($weekly_events, 'sortByTime');
        $this->data['weekly_events'] = $weekly_events;

        return $this->load->view('home/widgets/service_widget', $this->data, true);
    }

    public function blogs_widget($view_parameters = array(), $model_parameters = array())
    {
        $maximum_blog_posts = 3; //Default value
        $maximum_characters = 250; //Default value
        if (isset($model_parameters['blog_posts_to_display'])) {
            $maximum_blog_posts = whole_number($model_parameters['blog_posts_to_display'], $maximum_blog_posts);
            if (!isset($maximum_blog_posts)) {
                log_message('error', "blog_posts_to_display must be a positive integer. {$model_parameters['blog_posts_to_display']} provided. Using default value of {$maximum_blog_posts}.");
            }
        }
        if (isset($model_parameters['characters_to_display'])) {
            $maximum_characters = whole_number($model_parameters['characters_to_display'], $maximum_characters);
            if (!isset($maximum_characters)) {
                log_message('error', "characters_to_display must be a positive integer. {$model_parameters['characters_to_display']} provided. Using default value of {$maximum_characters}.");
            }
        }
        $maximum_characters = ($maximum_characters * 10) + 100; //ensuring a minimum number of characters so we can strip out HTML
        $blog_posts = $this->posts->get_blogs_widget($maximum_blog_posts, $maximum_characters);
        $this->data['blog_posts'] = $blog_posts;
        $this->data['maximum_characters'] = $maximum_characters;

        return $this->load->view('home/widgets/blogs_widget', $this->data, true);
    }

    public function donations_widget($view_parameters = array(), $model_parameters = array())
    {
        return $this->load->view('home/widgets/donations_widget', '', true);
    }

    public function sermons_widget($view_parameters = array(), $model_parameters = array(), $location )
    {
        // $this->data['sermons'] = $this->sermons->get_all(5,0);
        if (isset($model_parameters['max_sermons'])) {
            $sermons = $this->sermons->get_sermons(FALSE, FALSE, $model_parameters['max_sermons'], 0);
        } else {
            $sermons = $this->sermons->get_sermons(FALSE, FALSE, 5, 0);
        }

        // Initialize a new sermon array.
        $sermons_new = array();

        // Loop each sermon data to get their passages/scriptures.
        foreach ($sermons as $sermon) {
            // Get all the passages of the sermon from the scriptures table.
            $sermon->passages = $this->sermon_scriptures_model->get_sermon_scriptures($sermon->id);
            // Push the new sermon with passages to the new sermon array.
            array_push($sermons_new, $sermon);
        }
        // Set Sermons with the new sermon array generated.
        $view_parameters['sermons'] = $sermons_new;
        $view_parameters['location'] = $location;

        return $this->load->view('home/widgets/sermons_widget', $view_parameters, true);

    }

    public function header_widget($view_parameters = array(), $model_parameters = array())
    {
        if (isset($view_parameters['site_name']) && isset($view_parameters['denomination']) && isset($view_parameters['photo_banner'])) {
            return $this->load->view('home/widgets/header_widget', $view_parameters, true);
        } else {
            log_message('error', 'Could not load header_widget. Missing required view_parameters: site_name, denomination, and/or photo_banner.');
            return;
        }
    }

    public function install()
    {
        $this->load->library('Database_schema');
        $this->config->load('install');

        $database_schema = $this->database_schema->get_table_fields();
        $list_of_tables = $this->database_schema->get_all_database();

        // check all missing table(s) on database
        for ($a = 0; $a < count($list_of_tables); $a++) {
            if (!$this->db->table_exists($list_of_tables[$a])) {
                log_message('error', "Missing{ $list_of_tables[$a] } table. Processing this command to add table. Create table {$list_of_tables[$a] } (id INT(2) PRIMARY KEY) ");
                echo "Missing{ $list_of_tables[$a] } table. Processing this command to add table. Create table {$list_of_tables[$a] } (id INT(2) PRIMARY KEY) ";
                $add_table_query = "CREATE TABLE $list_of_tables[$a] (id int(11) PRIMARY KEY)";

                $this->home_model->install_table($add_table_query);
            }
        }
        // check all field(s) on database
        // array (table name,field name,type,constraint,Isnull)
        $add_fields = $this->database_schema->add_fields();

        if ($this->config->item('install_complete') == FALSE) {
            for ($x = 0; $x < count($add_fields); $x++) {
                if (!$this->db->field_exists($add_fields[$x][1], $add_fields[$x][0])) {
                    $fields = array(
                        $add_fields[$x][1] => array(
                            'type' => $add_fields[$x][2],
                            'constraint' => $add_fields[$x][3],
                            'null' => $add_fields[$x][4],
                        )
                    );
                    if ($this->home_model->install_field($add_fields[$x][0], $fields)) {
                        $this->load->helper('file');
                        $config_file = APPPATH . 'config/install.php';
                        $config_true = "<?php defined('BASEPATH') OR exit('No direct script access allowed');\n\n \$config['install_complete']=TRUE;";
                        write_file($config_file, $config_true);
                        echo '' . $add_fields[$x][1] . ' Successfully added to ' . $add_fields[$x][0] . ' table.';
                    }
                } else {
                    echo '' . $add_fields[$x][1] . ' already exist on ' . $add_fields[$x][0] . ' table. ';
                    echo "<br>";
                }
            }
        } else {
            echo "Query has been executed";
        }
        echo "<br>";


        // check for extra field(s) on the table
        for ($a = 0; $a < count($list_of_tables); $a++) {
            $fields = $this->db->field_data($list_of_tables[$a]);
            foreach ($fields as $field) {
                $flag_name = 0;
                $flag_type = 0;

                for ($x = 0; $x < count($database_schema[$list_of_tables[$a]]); $x++) {
                    if ($field->name == $database_schema[$list_of_tables[$a]][$x]['name']) {
                        if ($field->type == $database_schema[$list_of_tables[$a]][$x]['type']) {
                            $flag_type = 0;
                        } else {
                            $correct_type = $database_schema[$list_of_tables[$a]][$x]['type'];
                            $flag_type = 1;
                        }
                        $flag_name = 0;
                        break;
                    } else {
                        $flag_name = 1;
                    }

                }
                if ($flag_name == 1) {
                    echo '(' . $field->name . ') doesnt exist on [ ' . $list_of_tables[$a] . ' ] table !';
                    echo "<br>";
                    log_message('error', " Categories table has an extra field {$field->name} ");
                }
                if ($flag_type == 1) {
                    echo '(' . $field->name . ') on [' . $list_of_tables[$a] . '] table  doesnt have a correct type .';
                    echo "<br>";
                    echo 'Database type : ' . $field->type . ' Actual type :' . $correct_type;
                    echo "<br>";
                    log_message('error', "('.$field->name . ') on ['.$list_of_tables[$a].'] table  doesnt have a correct type .");
                }
            }
        }
    }

}
