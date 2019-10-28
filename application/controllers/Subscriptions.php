<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->data['heading'] = "Monthly Subscriptions";
        $this->data['subheading'] = "We'll handle all the website stuff. Hosting, domain registry, all that.";
        $this->data['button_text'] = "Get Started!!";
        $this->data['button_link'] = "#";

        $this->data['plans'] = $this->plans->get_all();
        $this->load->view('layout/frontend/master', $this->data);
    }

    public function unsubscribe()
    {
        $input = $this->input->post();
        $get = $this->input->get();

        $this->data['is_unsubscribe'] = FALSE;

        if ($input) {

            $subscriber = $this->subscribers->get_unsubscribe_details($input['email_unsubscribe']);

            if ($subscriber) {

                $this->load->library('encryption');

                $this->encryption->initialize(
                    array(
                        'cipher' => 'aes-128',
                        'mode' => 'ctr',
                        'key' => 'this is the unsubscribe key'
                    )
                );

                // Encrypt the tokens.
                $encrypted_token = $this->encryption->encrypt(time());
                $encrypted_email = $this->encryption->encrypt($input['email_unsubscribe']);

                $site_name = $this->settings['site_name'];

                $to = $input['email_unsubscribe'];
                $subject = "Unsubscribe from {$site_name}";
                $headers = "From: $site_name CMS <noreply@kedrasoft.com> \r\n";
                $headers .= 'Content-type: text/html; charset=utf-8\r\n';

                $message = "You have chosen to unsubscribe from {$site_name}: <br /><br />";
                $message .= "<a href='" . base_url() . "unsubscribe?email=" . rawurlencode($encrypted_email) . "&token=" . rawurlencode($encrypted_token) . "'>Confirm</a> <br /><br />";
                $message .= "Please ignore if you did not choose to unsubscribe.";

                // Send confirmation email.
                mail($to, $subject, $message, $headers);
            }

            $this->data['success'] = "An Email has been sent to your email!";

//            if($subscriber = $this->subscribers->get_unsubscribe_details($input['email_unsubscribe'])){
//                
//               if($this->subscribers->unsubscribe($input['email_unsubscribe'])){
//                    $this->data['success'] = "Email Unsubscribed Successfully!.";
//                }  
//            }else{
//                 $this->data['error'] = "No email found!.";
//            }

        }

        if ($get) {

            $this->load->library('encryption');

            $this->encryption->initialize(
                array(
                    'cipher' => 'aes-128',
                    'mode' => 'ctr',
                    'key' => 'this is the unsubscribe key'
                )
            );

            // Decrypt the token and email.
            $decrypted_token = $this->encryption->decrypt(rawurldecode($this->input->get('token')));
            $decrypted_email = $this->encryption->decrypt(rawurldecode($this->input->get('email')));

            // Get current Time.
            $cur_time = time();

            // Check if token is expired. Duration is 3 days.
            if ($cur_time - $decrypted_token < 259200) {
                if ($this->subscribers->unsubscribe($decrypted_email))
                    $this->data['unsubscribe_success'] = TRUE;
                else
                    $this->data['unsubscribe_success'] = FALSE;

                $this->data['is_expired'] = FALSE;
            } else {
                $this->data['is_expired'] = TRUE;
            }

            $this->data['is_unsubscribe'] = TRUE;
        }

        $this->load->view('layout/frontend/master', $this->data);
    }

}