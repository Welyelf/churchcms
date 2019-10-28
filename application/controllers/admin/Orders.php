<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['orders'] = $this->orders->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        $input = $this->input->post();

        if ($input) {
            $id = $input['id'];
            unset($input['id']);

            $this->orders->update($input, $id);

            redirect('/admin/orders/all');
        }

        $this->data['order'] = $this->orders->get_details($id);
        $this->load->view('layout/backend/master', $this->data);
    }

    public function view($id)
    {
        $this->data['order'] = $this->orders->get_details($id);
        $this->load->view('layout/backend/master', $this->data);
    }
}
