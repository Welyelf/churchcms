<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['events'] = $this->events->get_all();

        $this->load->view('layout/backend/master', $this->data);
    }

    public function add($id = null)
    {
        if (isset($id)) {
            $this->data['event'] = $this->events->get_details($id);
        }

        $input = $this->input->post();

        //var_dump($input);exit;

        if ($input) {
            if ($this->form_validation->run('add_event') == TRUE) {
                $input['datetime'] = human_to_unix($input['date'] . " 0:0");
                unset($input['date']);

                if (!empty($input['end_date'])) {
                    $input['end_date'] = human_to_unix($input['end_date'] . " 0:0");
                }

                // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
//                if($input['end_date'] == 0){
//                    $input['end_date'] = $input['datetime'];
//                }

                if ($input['recurrence'] == 'none') {

                    unset($input['day_weekly']);
                    unset($input['day_monthly']);
                    unset($input['month_yearly']);
                    unset($input['day_yearly']);
                    unset($input['end_date']);
                    unset($input['order_others']);
                    unset($input['weekday_others']);
                    unset($input['month_others']);

                } else if ($input['recurrence'] == 'daily') {

                    unset($input['day_weekly']);
                    unset($input['day_monthly']);
                    unset($input['month_yearly']);
                    unset($input['day_yearly']);
                    unset($input['order_others']);
                    unset($input['weekday_others']);
                    unset($input['month_others']);

                } else if ($input['recurrence'] == 'weekly') {

                    $input['day_weekly'] = implode($input['day_weekly']);
                    unset($input['day_monthly']);
                    unset($input['month_yearly']);
                    unset($input['day_yearly']);
                    unset($input['order_others']);
                    unset($input['weekday_others']);
                    unset($input['month_others']);

                } else if ($input['recurrence'] == 'monthly') {

                    unset($input['day_weekly']);
                    unset($input['month_yearly']);
                    unset($input['day_yearly']);
                    unset($input['order_others']);
                    unset($input['weekday_others']);
                    unset($input['month_others']);

                } else if ($input['recurrence'] == 'yearly') {

                    unset($input['day_weekly']);
                    unset($input['day_monthly']);
                    unset($input['order_others']);
                    unset($input['weekday_others']);
                    unset($input['month_others']);

                } else if ($input['recurrence'] == 'others') {

                    $input['month_others'] = implode("|", $input['month_others']);
                    unset($input['day_weekly']);
                    unset($input['day_monthly']);
                    unset($input['month_yearly']);
                    unset($input['day_yearly']);

                }
                if (isset($id)) {
                    $this->events->update($input, $id);
                } else {
                    $this->events->add($input);

                }
                redirect('/admin/events/all');
            }
        }

        $this->load->view('layout/backend/master', $this->data);
    }


    public function delete($id)
    {
        if ($this->events->delete($id)) {
            redirect('/admin/events/all');
        }
    }
}