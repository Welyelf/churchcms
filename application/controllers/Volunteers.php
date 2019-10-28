<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($start_date = FALSE)
    {
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function volunteers_file()
    {
        // Get all volunteer schedules.
        $this->data['volunteers_file'] = $this->volunteers_file->get_all();
        // Load layout.
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function schedules($type = FALSE, $start_date = FALSE)
    {
        if ($start_date == FALSE) {
            $now = now();
        } else {
            $now = strtotime($start_date);
        }

        $this->data['type'] = $type;
        $this->data['month'] = date('F', $now);
        $this->data['year'] = date('Y', $now);

        $start_date = strtotime('1 ' . $this->data['month'] . ' ' . $this->data['year']);

        $this->data['num_days'] = date('t', $now);
        $this->data['offset'] = date('w', $start_date);
        $this->data['day'] = 1;
        $this->data['next_month'] = strtotime('+1 month', strtotime("{$this->data['month']} {$this->data['day']},{$this->data['year']}"));
        $this->data['prev_month'] = strtotime('-1 month', strtotime("{$this->data['month']} {$this->data['day']},{$this->data['year']}"));

        // Set volunteer_schedules data from get_volunteer_schedules() function.
        $this->data['volunteer_schedules'] = $this->get_volunteer_schedules($start_date, $this->data['num_days'], $type);
        $this->load->view('layout/frontend/master', $this->data);
    }

    private function get_volunteer_schedules($start_date = FALSE, $num_days = 7, $type)
    {
        // Calendar date init.
        if ($start_date == FALSE) {
            $date_offset = date('w');
            $start_date = date('Y-m-d', strtotime('-' . $date_offset . ' day'));
        } else {
            $start_date = date('Y-m-d', $start_date);
        }
        $date_range = date_range($start_date, $num_days - 1, FALSE, 'Y-m-d');

        // Init array.
        $volunteer_schedules = array();

        foreach ($date_range as $date) {
            $volunteer_schedules[strtotime($date)] = array();
        }

        // Get all volunteer schedules.
        $schedules = $this->volunteers->get_schedules($date_range[$num_days - 1], $type);

        // Loop all schedules first.
        foreach ($schedules as $schedule) {
            // Loop each date.
            foreach ($date_range as $date) {
                // Set date from schedule.
                $sched_date = date('Y-m-d', $schedule->datetime);
                // Check if date in calendar same with schedule date. If TRUE, then add it to the box date.
                if ($date == $sched_date)
                    array_push($volunteer_schedules[strtotime($date)], $schedule);
            }
        }

        return $volunteer_schedules;
    }

}