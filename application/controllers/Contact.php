<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller
{

    public function index()
    {
        $this->data['heading'] = "Contact Us";
        $this->data['subheading'] = "Got some questions? Talk to us today! We can help!";
        $this->data['button_text'] = "Get Started!!";
        $this->data['button_link'] = "#";

        if ($this->form_validation->run('contact') == FALSE) {
            $this->load->view('layout/frontend/master', $this->data);
        } else {
            $input = $this->input->post();
            $message = "Phone: " . $input['phone'] . "<br />Email: " . $input['email'] . "<br />Message: " . $input['message'];

            $to = $this->settings['email_to'];
            $subject = "Website Inquiry";
            $headers = "From: {$input['email']}\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8\r\n';

            if (mail($to, $subject, $message, $headers)) {
                redirect('/contact/success');
            }
        }
    }

    public function success()
    {

        $this->data['heading'] = "Contact Us";
        $this->data['subheading'] = "Got some questions? Talk to us today! We can help!";
        $this->data['button_text'] = "Get Started!!";
        $this->data['button_link'] = "#";

        $this->load->view('layout/frontend/master', $this->data);
    }
}
