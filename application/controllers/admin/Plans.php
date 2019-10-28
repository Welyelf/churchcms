<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends MY_Controller
{

    private $secret_key;
    private $public_key;

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));

        if ($this->settings["stripe_test_mode"] == 1) {
            $this->secret_key = $this->settings['test_stripe_sk'];
            $this->public_key = $this->settings['test_stripe_pk'];
        } else {
            $this->secret_key = $this->settings['live_stripe_sk'];
            $this->public_key = $this->settings['live_stripe_pk'];
        }
    }

    public function all()
    {
        $this->data['plans'] = $this->plans->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function add()
    {
        //$this->auth->check(array("Super Admin", "Admin"));
        $input = $this->input->post();

        if ($input) {
            if ($this->form_validation->run('add_plan') == TRUE) {
                $this->plans->add($input);

                $pos = strpos($input['amount'], ".");
                if ($pos > 0) {
                    $input['amount'] = str_replace(".", "", $input['amount']);
                } else {
                    $input['amount'] .= "00";
                }

                $input['secret_key'] = $this->secret_key;
                $input['$public_key'] = $this->public_key;
                $this->stripegateway->create_plan($input);
                redirect('/admin/plans/all');
            }
        }

        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        $input = $this->input->post();

        if ($input) {
            if ($this->form_validation->run('edit_plan') == TRUE) {
                $this->plans->update($input, $id);
                $input['secret_key'] = $this->secret_key;
                $input['$public_key'] = $this->public_key;
                $this->stripegateway->update_plan($input);
                redirect('/admin/plans/all');
            }
        }

        $this->data['plan'] = $this->plans->get_details($id);
        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete($id, $name)
    {
        if ($this->plans->delete($id)) {
            $input['name'] = $name;
            $input['secret_key'] = $this->secret_key;
            $input['$public_key'] = $this->public_key;
            $this->stripegateway->delete_plan($input);
            redirect('/admin/plans/all');
        }
    }
}