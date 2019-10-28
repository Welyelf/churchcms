<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        // Get all volunteer schedules.
        $this->data['volunteer_schedules'] = $this->volunteers->get_all();
        // Load layout.
        $this->load->view('layout/backend/master', $this->data);
    }

    public function add()
    {
        $input = $this->input->post();

        if ($input)
            if ($this->form_validation->run('add_volunteer_schedule') == TRUE) {
                // Change date to int type.
                $input['datetime'] = human_to_unix($input['date'] . " 0:0");
                unset($input['date']);
                // Execute volunteers add model.
                $this->volunteers->add($input);
                // Redirect back to all.
                redirect('/admin/volunteers/');
            }
        // Load layout.
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        // Get volunteer schedule details by id.
        $this->data['volunteer_schedules'] = $this->volunteers->get_details($id);

        $input = $this->input->post();

        if ($input)
            if ($this->form_validation->run('add_volunteer_schedule') == TRUE) {
                // Change date to int type.
                $input['datetime'] = human_to_unix($input['date'] . " 0:0");
                unset($input['date']);
                // Execute volunteers update model.
                $this->volunteers->update($input, $id);
                // Redirect back to all.
                redirect('/admin/volunteers/');
            }
        // Load layout.
        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete($id)
    {
        // Delete volunteer schedule by id then redirect to all if success.
        if ($this->volunteers->delete($id))
            redirect('/admin/volunteers/');

    }
}