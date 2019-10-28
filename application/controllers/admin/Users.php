<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!class_exists('bcrypt')) {
            $this->load->library('bcrypt');
        }
    }

    public function all()
    {
        $this->auth->check(array("Super Admin", "Admin"));
        $this->data['users'] = $this->users->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function add()
    {
        $this->auth->check(array("Super Admin", "Admin"));
        $input = $this->input->post();

        if ($input) {
            if ($this->form_validation->run('add_user') == TRUE) {
                $input['password'] = $this->bcrypt->hash_password($input['password']);
                unset($input['confirm_password']);
                $this->users->add($input);
                redirect('/admin/users/all');
            }
        }

        $this->data['roles'] = $this->roles->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function edit($id)
    {
        $this->data['user'] = $this->users->get_details($id);
        $this->auth->check(array("Super Admin", "Admin"), $this->data['user']->role);

        $input = $this->input->post();

        if ($input) {
            $id = $input['id'];
            unset($input['id']);

            if ($this->form_validation->run('edit_user') == TRUE) {
                if (empty($input['password'])) {
                    unset($input['password']);
                } else {
                    $input['password'] = $this->bcrypt->hash_password($input['password']);
                }
                unset($input['confirm_password']);

                $this->users->update($input, $id);
                redirect('/admin/users/all');
                echo "accepted";
                exit;
            }
        }

        $this->data['user'] = $this->users->get_details($id);
        $this->data['roles'] = $this->roles->get_all();
        $this->load->view('layout/backend/master', $this->data);
    }

    public function change_password()
    {
        if ($this->form_validation->run('change_password') == FALSE) {
            $this->load->view('layout/backend/master');
        } else {
            $input = $this->input->post();
            $user = $this->users->get_details($this->session->user->username);
            if (!$this->bcrypt->check_password($input['password'], $user->password)) {
                $this->data['error'] = "Invalid Password";
            } else {
                $this->users->update_password($this->bcrypt->hash_password($input['new_password']));
                $this->data['success'] = "Password updated";
            }
            $this->load->view('layout/backend/master', $this->data);
        }
    }

    public function delete($id)
    {
        $this->data['user'] = $this->users->get_details($id);
        $this->auth->check(array("Super Admin", "Admin"), $this->data['user']->role);

        if ($this->users->delete($id)) {
            redirect('/admin/users/all');
        }
    }

    public function is_email_existing()
    {

        $input = $this->input->post();
        // Check in database if existing.
        $is_email_exist = $this->users->get_details_by_email($input['email']);
        // Return to javascript.
        if ($is_email_exist)
            echo 1;
        else
            echo 0;
    }
}
