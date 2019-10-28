<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends MY_Controller
{

    public function add()
    {
        $input = $this->input->post();

        if ($input) {
            $is_unique = '|is_unique[$input[email]]';
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|xss_clean|' . $is_unique);

            if ($this->subscribers->add($input)) {
                //$this->data['success'] = "Subscribed Successfully !";
                $result['success'] = "";
            } else {
                $result['error'] = "";
            }
            echo json_encode($result);
            redirect('/', $this->data);
        }

    }

    public function send_sermon()
    {
        $count = 0;
        $subscribers = $this->subscribers->get_all();
        // $sermons = $this->sermons->get_all(1);
        $sermons = $this->sermons->get_sermons(FALSE, FALSE, 1); // Replaced get_all with get_sermons.
        $data['sermons'] = $sermons[0];
        $email = $this->emails->get_details('weekly_sermon');
        $subject = "Weekly Sermon";

        foreach ($subscribers as $subscriber) {
            $data['subscribers'] = $subscriber;

            $message = parser($email->template, $data);
            send_mail($subscriber->email, $subject, $message);
            echo "Weekly Sermon sent to: {$subscriber->email}<br/>";
            $count++;
        }

        echo "{$count} emails sent.";
    }

    public function unsubscribe($id)
    {

    }
}
