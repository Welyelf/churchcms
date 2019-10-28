<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{

    public function __construct()
    {
        $this->CI =& get_instance();

        // Required Libraries
        if (!class_exists('session')) {
            $this->CI->load->library('session');
        }

        // Required Configs
        $this->CI->config->load('auth');
    }

    public function check($roles = FALSE, $ref_role = FALSE)
    {
        //Check if there is a logged in user
        if (!isset($this->CI->session->user)) {
            redirect(base_url($this->CI->config->item('auth_login')));
        } else {
            if ($roles) {
                if (!in_array($this->CI->session->user->role, $roles) || ($this->CI->session->user->role == "Admin" && $ref_role == "Super Admin")) {
                    redirect(base_url($this->CI->config->item('auth_denied')));
                }
            }
        }
    }
}