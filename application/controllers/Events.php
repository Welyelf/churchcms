<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($start_date = FALSE)
    {
        if ($start_date == FALSE) {
            $start_date = date('Y-m-d');
        } else {
            $convert_date = strtotime($start_date);
            $start_date = date('Y-m-d', $convert_date);
        }
        $date_range = date_range($start_date, 6, FALSE, 'Y-m-d');
        // Set the date based on current date week view.
        if (isset($convert_date)) {
            $date_year = date('Y', $convert_date);
        } else {
            $date_year = date('Y');
        }
        $events = array();


        foreach ($date_range as $date) {
            $events[strtotime($date)] = array();
            //$events[strtotime($date)] = $this->events->get_events_by_date($date); comment for future reference
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
                            if ($from >= $event->datetime && !$event->end_date) {
                                foreach ($days as $day_of_week) {
                                    if ($day_of_week == $day_of_the_week)
                                        array_push($events[strtotime($date)], $event);
                                }
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

        //echo "<pre>";
        //var_dump($events);
        $this->data['events'] = $events;

        $this->data['sermons'] = $this->sermons->get_sermons_by_date($start_date);

        $this->data['prev_week'] = date('Y-m-d', strtotime($start_date) - 604800);
        $this->data['next_week'] = date('Y-m-d', strtotime($start_date) + 604800);

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function view($id)
    {
        $this->data['event'] = $this->events->get_details($id);
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function month($start_date = FALSE)
    {
        if ($start_date == FALSE) {
            $now = now();
        } else {
            $now = strtotime($start_date);
        }

        $this->data['month'] = date('F', $now);
        $this->data['year'] = date('Y', $now);

        $start_date = strtotime('1 ' . $this->data['month'] . ' ' . $this->data['year']);

        $this->data['num_days'] = date('t', $now);
        $this->data['offset'] = date('w', $start_date);
        $this->data['day'] = 1;
        $this->data['next_month'] = strtotime('+1 month', strtotime("{$this->data['month']} {$this->data['day']},{$this->data['year']}"));
        $this->data['prev_month'] = strtotime('-1 month', strtotime("{$this->data['month']} {$this->data['day']},{$this->data['year']}"));

        $this->data['events'] = $this->get_events($start_date, $this->data['num_days'], $this->data['year']);
        $this->data['sermons'] = $this->sermons->get_sermons_by_date($start_date);
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function daily($start_date = FALSE)
    {
        if ($start_date == FALSE) {
            $now = now();
        } else {
            $now = strtotime($start_date);
        }
        $this->data['month'] = date('F', $now);
        $this->data['year'] = date('Y', $now);
        $this->data['day'] = date('d', $now);

        $start_date = strtotime('1 ' . $this->data['month'] . ' ' . $this->data['year']);
        $this->data['num_days'] = date('t', $now);

        $this->data['events'] = $this->get_events($start_date, $this->data['num_days']);
        $this->load->view('layout/frontend/master', $this->data);
    }


    public function active()
    {
        $this->data['events'] = $this->events->get_active();
        $this->load->view('layout/frontend/master', $this->data);
    }

    private function get_events($start_date = FALSE, $num_days = 7, $date_year = FALSE)
    {
        if ($start_date == FALSE) {
            $date_offset = date('w');
            $start_date = date('Y-m-d', strtotime('-' . $date_offset . ' day'));
        } else {
            $start_date = date('Y-m-d', $start_date);
        }
        $date_range = date_range($start_date, $num_days - 1, FALSE, 'Y-m-d');

        $events = array();

        foreach ($date_range as $date) {
            $events[strtotime($date)] = array();
            //$events[strtotime($date)] = $this->events->get_events_by_date($date);
        }

        $recurring_events = $this->events->get_week_events($date_range[$num_days - 1], TRUE);


        foreach ($recurring_events as $event) {
            // Fix to show events that are not showing with none recurrence.
            if ($event->recurrence == 'none') {
                foreach ($date_range as $date) {
                    // Set current date from unix to human.
                    $curdate = date('Y-m-d', $event->datetime);
                    // Check if date is same from database date. Then push to the date box.
                    if ($date == $curdate) {
                        array_push($events[strtotime($date)], $event);
                    }
                }
            } else if ($event->recurrence == 'daily') {
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
            } else if ($event->recurrence == 'weekly') {

                $days = str_split($event->day_weekly, 1); // days of the week to recur

                //var_dump($date_range);exit;

                foreach ($date_range as $date) {
                    $day_of_the_week = date('w', strtotime($date));

                    $from = strtotime($date . '0:00');
                    $to = strtotime($date . '0:00');

                    if (in_array($day_of_the_week, $days)) {
                        if ($from >= $event->datetime && $to <= $event->end_date) {
                            foreach ($days as $day_of_week) {
                                if ($day_of_week == $day_of_the_week)
                                    array_push($events[strtotime($date)], $event);
                            }
                        }

                        // Display events with no expiry.
                        if ($from >= $event->datetime && !$event->end_date) {
                            foreach ($days as $day_of_week) {
                                if ($day_of_week == $day_of_the_week)
                                    array_push($events[strtotime($date)], $event);
                            }
                        }
                    }
                }
            } else if ($event->recurrence == 'monthly') {

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

                        if ($from >= $event->datetime && $to <= $event->end_date) {
                            array_push($events[strtotime($date)], $event);
                        }
                        // Display events with no expiry.
                        if ($from >= $event->datetime && !$event->end_date) {
                            array_push($events[strtotime($date)], $event);
                        }
                    }
                }

            } else if ($event->recurrence == 'yearly') {

                if ($event->day_yearly < 10) {
                    $event->day_yearly = '0' . $event->day_yearly;
                }

                if ($event->month_yearly < 10) {
                    $event->month_yearly = '0' . $event->month_yearly;
                }

                foreach ($date_range as $date) {

                    $recur_date = substr($date, 0, 5) . $event->month_yearly . '-' . $event->day_yearly;

                    //echo $recur_date;
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
            } else if ($event->recurrence == 'others') {
                // Set the Year.
                $year = ($date_year) ? $date_year : date('Y');
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
            }
        }

        foreach ($events as $key => $event_list) {
            if (count($event_list) > 1) {
                usort($event_list, 'sortByTime');
                $events[$key] = $event_list;
            }
        }
        return $events;
    }

}