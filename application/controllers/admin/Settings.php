<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function index()
    {
        $input = $this->input->post();

        if ($input) {
            foreach ($input as $key => $value) {
                $input[$key] = html_entity_decode($value);
            }
            if (!isset($input['stripe_test_mode'])) {
                $input['stripe_test_mode'] = 0;
            }
            if ($this->form_validation->run() == FALSE) {
                $this->load->library('upload');

                $config['upload_path'] = FCPATH . 'uploads'; //core folder (if you like upload to application folder use APPPATH)
                $config['allowed_types'] = 'gif|jpg|png'; //allowed MIME types
                $config['overwrite'] = true;

                $this->upload->initialize($config);

                if ($_FILES && $_FILES['church_logo']['name']) {
                    if (!$this->upload->do_upload('church_logo')) {
                        //$this->upload->display_errors();    
                    } else {
                        $upload_data = $this->upload->data();
                        $this->files->upload($upload_data);
                        $input['church_logo'] = '/uploads/' . $upload_data['orig_name'];
                    }
                }
                $this->upload->initialize($config);
                if ($_FILES && $_FILES['favicon']['name']) {
                    if (!$this->upload->do_upload('favicon')) {
                        //$this->upload->display_errors();    
                    } else {
                        $upload_data = $this->upload->data();
                        $this->files->upload($upload_data);
                        $input['favicon'] = '/uploads/' . $upload_data['orig_name'];
                    }
                }
            }

            $this->settings_model->update($input);
            $this->data['success'] = TRUE;
            redirect('/admin/settings');

        }

        $this->data['timezones'] = get_timezones();

        $this->data['pages'] = $this->pages->get_all();
        $this->data['setting'] = $this->settings_model->get_all_admin();


        $this->load->view('layout/backend/master', $this->data);
    }

    public function add()
    {
        // Only Super Admin can access.
        $this->auth->check(array("Super Admin"));

        $input = $this->input->post();

        if ($input) {
            if ($this->form_validation->run('add_setting') == TRUE) {
                // Add the data to table.

                $this->settings_model->add($input);
                // Set a success alert.
                $this->session->set_flashdata('add_success', TRUE);
                // Redirect to Settings page.
                redirect('/admin/settings/');
            }
        }

        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        // Only Super Admin can access.
        $this->auth->check(array("Super Admin"));

        $input = $this->input->post();
        // Set the settings data.
        $this->data['setting'] = $this->settings_model->val($id, TRUE);

        if ($input) {
            if ($this->form_validation->run('edit_setting') == TRUE) {
                // Update the data to the table.
                $this->settings_model->edit($input);
                // Redirect to Settings page.
                redirect('/admin/settings/');
            }
        }

        $this->load->view('layout/backend/master', $this->data);
    }


}
