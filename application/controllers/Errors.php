<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller
{

    public function not_found()
    {
        $this->data['heading'] = "Error 404";
        $this->data['subheading'] = "The page you requested could not be found. ";
        $this->data['button_text'] = "Contact Us!";
        $this->data['button_link'] = "/contact";

        $this->load->view('layout/frontend/master', $this->data);
    }

    public function test_missing_function()
    {
        echo "Test for missing function";
        missing_function();
        exit;
    }

    public function test_wrong_param()
    {
        echo "Test for wrong parameter for function";
        get_12_hour("test");
        exit;
    }

    public function test_wrong_syntax()
    {
        echo "Test for wrong parameter for function";
        get_12_hour("test");
        exit;
    }

    public function test_mail()
    {
        $this->mail->send();
        echo "done";
    }
}
