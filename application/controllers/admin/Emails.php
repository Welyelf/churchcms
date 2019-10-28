<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function all()
    {
        $this->data['emails'] = $this->emails->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function add()
    {
        $input = $this->input->post();

        if ($input) {
            if ($this->form_validation->run('add_email') == TRUE) {
                $input['slug'] = strtolower($input['slug']);
                $this->emails->add($input);
                redirect('/admin/emails/all');
            }
        }
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        $input = $this->input->post();
        $this->data['email_template'] = $this->emails->get_details($id);

        if ($input) {

            if ($input['slug'] == $this->data['email_template']->slug) {
                $rule_set = 'edit_email';
            } else {
                $rule_set = 'add_email';
            }

            if ($this->form_validation->run($rule_set) == TRUE) {
                $input['slug'] = strtolower($input['slug']);
                $this->emails->update($input, $id);
                redirect('/admin/emails/all');
            }
        }

        $this->data['email'] = $this->emails->get_details($id);
        $this->load->view('layout/backend/master', $this->data);
    }

    public function delete($id)
    {
        if ($this->emails->delete($id)) {
            redirect('/admin/emails');
        }
    }

    public function test($id)
    {
        $email = $this->emails->get_details($id);

        $data['users'] = $this->users->get_details($this->session->user->id);

        $subject = "Test Email";
        $message = parser($email->template, $data);

        send_mail("philip@kedrasoft.com", "noreply@kedrasoft.com", $subject, $message);
    }


}
