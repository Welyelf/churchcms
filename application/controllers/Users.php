<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        $input = $this->input->post();

        if ($input) {
            if ($this->form_validation->run('register') == TRUE) {
                $input['password'] = $this->bcrypt->hash_password($input['password']);
                unset($input['confirm_password']);
                $input['role'] = "User";
                $this->users->add($input);

                $site_name = $this->settings['site_name'];

                $subject = "Registration Successful {$site_name}";
                $headers = "From: {$site_name} CMS <noreply@kedrasoft.com> \r\n";
                $headers .= 'Content-type: text/html; charset=utf-8\r\n';

                $message = "Hi {$input['first_name']}, <br /><br />";
                $message .= "You have successfully registered on {$site_name}! <br /><br />";
                $message .= "<a href='" . base_url() . "user/account'>Login</a> <br /><br />";

                mail($input['email'], $subject, $message, $headers);

                redirect('/auth/login');
            }
        }

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function login()
    {

        $input = $this->input->post();
        if ($input) {
            $user = $this->users->get_details($input['username']);

            if ($user) {
                if ($this->bcrypt->check_password($input['password'], $user->password)) {
                    unset($user->password);
                    $this->session->set_userdata('user', $user);
                    if ($user->role == "User") {
                        redirect('/');
                    } else {
                        redirect('/user/account');

                    }
                    exit;
                }
            }
            $this->data['error'] = "Invalid Username and/or Password.";
        }
        //$this->load->view('layout/backend/master.php', $this->data);
        $this->load->view('layout/frontend/master', $this->data);

    }

    public function my_donations()
    {
        $this->data['donations'] = $this->donations->get_by_email($this->session->user->email);
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function subscription_info($id)
    {
        if ($this->settings["stripe_test_mode"] == 1) {
            $data["secret_key"] = $this->settings['test_stripe_sk'];
            $data["public_key"] = $this->settings['test_stripe_pk'];
        } else {
            $data["secret_key"] = $this->settings['live_stripe_sk'];
            $data["public_key"] = $this->settings['live_stripe_pk'];
        }
        $this->data['subscription'] = $this->stripegateway->retrieve_subscription($id, $data);
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function my_profile()
    {
        if (!$this->session->userdata('user')) {
            $this->load->view('layout/frontend/master', $this->data);
            redirect('/auth/login');
        } else {
            $this->data['user'] = $this->users->get_details($this->session->user->id);
            $this->load->view('layout/frontend/master', $this->data);
        }
    }

}