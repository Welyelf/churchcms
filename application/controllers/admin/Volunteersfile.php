<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteersfile extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        // Get all volunteer schedules.
        $this->data['volunteers_file'] = $this->volunteers_file->get_all();
        // Load layout.
        $this->load->view('layout/backend/master', $this->data);
    }

    public function add($id = NULL)
    {
        if (isset($id)) {
            $this->data['volunteer_schedules'] = $this->volunteers_file->get_details($id);
        }

        $input = $this->input->post();

        if ($input) {

            $this->load->library('upload');

            $config['upload_path'] = FCPATH . 'uploads';
            $config['overwrite'] = true;
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = '*';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                //$this->data['file'] = $this->upload->display_errors();
                $this->data['error'] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                $this->files->upload($upload_data);
                $input['file'] = '/uploads/' . $upload_data['file_name'];
            }
            // Execute volunteersfile add model.

            if (isset($id)) {
                $this->volunteers_file->update($input, $id);
            } else {
                $this->volunteers_file->add($input);
            }

            redirect('/admin/volunteer-schedules/');
        }
        // Load layout.
        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete($id)
    {
        // Delete volunteerfile schedule by id then redirect to all if success.
        if ($this->volunteers_file->delete($id))
            redirect('/admin/volunteer-schedules/');

    }
}