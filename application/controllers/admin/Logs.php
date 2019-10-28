<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function index()
    {
        $this->data['date_range'] = (object)array();
        $input = $this->input->post();

        if ($input) {
            $date_range['from'] = strtotime($input['from']);
            $date_range['to'] = strtotime($input['to']);
            $this->data['date_range']->from = set_value("from");
            $this->data['date_range']->to = set_value("to");
        } else {
            $cur_date = date('m/d/Y', now());
            $date_range['from'] = strtotime($cur_date . '-1 month');
            $date_range['to'] = strtotime($cur_date);
            $this->data['date_range']->from = date('m/d/Y', $date_range['from']);
            $this->data['date_range']->to = $cur_date;
        }


        $this->data['logs'] = $this->logs_model->get($date_range);

        $this->load->view('layout/backend/master', $this->data);
    }

    public function view($id)
    {

        $this->data['log'] = $this->logs_model->get_detail($id);

        $this->load->view('layout/backend/master', $this->data);
    }
}
